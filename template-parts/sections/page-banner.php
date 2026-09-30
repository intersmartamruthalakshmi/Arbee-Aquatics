<?php
/**
 * Inner page banner (.innerpagebgbanner) + breadcrumb (.pagebarsec).
 * Repeated at the top of every inner page in the original site.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

$arbee_title    = arbee_get( 'banner_title' );
$arbee_subtitle = arbee_get( 'banner_subtitle' );
$arbee_image_id = arbee_get( 'banner_image' );
$arbee_slim     = ! arbee_has( $arbee_title ) && ! arbee_has( $arbee_subtitle );
$arbee_crumbs   = arbee_rows( 'breadcrumb_parents' );
$arbee_home     = arbee_get( 'breadcrumb_home' );
$arbee_current  = arbee_get( 'breadcrumb_label' );
$arbee_current  = arbee_has( $arbee_current ) ? $arbee_current : get_the_title();
?>
<?php if ( $arbee_image_id || ! $arbee_slim ) : ?>
	<section class="innerpagebgbanner<?php echo $arbee_slim ? ' privacybg' : ''; ?>">
		<?php if ( $arbee_image_id ) : ?>
			<div class="innerbgsecimg"><?php echo arbee_image( $arbee_image_id, array( 'alt' => 'photo', 'fetchpriority' => 'high' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
		<?php endif; ?>
		<?php if ( ! $arbee_slim ) : ?>
			<div class="headbannerbgtak">
				<div class="container">
					<?php if ( arbee_has( $arbee_title ) ) : ?>
						<h1><?php echo arbee_text( $arbee_title ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php if ( arbee_has( $arbee_subtitle ) ) : ?>
						<h2><?php echo arbee_lines( $arbee_subtitle ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</section>
<?php endif; ?>

<section class="pagebarsec">
	<div class="container">
		<ul>
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo arbee_text( arbee_has( $arbee_home ) ? $arbee_home : __( 'Home', 'arbee' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
			<?php foreach ( $arbee_crumbs as $arbee_crumb ) : ?>
				<?php if ( arbee_has( arbee_v( $arbee_crumb, 'label' ) ) ) : ?>
					<li><a<?php echo arbee_has( arbee_v( $arbee_crumb, 'url' ) ) ? ' href="' . esc_url( arbee_v( $arbee_crumb, 'url' ) ) . '"' : ''; ?>><?php echo arbee_text( arbee_v( $arbee_crumb, 'label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
				<?php endif; ?>
			<?php endforeach; ?>
			<li><a href="<?php echo esc_url( get_permalink() ); ?>" aria-current="page"><?php echo arbee_text( $arbee_current ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
		</ul>
		<div style="clear: both;"></div>
	</div>
</section>
