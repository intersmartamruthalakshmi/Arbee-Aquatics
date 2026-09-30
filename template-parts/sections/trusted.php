<?php
/**
 * "About / Trusted" section (#Trusted) — shared by index1.php and about.php.
 * Reads the trusted_* fields of the current page.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

$arbee_video     = arbee_file_url( arbee_get( 'trusted_video' ) );
$arbee_img1      = arbee_get( 'trusted_image_1' );
$arbee_img2      = arbee_get( 'trusted_image_2' );
$arbee_qualities = arbee_rows( 'trusted_qualities' );
$arbee_eyebrow   = arbee_get( 'trusted_eyebrow' );
$arbee_heading   = arbee_get( 'trusted_heading' );
$arbee_sub       = arbee_get( 'trusted_subheading' );
$arbee_text      = arbee_get( 'trusted_text' );
$arbee_button    = arbee_get( 'trusted_button' );

if ( ! $arbee_video && ! $arbee_img1 && ! $arbee_img2 && ! $arbee_qualities && ! arbee_has( $arbee_heading ) && ! arbee_has( $arbee_text ) ) {
	return;
}
?>
<section id="Trusted" class="whits_section">
	<div class="container">
		<div class="dFlx">
			<div class="tapbox">
				<?php if ( $arbee_video ) : ?>
					<video class="trustedVideo" autoplay muted loop playsinline id="liuidvideo">
						<source src="<?php echo esc_url( $arbee_video ); ?>" type="video/mp4">
						Your browser does not support HTML5 video.
					</video>
				<?php endif; ?>
				<?php if ( $arbee_img1 || $arbee_img2 ) : ?>
					<div class="grtcover">
						<?php if ( $arbee_img1 ) : ?>
							<div class="grt1"><?php echo arbee_image( $arbee_img1, array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
						<?php endif; ?>
						<?php if ( $arbee_img2 ) : ?>
							<div class="grt2"><?php echo arbee_image( $arbee_img2, array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if ( $arbee_qualities ) : ?>
					<div class="qualtbox">
						<div class="swiper qualitySlider">
							<div class="swiper-wrapper">
								<?php foreach ( $arbee_qualities as $arbee_q ) : ?>
									<div class="swiper-slide">
										<div class="qualityBx">
											<?php if ( arbee_v( $arbee_q, 'icon' ) ) : ?>
												<div class="icon">
													<?php echo arbee_image( arbee_v( $arbee_q, 'icon' ), array( 'width' => 70, 'height' => 70, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
												</div>
											<?php endif; ?>
											<div class="txt"><?php echo arbee_text( arbee_v( $arbee_q, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="crapbox">
				<div class="framicut"><img src="<?php echo esc_url( arbee_asset( 'images/frame145.png' ) ); ?>" alt=""></div>
				<?php if ( arbee_has( $arbee_eyebrow ) ) : ?>
					<h2><?php echo arbee_text( $arbee_eyebrow ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
				<?php endif; ?>
				<?php if ( arbee_has( $arbee_heading ) ) : ?>
					<h3><?php echo arbee_lines( $arbee_heading ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
				<?php endif; ?>
				<?php if ( arbee_has( $arbee_sub ) ) : ?>
					<h4><?php echo arbee_lines( $arbee_sub ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h4>
				<?php endif; ?>
				<?php echo arbee_paras( $arbee_text, '' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<?php echo arbee_link( $arbee_button, 'expmorebth' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</div>
		</div>
	</div>
</section>
