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
	if ( '' === $data['full_name'] || strlen( $data['full_name'] ) > 120 ) {
		$errors['full_name'] = __( 'Please enter your full name.', 'arbee' );
	}
	if ( ! preg_match( '/^[0-9+()\-\s]{5,20}$/', $data['phone'] ) ) {
		$errors['phone'] = __( 'Please enter a valid phone number.', 'arbee' );
	}
	if ( '' !== $data['country_code'] && ! preg_match( '/^\+?[0-9]{1,4}$/', $data['country_code'] ) ) {
		$errors['country_code'] = __( 'Please choose a valid country code.', 'arbee' );
	}
	if ( ! is_email( $data['email'] ) ) {
		$errors['email'] = __( 'Please enter a valid email address.', 'arbee' );
	}
	$topics = arbee_enquiry_topics( $form );
	if ( '' === $data['topic'] || ( $topics && ! in_array( $data['topic'], $topics, true ) ) ) {
		$errors['topic'] = __( 'Please choose a topic.', 'arbee' );
	}
	if ( strlen( $data['comments'] ) > 5000 ) {
		$errors['comments'] = __( 'Your message is too long.', 'arbee' );
	}

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

	$form_label = 'contact' === $form ? __( 'Contact form', 'arbee' ) : __( 'Request a Quote', 'arbee' );
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
			'post_title'   => sprintf( '%s — %s', $form_label, $data['full_name'] ),
			'post_content' => $body,
		)
	);
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		foreach ( $data as $key => $value ) {
			update_post_meta( $post_id, '_arbee_' . $key, $value );
		}
		update_post_meta( $post_id, '_arbee_form', $form );
	}

	$recipients = array_filter( array_map( 'sanitize_email', array_map( 'trim', explode( ',', (string) arbee_opt( 'enquiry_recipients' ) ) ) ), 'is_email' );
	if ( ! $recipients ) {
		$recipients = array( get_option( 'admin_email' ) );
	}
	$reply_name = str_replace( array( "\r", "\n", '"', '<', '>' ), '', $data['full_name'] );
	$headers    = array( 'Reply-To: "' . $reply_name . '" <' . $data['email'] . '>' );
	$subject    = sprintf( '[%s] %s: %s', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ), $form_label, $reply_name );
	$sent       = wp_mail( $recipients, $subject, $body, $headers );

	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_arbee_mail_sent', $sent ? 'yes' : 'no' );
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
 * Admin list columns for enquiries.
 */
add_filter(
	'manage_arbee_enquiry_posts_columns',
	function ( $cols ) {
		return array(
			'cb'           => $cols['cb'],
			'title'        => __( 'Enquiry', 'arbee' ),
			'arbee_email'  => __( 'Email', 'arbee' ),
			'arbee_phone'  => __( 'Phone', 'arbee' ),
			'arbee_topic'  => __( 'Topic', 'arbee' ),
			'arbee_mailed' => __( 'Emailed', 'arbee' ),
			'date'         => $cols['date'],
		);
	}
);

add_action(
	'manage_arbee_enquiry_posts_custom_column',
	function ( $col, $post_id ) {
		switch ( $col ) {
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
		}
	},
	10,
	2
);
