<?php
/**
 * Page field groups â€” one group per page template, organised in tabs that
 * follow the section order of the original PHP pages.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

/**
 * Small repeater shorthands used across groups.
 */
function arbee_r_icon_text( $name, $label, $text_label = null, $extra = array() ) {
	return arbee_f_repeater(
		$name,
		$label,
		array(
			arbee_f_image( 'icon', __( 'Icon', 'arbee' ), array( 'wrapper' => array( 'width' => 25 ), 'instructions' => __( 'Square icon, recommended 80×80px.', 'arbee' ) ) ),
			arbee_f_textarea( 'text', $text_label ? $text_label : __( 'Text', 'arbee' ), 2, array( 'wrapper' => array( 'width' => 75 ), 'instructions' => __( 'Press Enter for a line break.', 'arbee' ) ) ),
		),
		array_merge( array( 'layout' => 'table' ), $extra )
	);
}

function arbee_r_icon_title_text( $name, $label, $extra = array() ) {
	return arbee_f_repeater(
		$name,
		$label,
		array(
			arbee_f_image( 'icon', __( 'Icon', 'arbee' ), array( 'wrapper' => array( 'width' => 20 ), 'instructions' => __( 'Square icon, recommended 100×100px.', 'arbee' ) ) ),
			arbee_f_textarea( 'title', __( 'Title', 'arbee' ), 2, array( 'wrapper' => array( 'width' => 30 ), 'instructions' => __( 'Press Enter for a line break.', 'arbee' ) ) ),
			arbee_f_textarea( 'text', __( 'Text', 'arbee' ), 2, array( 'wrapper' => array( 'width' => 50 ) ) ),
		),
		array_merge( array( 'layout' => 'table' ), $extra )
	);
}

function arbee_r_title_text( $name, $label, $extra = array() ) {
	return arbee_f_repeater(
		$name,
		$label,
		array(
			arbee_f_text( 'title', __( 'Title', 'arbee' ), array( 'wrapper' => array( 'width' => 40 ) ) ),
			arbee_f_textarea( 'text', __( 'Text', 'arbee' ), 2, array( 'wrapper' => array( 'width' => 60 ), 'instructions' => __( 'Press Enter for a line break.', 'arbee' ) ) ),
		),
		array_merge( array( 'layout' => 'table' ), $extra )
	);
}

function arbee_r_label_value( $name, $label, $extra = array() ) {
	return arbee_f_repeater(
		$name,
		$label,
		array(
			arbee_f_text( 'label', __( 'Label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
			arbee_f_text( 'value', __( 'Value', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
		),
		array_merge( array( 'layout' => 'table', 'button_label' => __( 'Add row', 'arbee' ) ), $extra )
	);
}

function arbee_r_countries( $name, $label ) {
	return arbee_f_repeater(
		$name,
		$label,
		array(
			arbee_f_text( 'name', __( 'Country', 'arbee' ), array( 'wrapper' => array( 'width' => 60 ) ) ),
			arbee_f_image( 'flag', __( 'Flag', 'arbee' ), array( 'wrapper' => array( 'width' => 40 ), 'instructions' => __( 'Landscape flag, recommended 90×60px.', 'arbee' ) ) ),
		),
		array( 'layout' => 'table', 'button_label' => __( 'Add country', 'arbee' ) )
	);
}

/**
 * "About / Trusted" section shared by the Home and About pages.
 */
function arbee_fields_trusted() {
	return arbee_section( __( 'About section', 'arbee' ), 'trusted_enabled', array(
		arbee_f_video( 'trusted_video', __( 'Background video', 'arbee' ) ),
		arbee_f_image( 'trusted_image_1', __( 'Image 1', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ), 'instructions' => __( 'Landscape, recommended 700×300px.', 'arbee' ) ) ),
		arbee_f_image( 'trusted_image_2', __( 'Image 2', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ), 'instructions' => __( 'Landscape, recommended 700×300px.', 'arbee' ) ) ),
		arbee_f_repeater(
			'trusted_qualities',
			__( 'Highlights slider', 'arbee' ),
			array(
				arbee_f_image( 'icon', __( 'Icon', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ), 'instructions' => __( 'Square icon, recommended 70×70px.', 'arbee' ) ) ),
				arbee_f_text( 'text', __( 'Text', 'arbee' ), array( 'wrapper' => array( 'width' => 70 ) ) ),
			),
			array( 'layout' => 'table' )
		),
		arbee_f_text( 'trusted_eyebrow', __( 'Eyebrow', 'arbee' ) ),
		arbee_f_heading( 'trusted_heading', __( 'Heading', 'arbee' ) ),
		arbee_f_heading( 'trusted_subheading', __( 'Subheading', 'arbee' ) ),
		arbee_f_paras( 'trusted_text', __( 'Text', 'arbee' ) ),
	) );
}

add_action(
	'acf/init',
	function () {

		/* ================================================================
		 * HOME (front page)  â€” index1.php
		 * ============================================================== */
		arbee_acf_group(
			'home',
			__( 'Homepage', 'arbee' ),
			array_merge(
				array(
					arbee_f_tab( __( 'Hero banner', 'arbee' ) ),
					arbee_f_repeater(
						'banner_slides',
						__( 'Slides', 'arbee' ),
						array(
							arbee_f_video( 'video', __( 'Background video', 'arbee' ), array( 'required' => 1 ) ),
							arbee_f_heading( 'title', __( 'Title', 'arbee' ) ),
							arbee_f_textarea( 'text', __( 'Text', 'arbee' ), 3 ),
							arbee_f_repeater(
								'buttons',
								__( 'Buttons', 'arbee' ),
								array( arbee_f_link( 'link', __( 'Button', 'arbee' ) ) ),
								array( 'layout' => 'table', 'button_label' => __( 'Add button', 'arbee' ) )
							),
						),
						array( 'button_label' => __( 'Add slide', 'arbee' ), 'collapsed' => 'field_home_banner_slides__title' )
					),
					arbee_f( 'message', 'banner_products_note', __( 'Product boxes (shown on every slide)', 'arbee' ), array( 'message' => __( 'Managed under Products in the admin menu — tick "Show in homepage hero" on each product. Order follows each product\'s Order field.', 'arbee' ) ) ),
				),
				arbee_fields_trusted(),
				arbee_section( __( 'Product snippet 2', 'arbee' ), 'snippet_enabled', array(
					arbee_f_text( 'snippet_title', __( 'Title', 'arbee' ) ),
					arbee_f_heading( 'snippet_text', __( 'Text', 'arbee' ) ),
					arbee_f( 'message', 'snippet_items_note', __( 'Product slides', 'arbee' ), array( 'message' => __( 'Managed under Products in the admin menu — tick "Show in homepage product snippet" on each product.', 'arbee' ) ) ),
				) ),
				arbee_section( __( 'Why Arbee', 'arbee' ), 'why_enabled', array(
					arbee_r_icon_title_text( 'why_items', __( 'Highlights', 'arbee' ), array( 'max' => 4 ) ),
					arbee_f_text( 'why_title', __( 'Title', 'arbee' ) ),
					arbee_f_textarea( 'why_text', __( 'Text', 'arbee' ), 5 ),
					arbee_f_link( 'why_button', __( 'Button', 'arbee' ) ),
				) ),
				arbee_section( __( 'Certifications', 'arbee' ), 'members_enabled', array(
					arbee_f_text( 'members_title', __( 'Title', 'arbee' ) ),
					arbee_f_textarea( 'members_text', __( 'Text', 'arbee' ), 2 ),
					arbee_f_video( 'members_video', __( 'Video', 'arbee' ) ),
					arbee_r_icon_title_text( 'members_items', __( 'Certifications & memberships', 'arbee' ), array( 'instructions' => __( 'Shown in two columns: the first half of the list on the left, the rest on the right.', 'arbee' ), 'max' => 5 ) ),
				) ),
				arbee_section( __( 'Global presence', 'arbee' ), 'globe_enabled', array(
					arbee_f_text( 'globe_title', __( 'Title', 'arbee' ) ),
					arbee_f_textarea( 'globe_text', __( 'Text', 'arbee' ), 2 ),
					arbee_f_link( 'globe_button', __( 'Button', 'arbee' ) ),
					arbee_f_image( 'globe_image', __( 'Globe image', 'arbee' ), array( 'instructions' => __( 'Square, recommended 580×580px.', 'arbee' ) ) ),
					arbee_f_repeater(
						'globe_groups',
						__( 'Export groups (accordion)', 'arbee' ),
						array(
							arbee_f_image( 'icon', __( 'Image', 'arbee' ), array( 'wrapper' => array( 'width' => 20 ), 'instructions' => __( 'Square icon, recommended 50×50px.', 'arbee' ) ) ),
							arbee_f_text( 'title', __( 'Title', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ) ) ),
							arbee_f_text( 'subtitle', __( 'Subtitle', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ) ) ),
							arbee_f( 'true_false', 'open', __( 'Open by default', 'arbee' ), array( 'ui' => 1, 'wrapper' => array( 'width' => 20 ) ) ),
							arbee_r_countries( 'countries', __( 'Countries', 'arbee' ) ),
						),
						array( 'button_label' => __( 'Add group', 'arbee' ), 'collapsed' => 'field_home_globe_groups__title' )
					),
				) ),
				arbee_section( __( 'Manufacturing process', 'arbee' ), 'mfg_enabled', array(
					arbee_f_heading( 'mfg_title', __( 'Title', 'arbee' ) ),
					arbee_f_textarea( 'mfg_text', __( 'Text', 'arbee' ), 2 ),
					arbee_r_icon_title_text( 'mfg_steps', __( 'Steps (numbered automatically)', 'arbee' ) ),
				) ),
				arbee_section( __( 'Sustainability', 'arbee' ), 'ocean_enabled', array(
					arbee_f_image( 'ocean_image', __( 'Background image', 'arbee' ), array( 'instructions' => __( 'Landscape, recommended 1920×700px.', 'arbee' ) ) ),
					arbee_f_heading( 'ocean_title', __( 'Title', 'arbee' ), array( 'instructions' => __( 'Wrap a word in <span>â€¦</span> to show it in green.', 'arbee' ) ) ),
					arbee_f_textarea( 'ocean_text', __( 'Text', 'arbee' ), 3 ),
					arbee_f_link( 'ocean_button', __( 'Button', 'arbee' ) ),
					arbee_r_icon_text( 'ocean_items', __( 'Highlights', 'arbee' ), null, array( 'max' => 9 ) ),
				) ),
				arbee_section( __( 'Contact banner', 'arbee' ), 'cta_enabled', array(
					arbee_f_textarea( 'cta_title', __( 'Title', 'arbee' ), 2 ),
					arbee_f_textarea( 'cta_text', __( 'Text', 'arbee' ), 2 ),
					arbee_f_link( 'cta_button', __( 'Button', 'arbee' ) ),
					arbee_f_image( 'cta_image', __( 'Image', 'arbee' ), array( 'instructions' => __( 'Landscape, recommended 700×450px.', 'arbee' ) ) ),
				) )
			),
			arbee_loc_front_page()
		);

		/* ================================================================
		 * ABOUT â€” about.php
		 * ============================================================== */
		arbee_acf_group(
			'about',
			__( 'About page', 'arbee' ),
			array_merge(
				arbee_fields_trusted(),
				arbee_section( __( 'Factory', 'arbee' ), 'factory_enabled', array(
					arbee_f_text( 'factory_eyebrow', __( 'Eyebrow', 'arbee' ) ),
					arbee_f_heading( 'factory_title', __( 'Title', 'arbee' ) ),
					arbee_f_paras( 'factory_text', __( 'Text', 'arbee' ) ),
					arbee_f_image( 'factory_image', __( 'Image', 'arbee' ), array( 'instructions' => __( 'Portrait/landscape, recommended min 900×600px (crops to fill).', 'arbee' ) ) ),
				) ),
				arbee_section( __( 'Arbee Group', 'arbee' ), 'group_enabled', array(
					arbee_f_heading( 'group_title', __( 'Title', 'arbee' ) ),
					arbee_f_heading( 'group_intro', __( 'Intro', 'arbee' ) ),
					arbee_f_textarea( 'group_text', __( 'Text', 'arbee' ), 3 ),
					arbee_f_repeater(
						'group_companies',
						__( 'Group companies (carousel)', 'arbee' ),
						array(
							arbee_f_image( 'image', __( 'Image', 'arbee' ), array( 'wrapper' => array( 'width' => 20 ), 'instructions' => __( 'Landscape, recommended 300×200px.', 'arbee' ) ) ),
							arbee_f_text( 'name', __( 'Name', 'arbee' ), array( 'wrapper' => array( 'width' => 25 ) ) ),
							arbee_f_text( 'description', __( 'Description', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ) ) ),
						),
						array( 'layout' => 'table', 'button_label' => __( 'Add company', 'arbee' ) )
					),
				) ),
				arbee_section( __( 'Vision & Mission', 'arbee' ), 'vm_enabled', array(
					arbee_f_image( 'vm_image', __( 'Image', 'arbee' ), array( 'instructions' => __( 'Portrait/landscape, recommended min 900×650px (crops to fill).', 'arbee' ) ) ),
					arbee_f_text( 'vm_title', __( 'Title', 'arbee' ) ),
					arbee_f_image( 'vision_icon', __( 'Vision icon', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ), 'instructions' => __( 'Square icon, recommended 80×80px.', 'arbee' ) ) ),
					arbee_f_text( 'vision_title', __( 'Vision title', 'arbee' ), array( 'wrapper' => array( 'width' => 70 ) ) ),
					arbee_f_textarea( 'vision_text', __( 'Vision text', 'arbee' ), 3 ),
					arbee_f_image( 'mission_icon', __( 'Mission icon', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ), 'instructions' => __( 'Square icon, recommended 80×80px.', 'arbee' ) ) ),
					arbee_f_text( 'mission_title', __( 'Mission title', 'arbee' ), array( 'wrapper' => array( 'width' => 70 ) ) ),
					arbee_f_textarea( 'mission_text', __( 'Mission text', 'arbee' ), 3 ),
				) ),
				arbee_section( __( "Nature'sprotein", 'arbee' ), 'nature_enabled', array(
					arbee_f_heading( 'nature_title', __( 'Title', 'arbee' ) ),
					arbee_f_paras( 'nature_text', __( 'Text', 'arbee' ) ),
					arbee_f_image( 'nature_image', __( 'Image', 'arbee' ), array( 'instructions' => __( 'Portrait/landscape, recommended min 900×600px (crops to fill).', 'arbee' ) ) ),
				) ),
				arbee_section( __( 'Feed Performance', 'arbee' ), 'perf_enabled', array(
					arbee_f_heading( 'perf_title', __( 'Title', 'arbee' ) ),
					arbee_f_paras( 'perf_text', __( 'Text', 'arbee' ) ),
					arbee_f_image( 'perf_image', __( 'Image', 'arbee' ), array( 'instructions' => __( 'Portrait/landscape, recommended min 900×640px (crops to fill).', 'arbee' ) ) ),
				) )
			),
			arbee_loc_template( 'page-templates/template-about.php' ),
			array( 'menu_order' => 10 )
		);

		/* ================================================================
		 * WHY ARBEE â€” why-arbee.php
		 * ============================================================== */
		arbee_acf_group(
			'why',
			__( 'Why Arbee page', 'arbee' ),
			array_merge(
				arbee_section( __( 'Freshness advantage', 'arbee' ), 'fresh_enabled', array(
					arbee_f_heading( 'fresh_title', __( 'Title', 'arbee' ) ),
					arbee_f_paras( 'fresh_text', __( 'Text', 'arbee' ) ),
					arbee_r_title_text( 'fresh_items', __( 'Benefits', 'arbee' ), array( 'max' => 4 ) ),
					arbee_f_image( 'fresh_image', __( 'Image', 'arbee' ), array( 'instructions' => __( 'Portrait, recommended min 700×1000px (crops to fill).', 'arbee' ) ) ),
				) ),
				arbee_section( __( 'Group expertise', 'arbee' ), 'exp_enabled', array(
					arbee_f_heading( 'exp_title', __( 'Title', 'arbee' ) ),
					arbee_f_paras( 'exp_text', __( 'Text', 'arbee' ) ),
					arbee_f_text( 'exp_cert_title', __( 'Certifications title', 'arbee' ) ),
					arbee_r_title_text( 'exp_certs', __( 'Certifications', 'arbee' ), array( 'max' => 5 ) ),
				) ),
				arbee_section( __( 'Export-ready & Quality commitments', 'arbee' ), 'export_quality_enabled', array_merge(
					array(
						arbee_f( 'true_false', 'export_enabled', __( 'Show: Export-ready supply chain', 'arbee' ), array( 'ui' => 1, 'default_value' => 1, 'wrapper' => array( 'width' => 50 ) ) ),
					),
					arbee_cond_on( 'export_quality_enabled', 'export_enabled', array(
						arbee_f_heading( 'export_title', __( 'Export-ready: Title', 'arbee' ) ),
						arbee_f_paras( 'export_text', __( 'Export-ready: Text', 'arbee' ) ),
						arbee_f_repeater(
							'export_checklist',
							__( 'Export-ready: Checklist', 'arbee' ),
							array( arbee_f_text( 'text', __( 'Text', 'arbee' ) ) ),
							array( 'layout' => 'table', 'max' => 5 )
						),
						arbee_f_image( 'export_global_icon', __( 'Export-ready: Distribution icon', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ), 'instructions' => __( 'Square icon, recommended 80×80px.', 'arbee' ) ) ),
						arbee_f_text( 'export_global_title', __( 'Export-ready: Distribution title', 'arbee' ), array( 'wrapper' => array( 'width' => 70 ) ) ),
						arbee_f_textarea( 'export_global_text', __( 'Export-ready: Distribution text', 'arbee' ), 2 ),
					) ),
					array(
						arbee_f( 'true_false', 'quality_enabled', __( 'Show: Quality commitments', 'arbee' ), array( 'ui' => 1, 'default_value' => 1, 'wrapper' => array( 'width' => 50 ) ) ),
					),
					arbee_cond_on( 'export_quality_enabled', 'quality_enabled', array(
						arbee_f_text( 'quality_title', __( 'Quality: Title', 'arbee' ) ),
						arbee_f_paras( 'quality_text', __( 'Quality: Text', 'arbee' ) ),
						arbee_f_text( 'quality_col1', __( 'Quality: Table first column heading', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
						arbee_f_text( 'quality_col2', __( 'Quality: Table second column heading', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
						arbee_r_label_value( 'quality_rows', __( 'Quality: Table rows', 'arbee' ) ),
						arbee_f_textarea( 'quality_note', __( 'Quality: Note under the table', 'arbee' ), 2 ),
					) )
				) ),
				arbee_section( __( 'Advantages of fish meal', 'arbee' ), 'meal_enabled', array(
					arbee_r_icon_title_text( 'benefits', __( 'Benefit cards', 'arbee' ), array( 'instructions' => __( 'Shown in rows of two.', 'arbee' ), 'max' => 4 ) ),
					arbee_f_heading( 'meal_title', __( 'Title', 'arbee' ) ),
					arbee_f_paras( 'meal_text', __( 'Text', 'arbee' ) ),
				) ),
				arbee_section( __( 'Certifications', 'arbee' ), 'cert_enabled', array(
					arbee_f_text( 'cert_title', __( 'Title', 'arbee' ) ),
					arbee_f(
						'gallery',
						'cert_logos',
						__( 'Logos (slider)', 'arbee' ),
						array(
							'return_format' => 'id',
							'preview_size'  => 'thumbnail',
							'library'       => 'all',
						)
					),
				) )
			),
			arbee_loc_template( 'page-templates/template-why-arbee.php' ),
			array( 'menu_order' => 10 )
		);

		/* ================================================================
		 * PRODUCT DETAIL PAGE CONTENT â€” applies to every arbee_product post
		 * (single-arbee_product.php). Originally fish-meal.php.
		 * ============================================================== */
		arbee_acf_group(
			'fishmeal',
			__( 'Product page content', 'arbee' ),
			array_merge(
				arbee_section( __( 'Introduction', 'arbee' ), 'intro_enabled', array(
					arbee_f_heading( 'intro_title', __( 'Title', 'arbee' ) ),
					arbee_f_text( 'intro_subtitle', __( 'Subtitle', 'arbee' ) ),
					arbee_f_paras( 'intro_text', __( 'Text', 'arbee' ) ),
					arbee_f_image( 'intro_image', __( 'Image', 'arbee' ), array( 'instructions' => __( 'Portrait/landscape, recommended min 900×600px (crops to fill).', 'arbee' ) ) ),
				) ),
				arbee_section( __( 'Product range', 'arbee' ), 'grades_enabled', array(
				arbee_f_text( 'range_title', __( 'Product range title', 'arbee' ) ),
				arbee_f_repeater(
					'grades',
					__( 'Grades (tabs)', 'arbee' ),
					array(
						arbee_f_text( 'tab_label', __( 'Tab label', 'arbee' ), array( 'wrapper' => array( 'width' => 34 ) ) ),
						arbee_f_text( 'name', __( 'Grade name', 'arbee' ), array( 'wrapper' => array( 'width' => 33 ) ) ),
						arbee_f_text( 'title', __( 'Title', 'arbee' ), array( 'wrapper' => array( 'width' => 33 ) ) ),
						arbee_f_heading( 'subtitle', __( 'Subtitle', 'arbee' ) ),
						arbee_f_paras( 'text', __( 'Text', 'arbee' ) ),
						arbee_f_text( 'spec_title', __( 'Specification title', 'arbee' ) ),
						arbee_r_label_value( 'specs', __( 'Specifications', 'arbee' ) ),
						arbee_f_text( 'param_title', __( 'Parameters title', 'arbee' ) ),
						arbee_r_label_value( 'params', __( 'Parameters', 'arbee' ) ),
					),
					array( 'button_label' => __( 'Add grade', 'arbee' ), 'collapsed' => 'field_fishmeal_grades__tab_label' )
				),
				) ),
				arbee_section( __( 'Source species', 'arbee' ), 'source_enabled', array(
					arbee_f_image( 'source_image', __( 'Image', 'arbee' ), array( 'instructions' => __( 'Landscape, recommended min 900×600px (crops to fill).', 'arbee' ) ) ),
					arbee_f_text( 'source_title', __( 'Title', 'arbee' ) ),
					arbee_f_text( 'source_subtitle', __( 'Subtitle', 'arbee' ) ),
					arbee_f_paras( 'source_text', __( 'Text', 'arbee' ) ),
				) ),
				arbee_section( __( 'Packaging & Certifications', 'arbee' ), 'pack_cert_enabled', array_merge(
					array(
						arbee_f( 'true_false', 'pack_enabled', __( 'Show: Packaging', 'arbee' ), array( 'ui' => 1, 'default_value' => 1, 'wrapper' => array( 'width' => 50 ) ) ),
						arbee_f( 'true_false', 'cert_enabled', __( 'Show: Certifications', 'arbee' ), array( 'ui' => 1, 'default_value' => 1, 'wrapper' => array( 'width' => 50 ) ) ),
					),
					arbee_cond_on( 'pack_cert_enabled', 'pack_enabled', array(
						arbee_f_text( 'pack_title', __( 'Title', 'arbee' ), array( 'instructions' => __( 'The icon is fixed.', 'arbee' ) ) ),
						arbee_f_text( 'pack_subtitle', __( 'Subtitle', 'arbee' ) ),
						arbee_f_repeater(
							'pack_sizes',
							__( 'Package sizes', 'arbee' ),
							array(
								arbee_f_image( 'icon', __( 'Icon', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ), 'instructions' => __( 'Square icon, recommended 50×50px.', 'arbee' ) ) ),
								arbee_f_text( 'weight', __( 'Weight', 'arbee' ), array( 'wrapper' => array( 'width' => 35 ) ) ),
								arbee_f_text( 'type', __( 'Type', 'arbee' ), array( 'wrapper' => array( 'width' => 35 ) ) ),
							),
							array( 'layout' => 'table', 'max' => 3 )
						),
						arbee_r_label_value( 'pack_meta', __( 'Details', 'arbee' ) ),
					) ),
					arbee_cond_on( 'pack_cert_enabled', 'cert_enabled', array(
						arbee_f_text( 'cert_title', __( 'Title', 'arbee' ), array( 'instructions' => __( 'The icon is fixed.', 'arbee' ) ) ),
						arbee_f_text( 'cert_subtitle', __( 'Subtitle', 'arbee' ) ),
						arbee_f_repeater(
							'cert_logos',
							__( 'Logos (carousel)', 'arbee' ),
							array(
								arbee_f_image( 'logo', __( 'Logo', 'arbee' ), array( 'wrapper' => array( 'width' => 40 ), 'instructions' => __( 'Landscape, recommended 160×80px.', 'arbee' ) ) ),
								arbee_f( 'url', 'url', __( 'Link (optional)', 'arbee' ), array( 'wrapper' => array( 'width' => 60 ) ) ),
							),
							array( 'layout' => 'table', 'button_label' => __( 'Add logo', 'arbee' ) )
						),
					) )
				) ),
				arbee_section( __( 'Processing method', 'arbee' ), 'process_enabled', array(
					arbee_f_text( 'process_title', __( 'Title', 'arbee' ) ),
					arbee_f_text( 'process_subtitle', __( 'Subtitle', 'arbee' ) ),
					arbee_r_icon_title_text( 'process_steps', __( 'Steps', 'arbee' ), array( 'max' => 4 ) ),
					arbee_f_link( 'process_button', __( 'Button', 'arbee' ) ),
				) ),
				arbee_section( __( 'Export markets', 'arbee' ), 'markets_enabled', array(
					arbee_f_text( 'markets_title', __( 'Title', 'arbee' ) ),
					arbee_f_textarea( 'markets_text', __( 'Text', 'arbee' ), 2 ),
					arbee_r_countries( 'markets', __( 'Countries (slider)', 'arbee' ) ),
				) ),
				arbee_section( __( 'Uses', 'arbee' ), 'uses_enabled', array(
				arbee_f_text( 'uses_title', __( 'Title', 'arbee' ) ),
				arbee_r_title_text( 'uses', __( 'Uses (slider)', 'arbee' ) ),
				) ),
				arbee_section( __( 'Applications', 'arbee' ), 'apps_enabled', array(
				arbee_f_text( 'apps_title', __( 'Applications title', 'arbee' ) ),
				arbee_r_icon_text( 'apps', __( 'Applications (slider)', 'arbee' ) ),
				) ),
				arbee_section( __( 'Call to action', 'arbee' ), 'cta_enabled', array(
					arbee_f_text( 'cta_title', __( 'Title', 'arbee' ) ),
					arbee_f_heading( 'cta_text', __( 'Text', 'arbee' ) ),
					arbee_f_link( 'cta_button', __( 'Button', 'arbee' ) ),
				) ),
				arbee_section( __( 'Keywords', 'arbee' ), 'keywords_enabled', array(
					arbee_f_textarea( 'keywords', __( 'Keyword line at the bottom of the page', 'arbee' ), 3, array( 'instructions' => __( 'Leave empty to hide the line.', 'arbee' ) ) ),
				) )
			),
			arbee_loc_post_type( 'arbee_product' ),
			array( 'menu_order' => 20 )
		);

		/* ================================================================
		 * TECHNOLOGY â€” technology.php
		 * ============================================================== */
		$node = function ( $name, $label, $extra_fields = array(), $popup = array() ) {
			return arbee_f_group(
				$name,
				$label,
				array_merge(
					array(
						arbee_f_image( 'icon', __( 'Icon', 'arbee' ), array( 'wrapper' => array( 'width' => 25 ), 'instructions' => __( 'Square icon, recommended 60×60px.', 'arbee' ) ) ),
						arbee_f_textarea( 'title', __( 'Title', 'arbee' ), 2, array( 'wrapper' => array( 'width' => 50 ), 'instructions' => __( 'Press Enter for a line break.', 'arbee' ) ) ),
						arbee_f_text( 'number', __( 'Step number', 'arbee' ), array( 'wrapper' => array( 'width' => 25 ) ) ),
						arbee_f_text( 'popup_title', __( 'Info box title', 'arbee' ), array( 'default_value' => arbee_v( $popup, 'title' ) ) ),
						arbee_f_textarea( 'popup_text', __( 'Info box text', 'arbee' ), 3, array( 'default_value' => arbee_v( $popup, 'text' ) ) ),
					),
					$extra_fields
				)
			);
		};

		arbee_acf_group(
			'tech',
			__( 'Technology & Process page', 'arbee' ),
			array_merge(
				arbee_section( __( 'Introduction', 'arbee' ), 'intro_enabled', array(
					arbee_f_heading( 'intro_title', __( 'Title', 'arbee' ) ),
					arbee_f_paras( 'intro_text', __( 'Text', 'arbee' ) ),
				) ),
				arbee_section( __( 'Process diagram', 'arbee' ), 'diagram_enabled', array(
				arbee_f_heading( 'process_title', __( 'Process diagram title', 'arbee' ) ),
				arbee_f( 'message', 'diagram_note', __( 'About the diagram', 'arbee' ), array( 'message' => __( 'The diagram layout is fixed: each box below is one position in the flow chart. You can change icons, labels and numbers; clearing a title hides that box.', 'arbee' ) ) ),
				$node( 'raw_fish', __( '1 Â· Raw fish', 'arbee' ), array( arbee_f_text( 'subtitle', __( 'Subtitle', 'arbee' ) ) ) ),
				$node(
					'metal_detector',
					__( '2 Â· Metal detector', 'arbee' ),
					array(),
					array(
						'title' => __( 'Metal Detector', 'arbee' ),
						'text'  => __( 'All incoming fish pass through an industrial-grade metal detector to eliminate foreign metallic objects, ensuring safety and compliance before processing begins.', 'arbee' ),
					)
				),
				$node( 'cooker', __( '3 Â· Cooker', 'arbee' ) ),
				$node(
					'press',
					__( '4 Â· Mechanical press', 'arbee' ),
					array(),
					array(
						'title' => __( 'Mechanical Press', 'arbee' ),
						'text'  => __( 'The cooked fish mass is fed into a twin-screw press that mechanically squeezes out the press liquid (oil + water), separating it from the solid press cake.', 'arbee' ),
					)
				),
				$node( 'press_liquid', __( 'Oil line Â· Press liquid', 'arbee' ) ),
				$node( 'decanter', __( 'Oil line Â· Decanter', 'arbee' ) ),
				$node( 'oil_separator', __( 'Oil line Â· Oil separator', 'arbee' ) ),
				$node( 'oil', __( 'Oil line Â· Oil', 'arbee' ) ),
				$node( 'crude_oil', __( 'Oil line Â· Crude fish oil (end product)', 'arbee' ) ),
				$node( 'press_cake', __( 'Meal line Â· Press cake', 'arbee' ) ),
				$node( 'dryer', __( 'Meal line Â· Dryer', 'arbee' ) ),
				$node( 'hammer_mill', __( 'Meal line Â· Hammer mill', 'arbee' ) ),
				$node( 'cooler', __( 'Meal line Â· Cooler', 'arbee' ) ),
				$node( 'siever', __( 'Meal line Â· Siever', 'arbee' ) ),
				$node( 'fish_meal', __( 'Meal line Â· Fish meal (end product)', 'arbee' ) ),
				) )
			),
			arbee_loc_template( 'page-templates/template-technology.php' ),
			array( 'menu_order' => 10 )
		);

		/* ================================================================
		 * SUSTAINABILITY â€” sustainability.php
		 * ============================================================== */
		arbee_acf_group(
			'sustain',
			__( 'Sustainability page', 'arbee' ),
			array_merge(
				arbee_section( __( 'Introduction', 'arbee' ), 'intro_enabled', array(
				arbee_f_heading( 'intro_title', __( 'Title', 'arbee' ), array( 'instructions' => __( 'Press Enter for a line break. Wrap words in <span class="blueclrgat">â€¦</span> (blue) or <span class="greenclrgat">â€¦</span> (green).', 'arbee' ) ) ),
					arbee_f_text( 'intro_subtitle', __( 'Subtitle', 'arbee' ) ),
					arbee_f_paras( 'intro_text', __( 'Text', 'arbee' ) ),
					arbee_f_image( 'intro_image', __( 'Image', 'arbee' ), array( 'instructions' => __( 'Portrait/landscape, recommended min 700×650px (crops to fill).', 'arbee' ) ) ),
				) ),
				arbee_section( __( 'Clean manufacturing', 'arbee' ), 'clean_enabled', array(
					arbee_f_heading( 'clean_title', __( 'Title', 'arbee' ) ),
					arbee_f_paras( 'clean_text', __( 'Text', 'arbee' ) ),
					arbee_r_icon_title_text( 'clean_items', __( 'Highlights', 'arbee' ), array( 'max' => 2 ) ),
				) ),
				arbee_section( __( 'Commitments', 'arbee' ), 'commit_enabled', array(
					arbee_f_heading( 'commit_title', __( 'Title', 'arbee' ) ),
					arbee_r_title_text( 'commitments', __( 'Commitments (numbered automatically)', 'arbee' ) ),
				) )
			),
			arbee_loc_template( 'page-templates/template-sustainability.php' ),
			array( 'menu_order' => 10 )
		);

		/* ================================================================
		 * GLOBAL EXPORTS â€” global-exports.php
		 * ============================================================== */
		arbee_acf_group(
			'global',
			__( 'Global Exports page', 'arbee' ),
			array_merge(
				arbee_section( __( 'Fish meal markets', 'arbee' ), 'fm_enabled', array(
					arbee_f_heading( 'fm_title', __( 'Title', 'arbee' ) ),
					arbee_f_paras( 'fm_text', __( 'Text', 'arbee' ) ),
					arbee_f_repeater(
						'fm_grades',
						__( 'Grade list', 'arbee' ),
						array( arbee_f_text( 'text', __( 'Text', 'arbee' ) ) ),
						array( 'layout' => 'table' )
					),
					arbee_f_text( 'fm_col1', __( 'Table: first column heading', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
					arbee_f_text( 'fm_col2', __( 'Table: second column heading', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
					arbee_r_label_value( 'fm_rows', __( 'Table rows', 'arbee' ) ),
				) ),
				arbee_section( __( 'Crude fish oil markets', 'arbee' ), 'oil_enabled', array(
					arbee_f_heading( 'oil_title', __( 'Title', 'arbee' ) ),
					arbee_f_heading( 'oil_text', __( 'Text', 'arbee' ) ),
					arbee_f_repeater(
						'oil_regions',
						__( 'Regions', 'arbee' ),
						array(
							arbee_f_image( 'map', __( 'Map icon', 'arbee' ), array( 'wrapper' => array( 'width' => 30 ), 'instructions' => __( 'Square icon, recommended 60×60px.', 'arbee' ) ) ),
							arbee_f_text( 'name', __( 'Region', 'arbee' ), array( 'wrapper' => array( 'width' => 70 ) ) ),
							arbee_r_countries( 'countries', __( 'Countries', 'arbee' ) ),
						),
						array( 'button_label' => __( 'Add region', 'arbee' ), 'collapsed' => 'field_global_oil_regions__name' )
					),
					arbee_f_text( 'apps_title', __( 'Applications title', 'arbee' ) ),
					arbee_r_icon_text( 'apps', __( 'Applications', 'arbee' ), __( 'Title', 'arbee' ) ),
				) ),
				arbee_section( __( 'Logistics & documentation', 'arbee' ), 'log_enabled', array(
					arbee_f_image( 'log_image', __( 'Image', 'arbee' ), array( 'instructions' => __( 'Landscape, recommended min 900×620px (crops to fill).', 'arbee' ) ) ),
					arbee_f_heading( 'log_title', __( 'Title', 'arbee' ) ),
					arbee_f_paras( 'log_text', __( 'Text', 'arbee' ) ),
					arbee_r_icon_text( 'log_docs', __( 'Documents', 'arbee' ), __( 'Title', 'arbee' ), array( 'max' => 6 ) ),
				) ),
				arbee_section( __( 'Call to action', 'arbee' ), 'cta_enabled', array(
					arbee_f_text( 'cta_title', __( 'Title', 'arbee' ) ),
					arbee_f_heading( 'cta_text', __( 'Text', 'arbee' ) ),
					arbee_f_link( 'cta_button', __( 'Button', 'arbee' ) ),
				) )
			),
			arbee_loc_template( 'page-templates/template-global-exports.php' ),
			array( 'menu_order' => 10 )
		);

		/* ================================================================
		 * CONTACT â€” contact.php
		 * ============================================================== */
		arbee_acf_group(
			'contact',
			__( 'Contact page', 'arbee' ),
			array_merge(
				arbee_section( __( 'Enquiry form', 'arbee' ), 'form_enabled', array(
				arbee_f_text( 'form_title', __( 'Title', 'arbee' ) ),
				arbee_f_textarea( 'form_text', __( 'Text', 'arbee' ), 2 ),
				arbee_f_text( 'form_label_name', __( 'Name label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'form_ph_name', __( 'Name placeholder', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'form_label_phone', __( 'Phone label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'form_ph_phone', __( 'Phone placeholder', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'form_label_email', __( 'Email label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'form_ph_email', __( 'Email placeholder', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'form_label_topic', __( 'Topic label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_textarea( 'form_topics', __( 'Topic options', 'arbee' ), 3, array( 'instructions' => __( 'One option per line.', 'arbee' ), 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'form_label_comments', __( 'Comments label', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'form_ph_comments', __( 'Comments placeholder', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'form_submit', __( 'Submit button text', 'arbee' ) ),
				) ),
				arbee_section( __( 'Get in touch', 'arbee' ), 'touch_enabled', array(
					arbee_f_heading( 'touch_title', __( 'Title', 'arbee' ) ),
				arbee_f_textarea( 'touch_text', __( 'Text', 'arbee' ), 2 ),
				arbee_f_textarea( 'factory_address', __( 'Factory address', 'arbee' ), 3, array( 'instructions' => __( 'The factory icon and title are fixed; this block only shows once an address is set. Press Enter for a line break.', 'arbee' ) ) ),
				arbee_f(
					'message',
					'touch_items_note',
					__( 'Contact details', 'arbee' ),
					array( 'message' => __( 'Each icon and label below is fixed; a line only shows once its value is filled in.', 'arbee' ) ),
				),
				arbee_f_text( 'touch_hq_value', __( 'Headquarters', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'touch_hq_url', __( 'Headquarters: Link (optional)', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'touch_email_value', __( 'Email', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'touch_email_url', __( 'Email: Link (optional)', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ), 'instructions' => __( 'e.g. mailto:name@example.com', 'arbee' ) ) ),
				arbee_f_text( 'touch_phone_value', __( 'Phone', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'touch_phone_url', __( 'Phone: Link (optional)', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ), 'instructions' => __( 'e.g. tel:+91…', 'arbee' ) ) ),
				arbee_f_text( 'touch_website_value', __( 'Website', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'touch_website_url', __( 'Website: Link (optional)', 'arbee' ), array( 'wrapper' => array( 'width' => 50 ) ) ),
				) ),
				arbee_section( __( 'Shape your future', 'arbee' ), 'careers_enabled', array(
					arbee_f_text( 'careers_title', __( 'Title', 'arbee' ) ),
					arbee_f_textarea( 'careers_text', __( 'Text', 'arbee' ), 3 ),
					arbee_f_link( 'careers_button', __( 'Button', 'arbee' ) ),
					arbee_f_image( 'careers_image', __( 'Image', 'arbee' ), array( 'instructions' => __( 'Landscape, recommended 700×500px.', 'arbee' ) ) ),
				) )
			),
			arbee_loc_template( 'page-templates/template-contact.php' ),
			array( 'menu_order' => 10 )
		);

		/* ================================================================
		 * PRIVACY / LEGAL â€” privacy.php
		 * ============================================================== */
		arbee_acf_group(
			'legal',
			__( 'Legal page content', 'arbee' ),
			arbee_section( __( 'Page content', 'arbee' ), 'legal_enabled', array(
				arbee_f_text( 'legal_title', __( 'Title', 'arbee' ) ),
				arbee_f_text( 'legal_date', __( 'Effective date line', 'arbee' ) ),
				arbee_f(
					'wysiwyg',
					'legal_body',
					__( 'Content', 'arbee' ),
					array(
						'tabs'         => 'all',
						'toolbar'      => 'full',
						'media_upload' => 0,
						'instructions' => __( 'Use â€œHeading 3â€ for section headings.', 'arbee' ),
					)
				),
			) ),
			arbee_loc_template( 'page-templates/template-privacy.php' ),
			array( 'menu_order' => 10 )
		);
	}
);
