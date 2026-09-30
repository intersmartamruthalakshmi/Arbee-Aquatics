<?php
/**
 * Styles and scripts, in the same order the original main.php / footer.php loaded them.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

/**
 * Templates that contain Swiper sliders (the original only loaded Swiper on these pages).
 */
function arbee_uses_swiper() {
	return is_front_page()
		|| is_page_template(
			array(
				'page-templates/template-about.php',
				'page-templates/template-why-arbee.php',
				'page-templates/template-fish-meal.php',
			)
		);
}

add_action(
	'wp_enqueue_scripts',
	function () {
		$v   = ARBEE_VERSION;
		$css = ARBEE_URI . '/assets/css/';
		$js  = ARBEE_URI . '/assets/js/';

		// ---- Styles (head) ----
		wp_enqueue_style( 'arbee-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', array(), null );
		wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css', array(), null );
		wp_enqueue_style( 'animate-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), null );
		wp_enqueue_style( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), null );
		wp_enqueue_style( 'flag-icon', 'https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css', array(), null );
		wp_enqueue_style( 'arbee-fontawesome', $css . 'all.css', array(), $v );
		wp_enqueue_style( 'arbee-animate', $css . 'animate.css', array(), $v );
		wp_enqueue_style( 'owl-carousel', $css . 'owl.carousel.min.css', array(), $v );
		wp_enqueue_style( 'owl-theme', $css . 'owl.theme.default.min.css', array(), $v );
		wp_enqueue_style( 'arbee-theme', $css . 'theme.css', array(), $v );
		wp_enqueue_style( 'arbee-style', $css . 'style.css', array(), $v );
		wp_enqueue_style( 'arbee-device', $css . 'device.css', array(), $v );
		wp_enqueue_style( 'arbee-app', $css . 'app.min.css', array(), $v );
		wp_enqueue_style( 'arbee-pages', $css . 'pages.min.css', array(), $v );
		// Originally loaded inside <body>, i.e. after the theme CSS — keep that cascade order.
		if ( arbee_uses_swiper() ) {
			wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), null );
		}
		wp_enqueue_style( 'intl-tel-input', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css', array(), null );
		// Former inline <style> blocks (head + preloader) and WordPress-only additions.
		wp_enqueue_style( 'arbee-additions', $css . 'theme-additions.css', array(), $v );

		// ---- Scripts ----
		// WordPress' bundled jQuery replaces the googleapis copy (same 3.7.x line), loaded in <head> as before.
		wp_enqueue_script( 'jquery' );
		// WordPress runs jQuery in noConflict mode; the original scripts expect a global $.
		wp_add_inline_script( 'jquery-core', 'window.$ = window.$ || window.jQuery;' );
		wp_enqueue_script( 'arbee-head', $js . 'head.js', array(), $v, false );

		wp_enqueue_script( 'intersection-observer', 'https://cdn.jsdelivr.net/npm/intersection-observer@0.7.0/intersection-observer.min.js', array(), null, true );
		wp_enqueue_script( 'vanilla-lazyload', 'https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.3/dist/lazyload.min.js', array( 'intersection-observer' ), null, true );
		wp_add_inline_script( 'vanilla-lazyload', 'var lazyLoadInstance = new LazyLoad({});' );

		wp_enqueue_script( 'bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/js/bootstrap.min.js', array(), null, true );
		wp_enqueue_script( 'scrollreveal', 'https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.9/scrollreveal.js', array(), null, true );
		wp_enqueue_script( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'intl-tel-input', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'lenis', 'https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.41/dist/lenis.min.js', array(), null, true );
		wp_enqueue_script( 'arbee-init', $js . 'theme-init.js', array( 'jquery', 'bootstrap', 'scrollreveal', 'select2', 'intl-tel-input', 'lenis' ), $v, true );
		wp_enqueue_script( 'owl-carousel', $js . 'owl.carousel.min.js', array( 'jquery' ), $v, true );
		wp_enqueue_script( 'arbee-custom', $js . 'custom.js', array( 'jquery', 'owl-carousel' ), $v, true );

		if ( arbee_uses_swiper() ) {
			wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true );
			wp_enqueue_script( 'arbee-sliders', $js . 'sliders.js', array( 'swiper' ), $v, true );
		}

		wp_enqueue_script( 'arbee-forms', $js . 'forms.js', array( 'jquery', 'arbee-init' ), $v, true );
		wp_localize_script(
			'arbee-forms',
			'arbeeForms',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'arbee_enquiry' ),
				'sending' => __( 'Sending…', 'arbee' ),
				'error'   => __( 'Sorry, your message could not be sent. Please try again.', 'arbee' ),
			)
		);
	}
);

/**
 * Keep the Subresource Integrity attributes the original <link>/<script> tags had.
 */
function arbee_sri_map() {
	return array(
		'style'  => array(
			'bootstrap'   => 'sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB',
			'animate-cdn' => 'sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==',
		),
		'script' => array(
			'bootstrap'    => 'sha512-nKXmKvJyiGQy343jatQlzDprflyB5c+tKCzGP3Uq67v+lmzfnZUi/ZT+fc6ITZfSC5HhaBKUIvr/nTLCV+7F+Q==',
			'scrollreveal' => 'sha512-XJgPMFq31Ren4pKVQgeD+0JTDzn0IwS1802sc+QTZckE6rny7AN2HLReq6Yamwpd2hFe5nJJGZLvPStWFv5Kww==',
		),
	);
}

add_filter(
	'style_loader_tag',
	function ( $tag, $handle ) {
		$map = arbee_sri_map()['style'];
		if ( isset( $map[ $handle ] ) ) {
			$tag = str_replace( ' href=', ' integrity="' . esc_attr( $map[ $handle ] ) . '" crossorigin="anonymous" referrerpolicy="no-referrer" href=', $tag );
		}
		return $tag;
	},
	10,
	2
);

add_filter(
	'script_loader_tag',
	function ( $tag, $handle ) {
		$map = arbee_sri_map()['script'];
		if ( isset( $map[ $handle ] ) ) {
			$tag = str_replace( ' src=', ' integrity="' . esc_attr( $map[ $handle ] ) . '" crossorigin="anonymous" referrerpolicy="no-referrer" src=', $tag );
		}
		return $tag;
	},
	10,
	2
);

/**
 * Preconnect hints from the original <head>.
 */
add_filter(
	'wp_resource_hints',
	function ( $urls, $type ) {
		if ( 'preconnect' === $type ) {
			$urls[] = 'https://cdnjs.cloudflare.com';
			$urls[] = 'https://cdn.jsdelivr.net';
			$urls[] = 'https://fonts.googleapis.com';
			$urls[] = array(
				'href'        => 'https://fonts.gstatic.com',
				'crossorigin' => 'anonymous',
			);
		}
		return $urls;
	},
	10,
	2
);
