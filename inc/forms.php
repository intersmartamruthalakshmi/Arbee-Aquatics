<?php
/**
 * Enquiry form processing (Request a Quote modal + Contact page form).
 *
 * The original PHP site had no form handler (HTML only). Submissions are now:
 *  - validated and sanitised server side,
 *  - protected by nonce, honeypot and a per-IP rate limit,
 *  - stored as a private "Enquiry" post (Dashboard → Enquiries),
 *  - emailed to the recipients set in Theme Settings → Forms.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'init',
	function () {
		register_post_type(
			'arbee_enquiry',
			array(
				'labels'          => array(
					'name'          => __( 'Enquiries', 'arbee' ),
					'singular_name' => __( 'Enquiry', 'arbee' ),
					'edit_item'     => __( 'View Enquiry', 'arbee' ),
					'search_items'  => __( 'Search Enquiries', 'arbee' ),
					'not_found'     => __( 'No enquiries yet.', 'arbee' ),
				),
				'public'          => false,
				'show_ui'         => true,
				'show_in_menu'    => true,
				'menu_position'   => 26,
				'menu_icon'       => 'dashicons-email-alt',
				'supports'        => array( 'title', 'editor' ),
				'capability_type' => 'post',
				'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
				'map_meta_cap'    => true,
			)
		);
	}
);

/**
 * Allowed "What do you want to know about?" values per form.
 */
function arbee_enquiry_topics( $form ) {
	$raw = 'contact' === $form ? arbee_get( 'form_topics', arbee_contact_page_id() ) : arbee_opt( 'quote_topics' );
	return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $raw ) ) ) );
}

function arbee_contact_page_id() {
	$pages = get_pages(
		array(
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'page-templates/template-contact.php',
			'number'     => 1,
		)
	);
	return $pages ? (int) $pages[0]->ID : 0;
}

/**
 * Mirrors the client-side rules in assets/js/forms.js, so a request that
 * bypasses JavaScript is still held to the same standard.
 */
function arbee_has_script_tags( $value ) {
	return (bool) preg_match( '/<[a-z][\s\S]*>/i', (string) $value );
}

function arbee_handle_enquiry() {
	if ( ! check_ajax_referer( 'arbee_enquiry', 'nonce', false ) ) {
		wp_send_json_error( array( 'message' => __( 'Your session has expired. Please reload the page and try again.', 'arbee' ) ), 403 );
	}

	// Honeypot: real visitors never fill this.
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success( array( 'message' => arbee_enquiry_success_message() ) );
	}

	// Rate limit: 5 submissions per 10 minutes per IP.
	$ip       = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$rate_key = 'arbee_enq_' . md5( $ip );
	$count    = (int) get_transient( $rate_key );
	if ( $count >= 5 ) {
		wp_send_json_error( array( 'message' => __( 'Too many submissions. Please try again in a few minutes.', 'arbee' ) ), 429 );
	}

	$form = isset( $_POST['form'] ) && 'contact' === $_POST['form'] ? 'contact' : 'quote';
	$data = array(
		'full_name'    => sanitize_text_field( wp_unslash( $_POST['full_name'] ?? '' ) ),
		'country_code' => sanitize_text_field( wp_unslash( $_POST['country_code'] ?? '' ) ),
		'phone'        => sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) ),
		'email'        => sanitize_email( wp_unslash( $_POST['email'] ?? '' ) ),
		'topic'        => sanitize_text_field( wp_unslash( $_POST['topic'] ?? '' ) ),
		'comments'     => sanitize_textarea_field( wp_unslash( $_POST['comments'] ?? '' ) ),
		'page_url'     => esc_url_raw( wp_unslash( $_POST['page_url'] ?? '' ) ),
	);

	$errors = array();

	$full_name = preg_replace( '/\s+/', ' ', trim( $data['full_name'] ) );
	if ( arbee_has_script_tags( $full_name ) ) {
		$errors['full_name'] = __( 'Invalid input. Script tags are not allowed.', 'arbee' );
	} elseif ( strlen( $full_name ) < 3 ) {
		$errors['full_name'] = __( 'Minimum 3 characters required.', 'arbee' );
	} elseif ( strlen( $full_name ) > 120 || ! preg_match( '/^[a-zA-Z\s]+$/', $full_name ) ) {
		$errors['full_name'] = __( 'Only alphabets and spaces are allowed.', 'arbee' );
	}

	// Digits only — the separate country-code picker already supplies the "+" dial code.
	$phone_digits = preg_replace( '/\s+/', '', $data['phone'] );
	if ( strlen( $phone_digits ) < 7 || strlen( $phone_digits ) > 15 || ! preg_match( '/^[0-9]+$/', $phone_digits ) ) {
		$errors['phone'] = __( 'Please enter a valid phone number.', 'arbee' );
	}

	if ( '' !== $data['country_code'] && ! preg_match( '/^\+?[0-9]{1,4}$/', $data['country_code'] ) ) {
		$errors['country_code'] = __( 'Please choose a valid country code.', 'arbee' );
	}

	if ( strlen( $data['email'] ) > 50 || ! preg_match( '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z][a-zA-Z0-9-]{0,61}[a-zA-Z]\.[a-zA-Z]{2,}(?:\.[a-zA-Z]{2,})?$/', $data['email'] ) || ! is_email( $data['email'] ) ) {
		$errors['email'] = __( 'Please enter a valid email address.', 'arbee' );
	}

	$topics = arbee_enquiry_topics( $form );
	if ( '' === $data['topic'] || ( $topics && ! in_array( $data['topic'], $topics, true ) ) ) {
		$errors['topic'] = __( 'Please choose a topic.', 'arbee' );
	}

	// Optional field — collapse repeated spaces/tabs within a line (keep intentional line breaks).
	$comments = trim( preg_replace( '/[ \t]+/', ' ', $data['comments'] ) );
	if ( '' !== $comments ) {
		if ( arbee_has_script_tags( $comments ) ) {
			$errors['comments'] = __( 'Invalid input. Script tags are not allowed.', 'arbee' );
		} elseif ( strlen( $comments ) < 3 ) {
			$errors['comments'] = __( 'Minimum 3 characters required.', 'arbee' );
		} elseif ( strlen( $comments ) > 500 || ! preg_match( '/^[a-zA-Z0-9\s.,!?\'"()-]+$/', $comments ) ) {
			$errors['comments'] = __( 'Only letters, numbers, spaces, and common punctuation are allowed.', 'arbee' );
		}
	}
	$data['full_name'] = $full_name;
	$data['comments']  = $comments;

	if ( $errors ) {
		wp_send_json_error(
			array(
				'message' => __( 'Please correct the highlighted fields.', 'arbee' ),
				'errors'  => $errors,
			),
			422
		);
	}

	set_transient( $rate_key, $count + 1, 10 * MINUTE_IN_SECONDS );

	$forms      = arbee_enquiry_forms();
	$form_label = $forms[ $form ] ?? $form;
	$lines      = array(
		__( 'Form', 'arbee' )     => $form_label,
		__( 'Name', 'arbee' )     => $data['full_name'],
		__( 'Phone', 'arbee' )    => trim( $data['country_code'] . ' ' . $data['phone'] ),
		__( 'Email', 'arbee' )    => $data['email'],
		__( 'Topic', 'arbee' )    => $data['topic'],
		__( 'Comments', 'arbee' ) => $data['comments'],
		__( 'Page', 'arbee' )     => $data['page_url'],
	);
	$body = '';
	foreach ( $lines as $label => $value ) {
		$body .= $label . ': ' . $value . "\n";
	}

	$post_id = wp_insert_post(
		array(
			'post_type'    => 'arbee_enquiry',
			'post_status'  => 'private',
			'post_title'   => $data['full_name'],
			'post_content' => $body,
		)
	);
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		foreach ( $data as $key => $value ) {
			update_post_meta( $post_id, '_arbee_' . $key, $value );
		}
		update_post_meta( $post_id, '_arbee_form', $form );
	}

	// Each form (Contact / Quote) has its own To + From, set in Theme Settings → Form delivery.
	$recipients_key = 'quote' === $form ? 'quote_recipients' : 'contact_recipients';
	$recipients     = array_filter( array_map( 'sanitize_email', array_map( 'trim', explode( ',', (string) arbee_opt( $recipients_key ) ) ) ), 'is_email' );
	if ( ! $recipients ) {
		$recipients = array( get_option( 'admin_email' ) );
	}

	$from_name_key  = 'quote' === $form ? 'quote_from_name' : 'contact_from_name';
	$from_email_key = 'quote' === $form ? 'quote_from_email' : 'contact_from_email';
	$from_name      = (string) arbee_opt( $from_name_key );
	$from_email     = (string) arbee_opt( $from_email_key );

	$reply_name = str_replace( array( "\r", "\n", '"', '<', '>' ), '', $data['full_name'] );
	$headers    = array( 'Content-Type: text/html; charset=UTF-8', 'Reply-To: "' . $reply_name . '" <' . $data['email'] . '>' );
	if ( '' !== $from_email && is_email( $from_email ) ) {
		$from_label = '' !== $from_name ? str_replace( array( "\r", "\n", '"' ), '', $from_name ) : $from_email;
		$headers[]  = 'From: "' . $from_label . '" <' . $from_email . '>';
	}

	$site        = wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES );
	$subject     = 'quote' === $form
		? sprintf( '%s - %s', $form_label, $site )
		: sprintf( '[%s] %s: %s', $site, $form_label, $reply_name );
	$admin_table = '<table role="presentation" width="100%" cellpadding="0" cellspacing="0">';
	foreach ( $lines as $label => $value ) {
		$admin_table .= '<tr><td style="padding:6px 12px 6px 0; font-weight:bold; vertical-align:top; white-space:nowrap;">' . esc_html( $label ) . '</td><td style="padding:6px 0;">' . nl2br( esc_html( $value ) ) . '</td></tr>';
	}
	$admin_table .= '</table>';
	$admin_html  = arbee_email_template( __( 'New enquiry', 'arbee' ), $admin_table );
	$sent        = wp_mail( $recipients, $subject, $admin_html, $headers );

	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_arbee_mail_sent', $sent ? 'yes' : 'no' );
	}

	// Also confirm receipt to the person who submitted the form, unless turned off.
	$confirm_enabled = arbee_opt( 'enquiry_confirm_enabled' );
	if ( null === $confirm_enabled || $confirm_enabled ) {
		$confirm_subject = (string) arbee_opt( 'enquiry_confirm_subject' );
		$confirm_subject = arbee_has( $confirm_subject )
			? $confirm_subject
			: $site;

		$confirm_message = (string) arbee_opt( 'enquiry_confirm_message' );
		$confirm_message = arbee_has( $confirm_message )
			? $confirm_message
			: __( "Hi {name},\n\nThanks for reaching out to {site}. We've received your enquiry and will get back to you shortly.\n\nThis is an automated confirmation - no reply is needed.", 'arbee' );

		$replacements    = array(
			'{name}' => $data['full_name'],
			'{site}' => $site,
		);
		$confirm_subject = strtr( $confirm_subject, $replacements );
		$confirm_message = strtr( $confirm_message, $replacements );
		$confirm_html    = arbee_email_template( __( 'Thank you for contacting us', 'arbee' ), nl2br( esc_html( $confirm_message ) ) );
		$confirm_headers = array( 'Content-Type: text/html; charset=UTF-8' );
		if ( '' !== $from_email && is_email( $from_email ) ) {
			$confirm_headers[] = 'From: "' . ( '' !== $from_name ? str_replace( array( "\r", "\n", '"' ), '', $from_name ) : $from_email ) . '" <' . $from_email . '>';
		}
		$user_sent = wp_mail( $data['email'], $confirm_subject, $confirm_html, $confirm_headers );

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, '_arbee_user_mail_sent', $user_sent ? 'yes' : 'no' );
		}
	}

	wp_send_json_success( array( 'message' => arbee_enquiry_success_message() ) );
}
add_action( 'wp_ajax_arbee_enquiry', 'arbee_handle_enquiry' );
add_action( 'wp_ajax_nopriv_arbee_enquiry', 'arbee_handle_enquiry' );

function arbee_enquiry_success_message() {
	$msg = arbee_opt( 'enquiry_success_message' );
	return arbee_has( $msg ) ? (string) $msg : __( 'Thank you! Your enquiry has been sent. Our team will get back to you shortly.', 'arbee' );
}

/**
 * The known enquiry forms, keyed by the value stored in `_arbee_form`.
 */
function arbee_enquiry_forms() {
	return array(
		'contact' => __( 'Contact form', 'arbee' ),
		'quote'   => __( 'Request a Quote', 'arbee' ),
	);
}

/**
 * Admin list columns for enquiries.
 */
add_filter(
	'manage_arbee_enquiry_posts_columns',
	function ( $cols ) {
		return array(
			'cb'           => $cols['cb'],
			'title'        => __( 'Enquiry', 'arbee' ),
			'arbee_form'   => __( 'Form', 'arbee' ),
			'arbee_email'  => __( 'Email', 'arbee' ),
			'arbee_phone'  => __( 'Phone', 'arbee' ),
			'arbee_topic'  => __( 'Topic', 'arbee' ),
			'arbee_mailed' => __( 'Admin emailed', 'arbee' ),
			'arbee_user_mailed' => __( 'User emailed', 'arbee' ),
			'date'         => $cols['date'],
		);
	}
);

add_action(
	'manage_arbee_enquiry_posts_custom_column',
	function ( $col, $post_id ) {
		switch ( $col ) {
			case 'arbee_form':
				$forms = arbee_enquiry_forms();
				$key   = get_post_meta( $post_id, '_arbee_form', true );
				echo esc_html( $forms[ $key ] ?? $key );
				break;
			case 'arbee_email':
				$email = get_post_meta( $post_id, '_arbee_email', true );
				echo '<a href="' . esc_url( 'mailto:' . $email ) . '">' . esc_html( $email ) . '</a>';
				break;
			case 'arbee_phone':
				echo esc_html( trim( get_post_meta( $post_id, '_arbee_country_code', true ) . ' ' . get_post_meta( $post_id, '_arbee_phone', true ) ) );
				break;
			case 'arbee_topic':
				echo esc_html( get_post_meta( $post_id, '_arbee_topic', true ) );
				break;
			case 'arbee_mailed':
				echo 'yes' === get_post_meta( $post_id, '_arbee_mail_sent', true ) ? '✔' : '✖';
				break;
			case 'arbee_user_mailed':
				$status = get_post_meta( $post_id, '_arbee_user_mail_sent', true );
				echo '' === $status ? '—' : ( 'yes' === $status ? '✔' : '✖' );
				break;
		}
	},
	10,
	2
);

/**
 * "Filter by form" dropdown above the Enquiries list, so Contact-form and
 * Request-a-Quote submissions can be viewed separately.
 */
add_action(
	'restrict_manage_posts',
	function ( $post_type ) {
		if ( 'arbee_enquiry' !== $post_type ) {
			return;
		}
		$current = isset( $_GET['arbee_form_filter'] ) ? sanitize_text_field( wp_unslash( $_GET['arbee_form_filter'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
		echo '<select name="arbee_form_filter">';
		echo '<option value="">' . esc_html__( 'All forms', 'arbee' ) . '</option>';
		foreach ( arbee_enquiry_forms() as $key => $label ) {
			printf( '<option value="%s"%s>%s</option>', esc_attr( $key ), selected( $current, $key, false ), esc_html( $label ) );
		}
		echo '</select>';
	}
);

add_action(
	'pre_get_posts',
	function ( $query ) {
		if ( ! is_admin() || ! $query->is_main_query() || 'arbee_enquiry' !== $query->get( 'post_type' ) ) {
			return;
		}
		if ( empty( $_GET['arbee_form_filter'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			return;
		}
		$form = sanitize_text_field( wp_unslash( $_GET['arbee_form_filter'] ) ); // phpcs:ignore WordPress.Security.NonceVerification
		if ( ! array_key_exists( $form, arbee_enquiry_forms() ) ) {
			return;
		}
		$query->set(
			'meta_query', // phpcs:ignore WordPress.DB.SlowDBQuery
			array(
				array(
					'key'   => '_arbee_form',
					'value' => $form,
				),
			)
		);
	}
);
