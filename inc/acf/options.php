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
				arbee_f_image( 'header_logo', __( 'Logo', 'arbee' ), array( 'instructions' => __( 'Used in the header, mobile menu and page preloader.', 'arbee' ) ) ),
				arbee_f_text( 'header_quote_label', __( 'Header button text', 'arbee' ), array( 'instructions' => __( 'Opens the Request a Quote popup. Leave empty to hide the button.', 'arbee' ) ) ),

				// ---- Footer ----
				arbee_f_tab( __( 'Footer', 'arbee' ) ),
				arbee_f_image( 'footer_logo', __( 'Footer logo', 'arbee' ) ),
				arbee_f_textarea( 'footer_about', __( 'About text', 'arbee' ), 3 ),
				arbee_f_text( 'footer_company_title', __( 'First menu column title', 'arbee' ), array( 'instructions' => __( 'Links are managed in Appearance → Menus (location “Footer: Company”).', 'arbee' ) ) ),
				arbee_f_text( 'footer_products_title', __( 'Second menu column title', 'arbee' ), array( 'instructions' => __( 'Links are managed in Appearance → Menus (location “Footer: Our Products”).', 'arbee' ) ) ),
				arbee_f_group(
					'footer_map',
					__( 'Map button', 'arbee' ),
					array(
						arbee_f_image( 'icon', __( 'Icon', 'arbee' ), array( 'wrapper' => array( 'width' => 25 ) ) ),
						arbee_f_text( 'label', __( 'Text', 'arbee' ), array( 'wrapper' => array( 'width' => 35 ) ) ),
						arbee_f( 'url', 'url', __( 'Google Maps URL', 'arbee' ), array( 'wrapper' => array( 'width' => 40 ) ) ),
					)
				),
				arbee_f_text( 'hq_title', __( 'Address title', 'arbee' ) ),
				arbee_f_textarea( 'hq_address', __( 'Address', 'arbee' ), 5, array( 'instructions' => __( 'Press Enter for a line break.', 'arbee' ) ) ),
				arbee_f_group(
					'hq_phone',
					__( 'Phone', 'arbee' ),
					array(
						arbee_f_image( 'icon', __( 'Icon', 'arbee' ), array( 'wrapper' => array( 'width' => 25 ) ) ),
						arbee_f_text( 'label', __( 'Displayed number', 'arbee' ), array( 'wrapper' => array( 'width' => 35 ) ) ),
						arbee_f_text( 'number', __( 'Number to dial', 'arbee' ), array( 'wrapper' => array( 'width' => 40 ), 'instructions' => __( 'e.g. +914829237430', 'arbee' ) ) ),
					)
				),
				arbee_f_group(
					'hq_email',
					__( 'Email', 'arbee' ),
					array(
						arbee_f_image( 'icon', __( 'Icon', 'arbee' ), array( 'wrapper' => array( 'width' => 25 ) ) ),
						arbee_f( 'email', 'address', __( 'Email address', 'arbee' ), array( 'wrapper' => array( 'width' => 75 ) ) ),
					)
				),
				arbee_f_repeater(
					'footer_certifications',
					__( 'Certification logos', 'arbee' ),
					array(
						arbee_f_image( 'logo', __( 'Logo', 'arbee' ), array( 'wrapper' => array( 'width' => 40 ) ) ),
						arbee_f( 'url', 'url', __( 'Link (optional)', 'arbee' ), array( 'wrapper' => array( 'width' => 60 ) ) ),
					),
					array( 'layout' => 'table', 'button_label' => __( 'Add logo', 'arbee' ) )
				),
				arbee_f_repeater(
					'footer_social',
					__( 'Social links', 'arbee' ),
					array(
						arbee_f_image( 'icon', __( 'Icon', 'arbee' ), array( 'wrapper' => array( 'width' => 25 ) ) ),
						arbee_f_text( 'label', __( 'Network name', 'arbee' ), array( 'wrapper' => array( 'width' => 25 ), 'instructions' => __( 'For screen readers, e.g. LinkedIn', 'arbee' ) ) ),
						arbee_f( 'url', 'url', __( 'Profile URL', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
					),
					array( 'layout' => 'table', 'button_label' => __( 'Add social link', 'arbee' ) )
				),
				arbee_f_group(
					'copyright',
					__( 'Copyright line', 'arbee' ),
					array(
						arbee_f_text( 'company', __( 'Company name', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ), 'instructions' => __( 'Shown as “© {current year} Company.”', 'arbee' ) ) ),
						arbee_f( 'url', 'url', __( 'Company link (optional)', 'arbee' ), array( 'wrapper' => array( 'width' => 35 ) ) ),
						arbee_f_text( 'suffix', __( 'Text after', 'arbee' ), array( 'wrapper' => array( 'width' => 35 ) ) ),
					)
				),
				arbee_f_group(
					'credit',
					__( 'Designer credit', 'arbee' ),
					array(
						arbee_f_text( 'prefix', __( 'Text', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ) ) ),
						arbee_f_image( 'logo', __( 'Logo', 'arbee' ), array( 'wrapper' => array( 'width' => 20 ) ) ),
						arbee_f_text( 'name', __( 'Name', 'arbee' ), array( 'wrapper' => array( 'width' => 20 ) ) ),
						arbee_f( 'url', 'url', __( 'Link', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ) ) ),
					)
				),

				// ---- Floating buttons ----
				arbee_f_tab( __( 'Floating buttons', 'arbee' ) ),
				arbee_f_text( 'floating_quote_label', __( 'Side “Request a Quote” tab text', 'arbee' ), array( 'instructions' => __( 'Leave empty to hide.', 'arbee' ) ) ),
				arbee_f_text( 'floating_phone', __( 'Call button number', 'arbee' ), array( 'instructions' => __( 'Leave empty to hide the call button.', 'arbee' ) ) ),
				arbee_f( 'email', 'floating_email', __( 'Mail button address', 'arbee' ), array( 'instructions' => __( 'Leave empty to hide the mail button.', 'arbee' ) ) ),

				// ---- Request a Quote popup ----
				arbee_f_tab( __( 'Quote popup', 'arbee' ) ),
				arbee_f_text( 'quote_title', __( 'Title', 'arbee' ) ),
				arbee_f_image( 'quote_image', __( 'Image', 'arbee' ) ),
				arbee_f_text( 'quote_label_name', __( 'Name label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_ph_name', __( 'Name placeholder', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_label_code', __( 'Country code label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_label_phone', __( 'Phone label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_ph_phone', __( 'Phone placeholder', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_label_email', __( 'Email label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_ph_email', __( 'Email placeholder', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_label_topic', __( 'Topic label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_topic_placeholder', __( 'Topic placeholder (first, unselectable option)', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_textarea( 'quote_topics', __( 'Topic options', 'arbee' ), 4, array( 'instructions' => __( 'One option per line.', 'arbee' ), 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_label_comments', __( 'Comments label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_ph_comments', __( 'Comments placeholder', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'quote_submit', __( 'Submit button text', 'arbee' ) ),

				// ---- Form delivery ----
				arbee_f_tab( __( 'Form delivery', 'arbee' ) ),
				arbee_f_text( 'enquiry_recipients', __( 'Send enquiries to', 'arbee' ), array( 'instructions' => __( 'One or more email addresses, comma separated. Falls back to the site admin email. Every enquiry is also saved under Dashboard → Enquiries.', 'arbee' ) ) ),
				arbee_f_textarea( 'enquiry_success_message', __( 'Thank-you message', 'arbee' ), 2 ),

				// ---- SEO ----
				arbee_f_tab( __( 'SEO', 'arbee' ) ),
				arbee_f( 'message', 'seo_note', __( 'Note', 'arbee' ), array( 'message' => __( 'These defaults are used when a page has no SEO description/image of its own. If an SEO plugin (Yoast, Rank Math, AIOSEO, SEOPress) is active, the theme stops printing these tags.', 'arbee' ) ) ),
				arbee_f_textarea( 'seo_default_description', __( 'Default meta description', 'arbee' ), 2 ),
				arbee_f_text( 'seo_author', __( 'Meta author', 'arbee' ) ),
				arbee_f_image( 'seo_default_og_image', __( 'Default social share image', 'arbee' ) ),

				// ---- 404 ----
				arbee_f_tab( __( '404 page', 'arbee' ) ),
				arbee_f_image( 'e404_image', __( 'Icon', 'arbee' ) ),
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
				arbee_f_image( 'menu_icon', __( 'Sub-menu icon', 'arbee' ), array( 'instructions' => __( 'Shown next to the label in the header drop-down.', 'arbee' ) ) ),
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

		// ---- Inner page banner + breadcrumb (all inner templates) ----
		$banner_location = array();
		foreach ( array_keys( arbee_page_templates() ) as $template ) {
			$banner_location[] = arbee_loc_template( $template )[0];
		}
		arbee_acf_group(
			'banner',
			__( 'Page banner & breadcrumb', 'arbee' ),
			array(
				arbee_f_image( 'banner_image', __( 'Banner image', 'arbee' ) ),
				arbee_f_text( 'banner_title', __( 'Banner title', 'arbee' ), array( 'instructions' => __( 'Leave title and subtitle empty for a slim image-only banner (as on the Privacy page).', 'arbee' ) ) ),
				arbee_f_textarea( 'banner_subtitle', __( 'Banner subtitle', 'arbee' ), 2 ),
				arbee_f_repeater(
					'breadcrumb_parents',
					__( 'Breadcrumb: items between “Home” and this page', 'arbee' ),
					array(
						arbee_f_text( 'label', __( 'Label', 'arbee' ), array( 'wrapper' => array( 'width' => 40 ) ) ),
						arbee_f_text( 'url', __( 'URL', 'arbee' ), array( 'wrapper' => array( 'width' => 60 ), 'instructions' => __( 'Optional', 'arbee' ) ) ),
					),
					array( 'layout' => 'table', 'button_label' => __( 'Add crumb', 'arbee' ) )
				),
				arbee_f_text( 'breadcrumb_home', __( 'Breadcrumb: home label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'breadcrumb_label', __( 'Breadcrumb: this page label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ), 'instructions' => __( 'Defaults to the page title.', 'arbee' ) ) ),
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
				arbee_f_image( 'seo_og_image', __( 'Social share image', 'arbee' ) ),
			),
			array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
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
