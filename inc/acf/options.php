<?php
/**
 * Global field groups: Theme Settings, menu item icon, inner page banner, SEO.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'acf/init',
	function () {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(
				array(
					'page_title' => __( 'Theme Settings', 'arbee' ),
					'menu_title' => __( 'Theme Settings', 'arbee' ),
					'menu_slug'  => 'arbee-theme-settings',
					'capability' => 'edit_theme_options',
					'icon_url'   => 'dashicons-admin-customizer',
					'position'   => 59,
					'redirect'   => false,
				)
			);
		}

		$options_location = array(
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'arbee-theme-settings',
				),
			),
		);

		arbee_acf_group(
			'opt',
			__( 'Theme Settings', 'arbee' ),
			array(
				// ---- Header ----
				arbee_f_tab( __( 'Header', 'arbee' ) ),
				arbee_f_image( 'header_logo', __( 'Logo', 'arbee' ), array( 'instructions' => __( 'Used in the header, mobile menu and page preloader. Shown at 240×50px in the header and 150×150px in the mobile menu/preloader.', 'arbee' ) ) ),
				arbee_f_text( 'header_quote_label', __( 'Header button text', 'arbee' ), array( 'instructions' => __( 'Opens the Request a Quote popup. Leave empty to hide the button.', 'arbee' ) ) ),

				// ---- Footer ----
				arbee_f_tab( __( 'Footer', 'arbee' ) ),
				arbee_f_image( 'footer_logo', __( 'Footer logo', 'arbee' ), array( 'instructions' => __( 'Landscape, recommended 170×60px (width-constrained, height scales automatically).', 'arbee' ) ) ),
				arbee_f_textarea( 'footer_about', __( 'About text', 'arbee' ), 3 ),
				arbee_f_text( 'footer_company_title', __( 'First menu column title', 'arbee' ), array( 'instructions' => __( 'Links are managed in Appearance → Menus (location “Footer: Company”).', 'arbee' ) ) ),
				arbee_f_text( 'footer_products_title', __( 'Second menu column title', 'arbee' ), array( 'instructions' => __( 'Links are managed in Appearance → Menus (location “Footer: Our Products”).', 'arbee' ) ) ),
				arbee_f( 'url', 'footer_map_url', __( 'Map button: Google Maps URL', 'arbee' ), array( 'instructions' => __( 'The icon and button text are fixed; the button only shows once this URL is set.', 'arbee' ) ) ),
				arbee_f_text( 'hq_title', __( 'Address title', 'arbee' ) ),
				arbee_f_textarea( 'hq_address', __( 'Address', 'arbee' ), 5, array( 'instructions' => __( 'Press Enter for a line break.', 'arbee' ) ) ),
				arbee_f_text( 'hq_phone_number', __( 'Displayed number', 'arbee' ), array( 'instructions' => __( 'Shown as-is and also used to build the tel: link (non-digits are stripped automatically). The icon is fixed; this line only shows once a number is set.', 'arbee' ) ) ),
				arbee_f( 'email', 'hq_email_address', __( 'Email address', 'arbee' ), array( 'instructions' => __( 'The icon is fixed; this line only shows once an address is set.', 'arbee' ) ) ),
				arbee_f_repeater(
					'footer_certifications',
					__( 'Certification logos', 'arbee' ),
					array(
						arbee_f_image( 'logo', __( 'Logo', 'arbee' ), array( 'wrapper' => array( 'width' => 40 ), 'instructions' => __( 'Landscape, recommended 120×60px.', 'arbee' ) ) ),
						arbee_f( 'url', 'url', __( 'Link (optional)', 'arbee' ), array( 'wrapper' => array( 'width' => 60 ) ) ),
					),
					array( 'layout' => 'table', 'button_label' => __( 'Add logo', 'arbee' ) )
				),
				arbee_f(
					'message',
					'footer_social_note',
					__( 'Social links', 'arbee' ),
					array( 'message' => __( 'Each icon is fixed to its platform; a link only appears once its URL below is filled in.', 'arbee' ) ),
				),
				arbee_f( 'url', 'social_facebook_url', __( 'Facebook URL', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f( 'url', 'social_instagram_url', __( 'Instagram URL', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f( 'url', 'social_linkedin_url', __( 'LinkedIn URL', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f( 'url', 'social_youtube_url', __( 'YouTube URL', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_group(
					'copyright',
					__( 'Copyright line', 'arbee' ),
					array(
						arbee_f_text( 'company', __( 'Company name', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ), 'instructions' => __( 'Shown as “© {current year} Company.”', 'arbee' ) ) ),
						arbee_f( 'url', 'url', __( 'Company link (optional)', 'arbee' ), array( 'wrapper' => array( 'width' => 35 ) ) ),
						arbee_f_text( 'suffix', __( 'Text after', 'arbee' ), array( 'wrapper' => array( 'width' => 35 ) ) ),
					)
				),
				arbee_f( 'message', 'credit_note', __( 'Designer credit', 'arbee' ), array( 'message' => __( 'This line is fixed and always shown in the footer — there is nothing to configure here.', 'arbee' ) ) ),

				// ---- Floating buttons ----
				arbee_f_tab( __( 'Floating buttons', 'arbee' ) ),
				arbee_f_text( 'floating_quote_label', __( 'Side “Request a Quote” tab text', 'arbee' ), array( 'instructions' => __( 'Leave empty to hide.', 'arbee' ) ) ),
				arbee_f_text( 'floating_phone', __( 'Call button number', 'arbee' ), array( 'instructions' => __( 'Leave empty to hide the call button.', 'arbee' ) ) ),
				arbee_f( 'email', 'floating_email', __( 'Mail button address', 'arbee' ), array( 'instructions' => __( 'Leave empty to hide the mail button.', 'arbee' ) ) ),

				// ---- Request a Quote popup ----
				arbee_f_tab( __( 'Quote popup', 'arbee' ) ),
				arbee_f_text( 'quote_title', __( 'Title', 'arbee' ) ),
				arbee_f_image( 'quote_image', __( 'Image', 'arbee' ), array( 'instructions' => __( 'Portrait, recommended 470×630px.', 'arbee' ) ) ),
				arbee_f_text( 'quote_label_name', __( 'Name label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_ph_name', __( 'Name placeholder', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_label_code', __( 'Country code label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_label_phone', __( 'Phone label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_ph_phone', __( 'Phone placeholder', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_label_email', __( 'Email label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_ph_email', __( 'Email placeholder', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_label_topic', __( 'Topic label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_textarea( 'quote_topics', __( 'Topic options', 'arbee' ), 4, array( 'instructions' => __( 'One option per line. The first one is selected by default - there is no separate placeholder option.', 'arbee' ), 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_label_comments', __( 'Comments label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_ph_comments', __( 'Comments placeholder', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_submit', __( 'Submit button text', 'arbee' ) ),

				// ---- Form delivery ----
				arbee_f_tab( __( 'Form delivery', 'arbee' ) ),
				arbee_f_text( 'mail_from_name', __( 'Default From name', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ), 'instructions' => __( 'Used site-wide (password resets, etc.) and as the fallback below. Falls back to the site title.', 'arbee' ) ) ),
				arbee_f( 'email', 'mail_from_email', __( 'Default From email', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ), 'instructions' => __( 'Falls back to the site admin email. If an SMTP plugin (e.g. WP Mail SMTP) is active, its own From Email setting takes priority.', 'arbee' ) ) ),
				arbee_f(
					'message',
					'form_delivery_note',
					__( 'Note', 'arbee' ),
					array( 'message' => __( 'Each form below can send from its own name/address and to its own recipients; leave a field empty to fall back to the defaults above (From) or the site admin email (To).', 'arbee' ) ),
				),
				arbee_f_text( 'contact_from_name', __( 'Contact form: From name', 'arbee' ), array( 'wrapper' => array( 'width' => 33 ) ) ),
				arbee_f( 'email', 'contact_from_email', __( 'Contact form: From email', 'arbee' ), array( 'wrapper' => array( 'width' => 33 ) ) ),
				arbee_f_text( 'contact_recipients', __( 'Contact form: Send to (To)', 'arbee' ), array( 'wrapper' => array( 'width' => 34 ), 'instructions' => __( 'One or more addresses, comma separated.', 'arbee' ) ) ),
				arbee_f_text( 'quote_from_name', __( 'Request a Quote: From name', 'arbee' ), array( 'wrapper' => array( 'width' => 33 ) ) ),
				arbee_f( 'email', 'quote_from_email', __( 'Request a Quote: From email', 'arbee' ), array( 'wrapper' => array( 'width' => 33 ) ) ),
				arbee_f_text( 'quote_recipients', __( 'Request a Quote: Send to (To)', 'arbee' ), array( 'wrapper' => array( 'width' => 34 ), 'instructions' => __( 'One or more addresses, comma separated.', 'arbee' ) ) ),
				arbee_f( 'message', 'enquiry_log_note', __( 'Note', 'arbee' ), array( 'message' => __( 'Every enquiry is also saved under Dashboard → Enquiries, regardless of email delivery.', 'arbee' ) ) ),
				arbee_f_textarea( 'enquiry_success_message', __( 'Thank-you message (shown on the page)', 'arbee' ), 2 ),
				arbee_f(
					'true_false',
					'enquiry_confirm_enabled',
					__( 'Also email the person who submitted the form', 'arbee' ),
					array( 'ui' => 1, 'default_value' => 1 )
				),
				arbee_f_textarea( 'enquiry_confirm_message', __( 'Confirmation email message', 'arbee' ), 4, array( 'instructions' => __( 'Leave empty for a sensible default. {name} and {site} are replaced automatically. The subject line always matches the admin notification email.', 'arbee' ) ) ),

				// ---- SEO ----
				arbee_f_tab( __( 'SEO', 'arbee' ) ),
				arbee_f( 'message', 'seo_note', __( 'Note', 'arbee' ), array( 'message' => __( 'These defaults are used when a page has no SEO description/image of its own. If an SEO plugin (Yoast, Rank Math, AIOSEO, SEOPress) is active, the theme stops printing these tags.', 'arbee' ) ) ),
				arbee_f_textarea( 'seo_default_description', __( 'Default meta description', 'arbee' ), 2 ),
				arbee_f_text( 'seo_author', __( 'Meta author', 'arbee' ) ),
				arbee_f_image( 'seo_default_og_image', __( 'Default social share image', 'arbee' ), array( 'instructions' => __( 'Recommended 1200×630px (standard social share size).', 'arbee' ) ) ),
				arbee_f_text( 'seo_production_url', __( 'Live production URL', 'arbee' ), array( 'instructions' => __( 'e.g. https://arbeeaquatic.com - any other host (staging, dev) automatically gets a noindex, nofollow tag.', 'arbee' ) ) ),

				// ---- 404 ----
				arbee_f_tab( __( '404 page', 'arbee' ) ),
				arbee_f_image( 'e404_image', __( 'Icon', 'arbee' ), array( 'instructions' => __( 'Square, recommended 300×300px.', 'arbee' ) ) ),
				arbee_f_text( 'e404_title', __( 'Title', 'arbee' ) ),
				arbee_f_textarea( 'e404_text', __( 'Text', 'arbee' ), 2 ),
				arbee_f_link( 'e404_button', __( 'Button', 'arbee' ) ),
			),
			$options_location
		);

		// ---- Menu item icon (header sub-menu items) ----
		arbee_acf_group(
			'menuitem',
			__( 'Menu item', 'arbee' ),
			array(
				arbee_f_image( 'menu_icon', __( 'Sub-menu icon', 'arbee' ), array( 'instructions' => __( 'Shown next to the label in the header drop-down, landscape, recommended 160×100px.', 'arbee' ) ) ),
			),
			array(
				array(
					array(
						'param'    => 'nav_menu_item',
						'operator' => '==',
						'value'    => 'location/primary',
					),
				),
			)
		);

		// ---- Inner page banner + breadcrumb (all inner templates, plus products) ----
		$banner_location = array();
		foreach ( array_keys( arbee_page_templates() ) as $template ) {
			$banner_location[] = arbee_loc_template( $template )[0];
		}
		$banner_location[] = arbee_loc_post_type( 'arbee_product' )[0];
		arbee_acf_group(
			'banner',
			__( 'Page banner & breadcrumb', 'arbee' ),
			array(
				arbee_f_image( 'banner_image', __( 'Banner image', 'arbee' ), array( 'required' => 1, 'instructions' => __( 'Landscape, recommended 1920×680px.', 'arbee' ) ) ),
				arbee_f_text( 'banner_title', __( 'Banner title', 'arbee' ), array( 'instructions' => __( 'Leave title and subtitle empty for a slim image-only banner (as on the Privacy page).', 'arbee' ) ) ),
				arbee_f_textarea( 'banner_subtitle', __( 'Banner subtitle', 'arbee' ), 2 ),
				arbee_f( 'message', 'breadcrumb_note', __( 'Breadcrumb', 'arbee' ), array( 'message' => __( 'The breadcrumb trail (Home → … → this page) is generated automatically from the primary menu structure and the page title — there is nothing to set here.', 'arbee' ) ) ),
			),
			$banner_location,
			array( 'menu_order' => 0 )
		);

		// ---- SEO (every page) ----
		arbee_acf_group(
			'seo',
			__( 'SEO', 'arbee' ),
			array(
				arbee_f_textarea( 'seo_description', __( 'Meta description', 'arbee' ), 2, array( 'maxlength' => 320 ) ),
				arbee_f_image( 'seo_og_image', __( 'Social share image', 'arbee' ), array( 'instructions' => __( 'Recommended 1200×630px (standard social share size).', 'arbee' ) ) ),
			),
			array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
				),
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'arbee_product',
					),
				),
			),
			array(
				'menu_order' => 100,
				'position'   => 'side',
			)
		);
	}
);
