<?php
/**
 * REST API hardening.
 *
 * Nothing on the public site calls the WP REST API (no block editor, no
 * Gutenberg blocks, forms post to admin-ajax.php - see inc/forms.php), so
 * it is closed to anonymous requests entirely rather than left open to
 * endpoint discovery and user enumeration. The oEmbed endpoint stays public
 * so other sites can still embed this one's content.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

add_filter(
	'rest_authentication_errors',
	function ( $result ) {
		if ( is_wp_error( $result ) || is_user_logged_in() ) {
			return $result;
		}

		$route = isset( $GLOBALS['wp']->query_vars['rest_route'] ) ? (string) $GLOBALS['wp']->query_vars['rest_route'] : '';
		if ( 0 === strpos( $route, '/oembed/' ) ) {
			return $result;
		}

		return new WP_Error(
			'arbee_rest_disabled',
			__( 'The REST API is restricted on this site.', 'arbee' ),
			array( 'status' => 401 )
		);
	}
);

/**
 * Belt-and-braces: even if the filter above is ever bypassed by a plugin
 * that authenticates its own requests, never expose the full user list or
 * usernames to logged-out visitors.
 */
add_filter(
	'rest_endpoints',
	function ( $endpoints ) {
		if ( is_user_logged_in() ) {
			return $endpoints;
		}
		foreach ( array_keys( $endpoints ) as $route ) {
			if ( preg_match( '#^/wp/v2/users#', $route ) ) {
				unset( $endpoints[ $route ] );
			}
		}
		return $endpoints;
	}
);

/**
 * The `?rest_route=` / `/wp-json/` discovery document itself lists every
 * registered route (plugins, post types, etc.) to anonymous visitors.
 */
add_filter(
	'rest_index',
	function ( $response ) {
		if ( ! is_user_logged_in() ) {
			$response->set_data( array() );
		}
		return $response;
	}
);

/**
 * Author archives leak the same usernames via /?author=1 (sequential ID
 * enumeration) by redirecting to /author/<nicename>/.
 */
add_action(
	'template_redirect',
	function () {
		if ( is_author() && ! empty( $_GET['author'] ) && is_numeric( $_GET['author'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			wp_safe_redirect( home_url( '/' ), 301 );
			exit;
		}
	}
);
