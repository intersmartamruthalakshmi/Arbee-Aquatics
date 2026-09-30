<?php
/**
 * Basic SEO meta (description, Open Graph, favicon fallback).
 *
 * Replaces the hardcoded <meta> tags in the original main.php. Steps aside
 * automatically when a dedicated SEO plugin is active.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

function arbee_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' );
}

add_action(
	'wp_head',
	function () {
		// Browser UI colour from the original <head>.
		echo '<meta name="theme-color" media="(prefers-color-scheme: light)" content="#0089CF">' . "\n";
		echo '<meta name="theme-color" media="(prefers-color-scheme: dark)" content="#0089CF">' . "\n";
		echo '<meta name="msapplication-TileColor" content="#0089CF">' . "\n";
		echo '<meta name="msapplication-navbutton-color" content="#0089CF">' . "\n";
		echo '<meta name="apple-mobile-web-app-status-bar-style" content="#0089CF">' . "\n";

		// The original shipped favicon.ico but never linked it. Used until a Site Icon is set.
		if ( ! has_site_icon() ) {
			echo '<link rel="icon" href="' . esc_url( arbee_asset( 'images/favicon.ico' ) ) . '">' . "\n";
		}

		if ( arbee_seo_plugin_active() ) {
			return;
		}

		$post_id     = is_singular() ? get_queried_object_id() : 0;
		$description = $post_id ? arbee_get( 'seo_description', $post_id ) : '';
		if ( ! arbee_has( $description ) ) {
			$description = arbee_opt( 'seo_default_description' );
		}
		$og_image = $post_id ? arbee_get( 'seo_og_image', $post_id ) : 0;
		if ( ! $og_image ) {
			$og_image = arbee_opt( 'seo_default_og_image' );
		}
		$author = arbee_opt( 'seo_author' );
		$title  = wp_get_document_title();
		$url    = $post_id ? get_permalink( $post_id ) : home_url( add_query_arg( array() ) );

		if ( arbee_has( $description ) ) {
			echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
		}
		if ( arbee_has( $author ) ) {
			echo '<meta name="author" content="' . esc_attr( $author ) . '">' . "\n";
		}
		echo '<meta property="og:locale" content="' . esc_attr( str_replace( '-', '_', get_bloginfo( 'language' ) ) ) . '">' . "\n";
		echo '<meta property="og:type" content="website">' . "\n";
		echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
		if ( arbee_has( $description ) ) {
			echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
		}
		if ( $og_image ) {
			$src = wp_get_attachment_image_url( (int) $og_image, 'full' );
			if ( $src ) {
				echo '<meta property="og:image" content="' . esc_url( $src ) . '">' . "\n";
			}
		}
		echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	},
	1
);
