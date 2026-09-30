<?php
/**
 * Header navigation walker + footer menu output.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

/**
 * Outputs the original header markup:
 *
 * <div class="navigationItem [hasMenu]">
 *   <a class="navigationBx [active]"><div class="txt">LABEL</div></a>
 *   <div class="subMenuWrap"><ul class="subMenuList"><li><a><img>Label</a></li></ul></div>
 * </div>
 *
 * Sub-menu items can carry an icon (ACF field "menu_icon" on the menu item).
 */
class Arbee_Header_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( 0 === $depth ) {
			$output .= '<div class="subMenuWrap"><ul class="subMenuList">';
		} else {
			$output .= '<ul class="subMenuList">';
		}
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= ( 0 === $depth ) ? '</ul></div>' : '</ul>';
	}

	private function is_active( $item ) {
		$classes = (array) $item->classes;
		return (bool) array_intersect( $classes, array( 'current-menu-item', 'current-menu-ancestor', 'current-menu-parent', 'current_page_parent', 'current_page_ancestor' ) );
	}

	private function link_attrs( $item ) {
		$url = trim( (string) $item->url );
		// "#" is a placeholder parent (e.g. PRODUCTS) — the original used javascript:void(0).
		if ( '' === $url || '#' === $url ) {
			return '';
		}
		if ( arbee_is_quote_url( $url ) ) {
			return ' href="#request-quote" data-bs-toggle="modal" data-bs-target="#exampleModal"';
		}
		$out = ' href="' . esc_url( $url ) . '"';
		if ( ! empty( $item->target ) ) {
			$out .= ' target="' . esc_attr( $item->target ) . '" rel="noopener"';
		}
		if ( $this->is_active( $item ) && in_array( 'current-menu-item', (array) $item->classes, true ) ) {
			$out .= ' aria-current="page"';
		}
		return $out;
	}

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item  = $data_object;
		$title = apply_filters( 'nav_menu_item_title', $item->title, $item, $args, $depth );

		if ( 0 === $depth ) {
			$has_children = in_array( 'menu-item-has-children', (array) $item->classes, true );
			$output      .= '<div class="navigationItem' . ( $has_children ? ' hasMenu' : '' ) . '">';
			$output      .= '<a class="navigationBx' . ( $this->is_active( $item ) ? ' active' : '' ) . '"' . $this->link_attrs( $item ) . '>';
			$output      .= '<div class="txt">' . esc_html( $title ) . '</div></a>';
			return;
		}

		$icon    = function_exists( 'get_field' ) ? get_field( 'menu_icon', $item ) : null;
		$output .= '<li><a' . $this->link_attrs( $item ) . '>';
		if ( $icon ) {
			$output .= arbee_image( $icon, array( 'alt' => 'photo-icon' ) );
		}
		$output .= esc_html( $title ) . '</a>';
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		$output .= ( 0 === $depth ) ? '</div>' : '</li>';
	}
}

/**
 * Print the header navigation.
 */
function arbee_primary_menu() {
	if ( ! has_nav_menu( 'primary' ) ) {
		return;
	}
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'container'      => false,
			'items_wrap'     => '%3$s',
			'depth'          => 2,
			'walker'         => new Arbee_Header_Walker(),
			'fallback_cb'    => false,
		)
	);
}

/**
 * Print a flat footer menu as <ul class="$class"><li><a>…</a></li></ul>.
 */
function arbee_footer_menu( $location, $class = '' ) {
	if ( ! has_nav_menu( $location ) ) {
		return;
	}
	wp_nav_menu(
		array(
			'theme_location' => $location,
			'container'      => false,
			'depth'          => 1,
			'items_wrap'     => '<ul' . ( $class ? ' class="' . esc_attr( $class ) . '"' : '' ) . '>%3$s</ul>',
			'fallback_cb'    => false,
		)
	);
}
