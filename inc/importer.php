<?php
/**
 * One-time content migration from the original PHP site.
 *
 * Creates the pages (with templates), imports all editable images/videos into
 * the Media Library, fills every ACF field, builds the menus and sets the
 * front page — so a fresh install shows the same content as the PHP site.
 *
 * Run with:  wp arbee import [--force]
 * or:        Theme Settings → “Import original content” button.
 *
 * Content itself lives in inc/demo-content.php.
 *
 * Value markers used in the data file:
 *   'img:file.png|Alt text'  → attachment ID (imported from assets/images)
 *   'file:video.mp4'         → attachment ID
 *   'page:slug'              → permalink of that page
 *   'home:'                  → home URL
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

class Arbee_Importer {

	/** @var string[] */
	private $log = array();

	/** @var array<string,int> */
	private $media = array();

	/** @var bool */
	private $force;

	public function __construct( $force = false ) {
		$this->force = (bool) $force;
	}

	public function run() {
		if ( ! function_exists( 'update_field' ) ) {
			return array( 'ERROR: Advanced Custom Fields PRO must be active before importing.' );
		}
		if ( get_option( 'arbee_content_imported' ) && ! $this->force ) {
			return array( 'Content was already imported. Use --force (or the “Re-import” button) to overwrite.' );
		}

		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

		// Large images + videos.
		if ( function_exists( 'set_time_limit' ) ) {
			@set_time_limit( 600 ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
		}

		$data = require ARBEE_DIR . '/inc/demo-content.php';

		// 1. Pages first (so page: links resolve), without fields.
		$ids = array();
		foreach ( $data['pages'] as $slug => $page ) {
			$ids[ $slug ] = $this->ensure_page( $slug, $page );
		}

		// 2. Reading + permalink settings.
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
		if ( ! get_option( 'permalink_structure' ) ) {
			update_option( 'permalink_structure', '/%postname%/' );
			$this->log[] = 'Permalinks set to /%postname%/';
		}
		foreach ( $data['settings'] as $option => $value ) {
			update_option( $option, $value );
		}
		flush_rewrite_rules();

		// 3. Page fields.
		foreach ( $data['pages'] as $slug => $page ) {
			$this->fill( $page['group'], $page['fields'], $ids[ $slug ] );
			if ( ! empty( $page['banner'] ) ) {
				$this->fill( 'banner', $page['banner'], $ids[ $slug ] );
			}
			if ( ! empty( $page['seo'] ) ) {
				$this->fill( 'seo', $page['seo'], $ids[ $slug ] );
			}
			$this->log[] = sprintf( 'Page “%s” (#%d) filled.', $page['title'], $ids[ $slug ] );
		}

		// 4. Theme Settings.
		$this->fill( 'opt', $data['options'], 'option' );
		$this->log[] = 'Theme Settings filled.';

		// 5. Menus.
		foreach ( $data['menus'] as $location => $menu ) {
			$this->build_menu( $location, $menu['name'], $menu['items'] );
		}

		update_option( 'arbee_content_imported', time() );
		$this->log[] = sprintf( 'Done. %d media files in the library.', count( $this->media ) );
		return $this->log;
	}

	/* ---------------------------------------------------------------- */

	private function ensure_page( $slug, $page ) {
		$existing = get_page_by_path( $slug, OBJECT, 'page' );
		$args     = array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $page['title'],
			'post_name'    => $slug,
			'post_content' => '',
			'menu_order'   => isset( $page['order'] ) ? (int) $page['order'] : 0,
		);
		if ( $existing ) {
			$args['ID'] = $existing->ID;
			$id         = wp_update_post( $args );
		} else {
			$id          = wp_insert_post( $args );
			$this->log[] = sprintf( 'Created page “%s”.', $page['title'] );
		}
		update_post_meta( $id, '_wp_page_template', $page['template'] ? $page['template'] : 'default' );
		return (int) $id;
	}

	/**
	 * Write each top-level field using its deterministic key (see inc/acf/builder.php).
	 */
	private function fill( $group, $fields, $post_id ) {
		foreach ( $fields as $name => $value ) {
			update_field( arbee_field_key( $group, $name ), $this->resolve( $value ), $post_id );
		}
	}

	private function resolve( $value ) {
		if ( is_array( $value ) ) {
			foreach ( $value as $k => $v ) {
				$value[ $k ] = $this->resolve( $v );
			}
			return $value;
		}
		if ( ! is_string( $value ) ) {
			return $value;
		}
		if ( 0 === strpos( $value, 'img:' ) || 0 === strpos( $value, 'file:' ) ) {
			$spec = substr( $value, strpos( $value, ':' ) + 1 );
			$alt  = '';
			if ( false !== strpos( $spec, '|' ) ) {
				list( $spec, $alt ) = explode( '|', $spec, 2 );
			}
			return $this->media( $spec, $alt );
		}
		if ( 0 === strpos( $value, 'page:' ) ) {
			$page = get_page_by_path( substr( $value, 5 ), OBJECT, 'page' );
			return $page ? get_permalink( $page ) : '';
		}
		if ( 'home:' === $value ) {
			return home_url( '/' );
		}
		return $value;
	}

	/**
	 * Import a file from the theme's assets/images into the Media Library (once).
	 */
	private function media( $file, $alt = '' ) {
		if ( isset( $this->media[ $file ] ) ) {
			return $this->media[ $file ];
		}

		$found = get_posts(
			array(
				'post_type'      => 'attachment',
				'post_status'    => 'inherit',
				'meta_key'       => '_arbee_source_file',
				'meta_value'     => $file,
				'posts_per_page' => 1,
				'fields'         => 'ids',
			)
		);
		if ( $found ) {
			$this->media[ $file ] = (int) $found[0];
			if ( $alt && ! get_post_meta( $found[0], '_wp_attachment_image_alt', true ) ) {
				update_post_meta( $found[0], '_wp_attachment_image_alt', $alt );
			}
			return $this->media[ $file ];
		}

		$source = ARBEE_DIR . '/assets/images/' . $file;
		if ( ! file_exists( $source ) ) {
			$this->log[] = 'WARNING: missing source file ' . $file;
			return 0;
		}

		$upload = wp_upload_bits( wp_basename( $file ), null, file_get_contents( $source ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		if ( ! empty( $upload['error'] ) ) {
			$this->log[] = 'WARNING: could not copy ' . $file . ': ' . $upload['error'];
			return 0;
		}

		$type = wp_check_filetype( $upload['file'] );
		$id   = wp_insert_attachment(
			array(
				'post_mime_type' => $type['type'],
				'post_title'     => preg_replace( '/\.[^.]+$/', '', wp_basename( $file ) ),
				'post_status'    => 'inherit',
			),
			$upload['file']
		);
		wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $upload['file'] ) );
		update_post_meta( $id, '_arbee_source_file', $file );
		if ( $alt ) {
			update_post_meta( $id, '_wp_attachment_image_alt', $alt );
		}

		$this->media[ $file ] = (int) $id;
		return (int) $id;
	}

	private function build_menu( $location, $name, $items ) {
		$menu = wp_get_nav_menu_object( $name );
		if ( $menu ) {
			foreach ( (array) wp_get_nav_menu_items( $menu->term_id ) as $old ) {
				wp_delete_post( $old->ID, true );
			}
			$menu_id = $menu->term_id;
		} else {
			$menu_id = wp_create_nav_menu( $name );
		}

		$this->add_menu_items( $menu_id, $items, 0 );

		$locations              = get_theme_mod( 'nav_menu_locations', array() );
		$locations[ $location ] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
		$this->log[] = sprintf( 'Menu “%s” assigned to %s.', $name, $location );
	}

	private function add_menu_items( $menu_id, $items, $parent ) {
		foreach ( $items as $pos => $item ) {
			$args = array(
				'menu-item-title'     => $item['title'],
				'menu-item-status'    => 'publish',
				'menu-item-parent-id' => $parent,
				'menu-item-position'  => $pos + 1,
			);
			if ( isset( $item['page'] ) ) {
				$page = get_page_by_path( $item['page'], OBJECT, 'page' );
				if ( ! $page ) {
					continue;
				}
				$args['menu-item-object-id'] = $page->ID;
				$args['menu-item-object']    = 'page';
				$args['menu-item-type']      = 'post_type';
			} else {
				$args['menu-item-url']  = $item['url'];
				$args['menu-item-type'] = 'custom';
			}
			$item_id = wp_update_nav_menu_item( $menu_id, 0, $args );
			if ( ! empty( $item['icon'] ) ) {
				update_field( 'field_menuitem_menu_icon', $this->resolve( $item['icon'] ), $item_id );
			}
			if ( ! empty( $item['children'] ) ) {
				$this->add_menu_items( $menu_id, $item['children'], $item_id );
			}
		}
	}
}

/**
 * WP-CLI: wp arbee import [--force]
 */
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command(
		'arbee import',
		function ( $args, $assoc ) {
			$log = ( new Arbee_Importer( ! empty( $assoc['force'] ) ) )->run();
			foreach ( $log as $line ) {
				WP_CLI::log( $line );
			}
		}
	);
}
