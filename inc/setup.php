<?php
/**
 * Theme supports, menus and body classes.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );

		register_nav_menus(
			array(
				'primary'         => __( 'Header navigation', 'arbee' ),
				'footer_company'  => __( 'Footer: Company', 'arbee' ),
				'footer_products' => __( 'Footer: Our Products', 'arbee' ),
				'footer_legal'    => __( 'Footer: Legal links', 'arbee' ),
			)
		);
	}
);

/**
 * Replaces the body-class switch from the original main.php:
 * isHome on the home page, noBanner on the 404 page.
 * `no-js` is kept because the original <body> always carried it.
 */
add_filter(
	'body_class',
	function ( $classes ) {
		$classes[] = 'no-js';
		if ( is_front_page() ) {
			$classes[] = 'isHome';
		}
		if ( is_404() ) {
			$classes[] = 'noBanner';
		}
		return $classes;
	}
);

/**
 * Pages are built entirely from ACF fields, so the block editor is not used for them.
 */
add_filter(
	'use_block_editor_for_post_type',
	function ( $use, $post_type ) {
		return 'page' === $post_type ? false : $use;
	},
	10,
	2
);

add_action(
	'init',
	function () {
		remove_post_type_support( 'page', 'editor' );
		remove_post_type_support( 'page', 'comments' );
	}
);

/**
 * Map each page template to the wrapper class used by the original markup.
 */
function arbee_page_templates() {
	return array(
		'page-templates/template-about.php'          => __( 'About Us', 'arbee' ),
		'page-templates/template-why-arbee.php'      => __( 'Why Arbee', 'arbee' ),
		'page-templates/template-fish-meal.php'      => __( 'Product: Fish Meal', 'arbee' ),
		'page-templates/template-technology.php'     => __( 'Technology & Process', 'arbee' ),
		'page-templates/template-sustainability.php' => __( 'Sustainability', 'arbee' ),
		'page-templates/template-global-exports.php' => __( 'Global Exports', 'arbee' ),
		'page-templates/template-contact.php'        => __( 'Contact Us', 'arbee' ),
		'page-templates/template-privacy.php'        => __( 'Privacy / Legal', 'arbee' ),
	);
}
