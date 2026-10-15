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
$arbee_crumbs   = arbee_breadcrumbs();
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
			<?php foreach ( $arbee_crumbs as $arbee_crumb ) : ?>
				<?php $arbee_crumb_url = arbee_v( $arbee_crumb, 'url' ); ?>
				<?php if ( arbee_has( $arbee_crumb_url ) ) : ?>
					<li><a href="<?php echo esc_url( $arbee_crumb_url ); ?>"<?php echo ! empty( $arbee_crumb['current'] ) ? ' aria-current="page"' : ''; ?>><?php echo arbee_text( arbee_v( $arbee_crumb, 'label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
				<?php else : ?>
					<?php // A crumb with nowhere to link (e.g. "Products", a menu grouping with no archive page) — a bare <a> with no href picks up an unstyled/invisible colour in this theme's CSS, so this stays plain text. ?>
					<li><span<?php echo ! empty( $arbee_crumb['current'] ) ? ' aria-current="page"' : ''; ?>><?php echo arbee_text( arbee_v( $arbee_crumb, 'label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<div style="clear: both;"></div>
	</div>
</section>
