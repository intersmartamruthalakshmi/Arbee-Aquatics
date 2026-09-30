<?php
/**
 * Admin experience: dependency notice, content import button, tidy-ups.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

/**
 * ACF Pro is required for all editable content.
 */
add_action(
	'admin_notices',
	function () {
		if ( function_exists( 'acf_add_options_page' ) || ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		echo '<div class="notice notice-error"><p><strong>Arbee Aquatic theme:</strong> ' . esc_html__( 'Advanced Custom Fields PRO must be installed and active. Page content and Theme Settings are stored in ACF fields.', 'arbee' ) . '</p></div>';
	}
);

/**
 * Offer the one-time import on the dashboard and Theme Settings until it has run.
 */
add_action(
	'admin_notices',
	function () {
		if ( ! current_user_can( 'manage_options' ) || ! function_exists( 'update_field' ) || get_option( 'arbee_content_imported' ) ) {
			return;
		}
		$url = wp_nonce_url( admin_url( 'admin-post.php?action=arbee_import' ), 'arbee_import' );
		echo '<div class="notice notice-info"><p><strong>Arbee Aquatic:</strong> ' . esc_html__( 'Import the original website content (pages, images, menus and settings) so the site matches the approved design.', 'arbee' ) . ' <a class="button button-primary" href="' . esc_url( $url ) . '">' . esc_html__( 'Import original content', 'arbee' ) . '</a></p></div>';
	}
);

add_action(
	'admin_post_arbee_import',
	function () {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You are not allowed to do this.', 'arbee' ), 403 );
		}
		check_admin_referer( 'arbee_import' );
		$force = ! empty( $_GET['force'] );
		$log   = ( new Arbee_Importer( $force ) )->run();
		set_transient( 'arbee_import_log', $log, 300 );
		wp_safe_redirect( admin_url( 'admin.php?page=arbee-theme-settings&arbee-imported=1' ) );
		exit;
	}
);

add_action(
	'admin_notices',
	function () {
		if ( empty( $_GET['arbee-imported'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			return;
		}
		$log = get_transient( 'arbee_import_log' );
		if ( ! $log ) {
			return;
		}
		delete_transient( 'arbee_import_log' );
		echo '<div class="notice notice-success is-dismissible"><p><strong>' . esc_html__( 'Content import finished.', 'arbee' ) . '</strong></p><ul style="list-style:disc;margin-left:20px">';
		foreach ( $log as $line ) {
			echo '<li>' . esc_html( $line ) . '</li>';
		}
		echo '</ul></div>';
	}
);

/**
 * Show which template a page uses in the Pages list, so editors know where fields live.
 */
add_filter(
	'manage_page_posts_columns',
	function ( $cols ) {
		$cols['arbee_template'] = __( 'Layout', 'arbee' );
		return $cols;
	}
);

add_action(
	'manage_page_posts_custom_column',
	function ( $col, $post_id ) {
		if ( 'arbee_template' !== $col ) {
			return;
		}
		if ( (int) get_option( 'page_on_front' ) === (int) $post_id ) {
			esc_html_e( 'Homepage', 'arbee' );
			return;
		}
		$templates = arbee_page_templates();
		$slug      = get_page_template_slug( $post_id );
		echo esc_html( isset( $templates[ $slug ] ) ? $templates[ $slug ] : __( 'Default', 'arbee' ) );
	},
	10,
	2
);

/**
 * Hide comment UI — the site has no comments.
 */
add_action(
	'admin_menu',
	function () {
		remove_menu_page( 'edit-comments.php' );
	}
);
add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'pings_open', '__return_false', 20 );
