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

		// Keep non-production environments (dev/staging) out of search
		// results. Anything other than the live domain set in Theme
		// Settings → SEO is treated as non-production.
		$arbee_live_host = wp_parse_url( (string) arbee_opt( 'seo_production_url' ), PHP_URL_HOST );
		$arbee_this_host = wp_parse_url( home_url(), PHP_URL_HOST );
		if ( ! $arbee_live_host || strtolower( (string) $arbee_live_host ) !== strtolower( (string) $arbee_this_host ) ) {
			echo '<meta name="robots" content="noindex, nofollow">' . "\n";
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
		if ( ! $og_image && $post_id && 'arbee_product' === get_post_type( $post_id ) ) {
			// Each product has its own photo already (used in the homepage
			// snippet slider) - fall back to that instead of the sitewide
			// default image, so every product doesn't share one OG image.
			$og_image = arbee_get( 'photo', $post_id );
		}
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
		$arbee_og_image_src = '';
		if ( $og_image ) {
			$arbee_og_image_src = wp_get_attachment_image_url( (int) $og_image, 'full' );
			if ( $arbee_og_image_src ) {
				echo '<meta property="og:image" content="' . esc_url( $arbee_og_image_src ) . '">' . "\n";
			}
		}
		echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";

		// Twitter Cards - reuses the Open Graph title/description/image above.
		echo '<meta name="twitter:card" content="' . ( $arbee_og_image_src ? 'summary_large_image' : 'summary' ) . '">' . "\n";
		echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
		if ( arbee_has( $description ) ) {
			echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";
		}
		if ( $arbee_og_image_src ) {
			echo '<meta name="twitter:image" content="' . esc_url( $arbee_og_image_src ) . '">' . "\n";
		}
	},
	1
);
