<?php
/**
 * Site header — converted from main.php (document head, preloader) and includes/header.php.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

$arbee_logo        = arbee_opt( 'header_logo' );
$arbee_quote_label = arbee_opt( 'header_quote_label' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr">

<head>
	<noscript>
		<style type="text/css">
			.no-js {
				display: none !important;
			}
		</style>
	</noscript>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="mobile-web-app-capable" content="yes">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<a class="screen-reader-text" href="#pageWrapper"><?php esc_html_e( 'Skip to content', 'arbee' ); ?></a>

	<!-- PRE LOADER -->
	<div id="preloader">
		<div class="loader_logoBx">
			<?php echo arbee_image( $arbee_logo, array( 'width' => 240, 'height' => 50, 'alt' => get_bloginfo( 'name' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
	</div>

	<header id="Header">
		<div class="container">
			<div class="dFlx">
				<div class="lSide">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logoBx" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						<?php echo arbee_image( $arbee_logo, array( 'width' => 150, 'height' => 150, 'alt' => 'logo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</a>
				</div>
				<div class="rgSide">
					<nav class="navigationWrapper" id="navMenu" aria-label="<?php esc_attr_e( 'Main navigation', 'arbee' ); ?>">
						<div class="mobileWrap sticky">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
								<?php echo arbee_image( $arbee_logo, array( 'width' => 150, 'height' => 150, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => 'logo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
							</a>
							<button type="button" class="closeNav" id="closeNav" aria-label="<?php esc_attr_e( 'Close Navigation', 'arbee' ); ?>">
								&times;
							</button>
						</div>
						<?php arbee_primary_menu(); ?>
					</nav>
					<div class="quicklinkWrapper">
						<?php if ( arbee_has( $arbee_quote_label ) ) : ?>
							<div class="item">
								<button type="button" class="navigationBx bxAdmin baseBtn_1" data-bs-toggle="modal"
									data-bs-target="#exampleModal">
									<div class="txt"><?php echo arbee_text( $arbee_quote_label ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
								</button>
							</div>
						<?php endif; ?>
						<div class="item">
							<div class="hamburger" id="hamburger" role="button" tabindex="0" aria-controls="navMenu" aria-label="<?php esc_attr_e( 'Open Navigation', 'arbee' ); ?>">
								<span></span>
								<span></span>
								<span></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
