<?php
/**
 * "Products" custom post type.
 *
 * Each product IS its own public detail page — Fish Meal, Crude Fish Oil —
 * published at a clean root-level URL (/fish-meal/, no /arbee_product/
 * prefix), rendered by single-arbee_product.php. There is no separate
 * WordPress Page for a product any more: the product post is the page.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'init',
	function () {
		register_post_type(
			'arbee_product',
			array(
				'labels'              => array(
					'name'               => __( 'Products', 'arbee' ),
					'singular_name'      => __( 'Product', 'arbee' ),
					'add_new_item'       => __( 'Add New Product', 'arbee' ),
					'edit_item'          => __( 'Edit Product', 'arbee' ),
					'all_items'          => __( 'Products', 'arbee' ),
					'search_items'       => __( 'Search Products', 'arbee' ),
					'not_found'          => __( 'No products found', 'arbee' ),
					'not_found_in_trash' => __( 'No products found in Trash', 'arbee' ),
				),
				'public'               => true,
				'show_ui'              => true,
				'show_in_menu'         => true,
				'show_in_admin_bar'    => false,
				'show_in_rest'         => false,
				'publicly_queryable'   => true,
				'exclude_from_search'  => false,
				'has_archive'          => false,
				'rewrite'              => false,
				'query_var'            => true,
				'capability_type'      => 'page',
				'map_meta_cap'         => true,
				'menu_icon'            => 'dashicons-archive',
				'menu_position'        => 21,
				'supports'             => array( 'title', 'thumbnail', 'page-attributes' ),
			)
		);

		// Each product at a clean root-level URL (/fish-meal/, not
		// /arbee_product/fish-meal/) — WP_Rewrite's generic CPT slug handling
		// always falls back to the post-type name once you ask for no prefix
		// (empty() treats '' the same as unset), so the rule is added by hand
		// for exactly the published products that exist.
		foreach ( get_posts( array( 'post_type' => 'arbee_product', 'post_status' => 'publish', 'posts_per_page' => -1, 'fields' => 'ids' ) ) as $arbee_product_id ) {
			$arbee_slug = get_post_field( 'post_name', $arbee_product_id );
			if ( $arbee_slug ) {
				add_rewrite_rule( '^' . preg_quote( $arbee_slug, '#' ) . '/?$', 'index.php?post_type=arbee_product&p=' . (int) $arbee_product_id, 'top' );
			}
		}
	}
);

/**
 * Permalink for a product: its own slug at the site root.
 */
add_filter(
	'post_type_link',
	function ( $link, $post ) {
		if ( 'arbee_product' === $post->post_type ) {
			return home_url( '/' . $post->post_name . '/' );
		}
		return $link;
	},
	10,
	2
);

/**
 * Pages are edited with the classic ACF meta-box screen, not the block
 * editor — products are the same kind of ACF-driven content.
 */
add_filter(
	'use_block_editor_for_post_type',
	function ( $use, $post_type ) {
		return 'arbee_product' === $post_type ? false : $use;
	},
	10,
	2
);

add_action(
	'acf/init',
	function () {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}
		arbee_acf_group(
			'product',
			__( 'Product details', 'arbee' ),
			array(
				arbee_f_image( 'box_image', __( 'Box image', 'arbee' ), array( 'instructions' => __( 'Small square icon used in the homepage hero product boxes.', 'arbee' ), 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_image( 'photo', __( 'Photo', 'arbee' ), array( 'instructions' => __( 'Large photo used in the homepage product snippet slider.', 'arbee' ), 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f_text( 'hero_link_text', __( 'Hero box link text', 'arbee' ), array( 'default_value' => __( 'View Product', 'arbee' ) ) ),
				arbee_f_textarea( 'snippet_text', __( 'Snippet hover text', 'arbee' ), 3 ),
				arbee_f_text( 'snippet_button_text', __( 'Snippet button text', 'arbee' ), array( 'default_value' => __( 'Explore Product', 'arbee' ) ) ),
				arbee_f( 'true_false', 'show_in_hero', __( 'Show in homepage hero', 'arbee' ), array( 'ui' => 1, 'default_value' => 1, 'wrapper' => array( 'width' => 50 ) ) ),
				arbee_f( 'true_false', 'show_in_snippet', __( 'Show in homepage product snippet', 'arbee' ), array( 'ui' => 1, 'default_value' => 1, 'wrapper' => array( 'width' => 50 ) ) ),
			),
			array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'arbee_product',
					),
				),
			)
		);
	}
);

/**
 * Published products, in admin (menu_order/title) order.
 */
function arbee_products( $context = '' ) {
	$query = new WP_Query(
		array(
			'post_type'      => 'arbee_product',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
			'no_found_rows'  => true,
		)
	);

	$products = array();
	foreach ( $query->posts as $post ) {
		if ( 'hero' === $context && ! arbee_section_enabled( 'show_in_hero', $post->ID ) ) {
			continue;
		}
		if ( 'snippet' === $context && ! arbee_section_enabled( 'show_in_snippet', $post->ID ) ) {
			continue;
		}
		$products[] = $post;
	}
	return $products;
}

/**
 * A product's own detail page URL — the product post IS the page.
 */
function arbee_product_url( $product_id ) {
	return get_permalink( $product_id );
}
