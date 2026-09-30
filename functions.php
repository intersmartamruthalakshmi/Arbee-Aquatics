<?php
/**
 * Arbee Aquatic theme bootstrap.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

define( 'ARBEE_VERSION', '1.0.0' );
define( 'ARBEE_DIR', get_template_directory() );
define( 'ARBEE_URI', get_template_directory_uri() );

require ARBEE_DIR . '/inc/setup.php';
require ARBEE_DIR . '/inc/helpers.php';
require ARBEE_DIR . '/inc/enqueue.php';
require ARBEE_DIR . '/inc/menus.php';
require ARBEE_DIR . '/inc/seo.php';
require ARBEE_DIR . '/inc/forms.php';
require ARBEE_DIR . '/inc/acf/builder.php';
require ARBEE_DIR . '/inc/acf/options.php';
require ARBEE_DIR . '/inc/acf/pages.php';
require ARBEE_DIR . '/inc/admin.php';
require ARBEE_DIR . '/inc/importer.php';
