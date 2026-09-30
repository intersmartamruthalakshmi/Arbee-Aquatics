<?php
/**
 * Template Name: Why Arbee
 *
 * Converted from why-arbee.php.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

get_header();

$arbee_fresh     = arbee_rows( 'fresh_items' );
$arbee_certs     = arbee_rows( 'exp_certs' );
$arbee_check     = arbee_rows( 'export_checklist' );
$arbee_rows      = arbee_rows( 'quality_rows' );
$arbee_benefits  = arbee_rows( 'benefits' );
$arbee_logos     = arbee_get( 'cert_logos' );
$arbee_logos     = is_array( $arbee_logos ) ? array_values( $arbee_logos ) : array();
// The slider shows 5 at a time in loop mode; the original repeated a logo to have
// enough slides. Galleries can't hold duplicates, so repeat the set when it's short.
$arbee_slides = $arbee_logos;
while ( $arbee_slides && count( $arbee_slides ) < 6 ) {
	$arbee_slides = array_merge( $arbee_slides, $arbee_logos );
}
$arbee_check_img = arbee_asset( 'images/checkgt1.png' );
?>
<div id="pageWrapper" class="aboutPage">

	<?php arbee_part( 'sections/page-banner' ); ?>

	<?php if ( arbee_has( arbee_get( 'fresh_title' ) ) || $arbee_fresh ) : ?>
		<section class="advantagesecbg">
			<div class="container">
				<div class="advantleftbg">
					<?php if ( arbee_has( arbee_get( 'fresh_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'fresh_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php echo arbee_paras( arbee_get( 'fresh_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<?php if ( $arbee_fresh ) : ?>
						<ul class="advantboxbok">
							<?php foreach ( $arbee_fresh as $arbee_f ) : ?>
								<li>
									<h2><?php echo arbee_text( arbee_v( $arbee_f, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
									<?php if ( arbee_has( arbee_v( $arbee_f, 'text' ) ) ) : ?>
										<p class="paraarbeespec"><?php echo arbee_lines( arbee_v( $arbee_f, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
				<?php if ( arbee_get( 'fresh_image' ) ) : ?>
					<div class="advantgightsec"><?php echo arbee_image( arbee_get( 'fresh_image' ), array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
				<?php endif; ?>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( arbee_has( arbee_get( 'exp_title' ) ) || $arbee_certs ) : ?>
		<section class="advantagesecbg decadbg">
			<div class="container">
				<div class="decadbgleft">
					<?php if ( arbee_has( arbee_get( 'exp_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'exp_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
				</div>
				<div class="decadbgright">
					<?php echo arbee_paras( arbee_get( 'exp_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
				<?php if ( arbee_has( arbee_get( 'exp_cert_title' ) ) || $arbee_certs ) : ?>
					<div class="decacertif">
						<?php if ( arbee_has( arbee_get( 'exp_cert_title' ) ) ) : ?>
							<h4><?php echo arbee_text( arbee_get( 'exp_cert_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h4>
						<?php endif; ?>
						<?php if ( $arbee_certs ) : ?>
							<ul>
								<?php foreach ( $arbee_certs as $arbee_c ) : ?>
									<li>
										<h5><?php echo arbee_text( arbee_v( $arbee_c, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h5>
										<?php if ( arbee_has( arbee_v( $arbee_c, 'text' ) ) ) : ?>
											<p class="paraarbeespec"><?php echo arbee_lines( arbee_v( $arbee_c, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>

	<section class="advantagesecbg">
		<div class="container">
			<?php if ( arbee_has( arbee_get( 'export_title' ) ) || $arbee_check ) : ?>
				<div class="exportgok">
					<?php if ( arbee_has( arbee_get( 'export_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'export_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php echo arbee_paras( arbee_get( 'export_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<?php if ( $arbee_check ) : ?>
						<ul class="exportlistgh">
							<?php foreach ( $arbee_check as $arbee_c ) : ?>
								<li><span><img src="<?php echo esc_url( $arbee_check_img ); ?>" alt=""></span><?php echo arbee_text( arbee_v( $arbee_c, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<?php if ( arbee_has( arbee_get( 'export_global_title' ) ) ) : ?>
						<div class="globalkopd">
							<?php if ( arbee_get( 'export_global_icon' ) ) : ?>
								<div class="globekoter"><?php echo arbee_image( arbee_get( 'export_global_icon' ), array( 'alt' => 'globe' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
							<?php endif; ?>
							<div class="globecontfox">
								<h2><?php echo arbee_text( arbee_get( 'export_global_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
								<?php if ( arbee_has( arbee_get( 'export_global_text' ) ) ) : ?>
									<p class="paraarbeespec"><?php echo arbee_lines( arbee_get( 'export_global_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( arbee_has( arbee_get( 'quality_title' ) ) || $arbee_rows ) : ?>
				<div class="exportlort">
					<?php if ( arbee_has( arbee_get( 'quality_title' ) ) ) : ?>
						<h2><?php echo arbee_text( arbee_get( 'quality_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
					<?php endif; ?>
					<?php echo arbee_paras( arbee_get( 'quality_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<?php if ( $arbee_rows ) : ?>
						<div class="paragorbox">
							<ul class="headcatogtab">
								<li><?php echo arbee_text( arbee_get( 'quality_col1' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>
								<li><?php echo arbee_text( arbee_get( 'quality_col2' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>
							</ul>
							<?php foreach ( $arbee_rows as $arbee_r ) : ?>
								<ul class="contcatogpara">
									<li><?php echo arbee_text( arbee_v( $arbee_r, 'label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>
									<li><?php echo arbee_text( arbee_v( $arbee_r, 'value' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>
								</ul>
							<?php endforeach; ?>
							<div style="clear: both;"></div>
							<?php if ( arbee_has( arbee_get( 'quality_note' ) ) ) : ?>
								<p class="paraarbeespec italtacgt"><?php echo arbee_lines( arbee_get( 'quality_note' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( $arbee_benefits ) : ?>
				<div class="protienhoplop">
					<?php foreach ( array_chunk( $arbee_benefits, 2 ) as $arbee_pair ) : ?>
						<div class="wrapprotin">
							<?php foreach ( $arbee_pair as $arbee_b ) : ?>
								<div class="protfopft">
									<?php if ( arbee_v( $arbee_b, 'icon' ) ) : ?>
										<div class="proftjaps"><?php echo arbee_image( arbee_v( $arbee_b, 'icon' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
									<?php endif; ?>
									<div class="protgrapfg">
										<h2><?php echo arbee_lines( arbee_v( $arbee_b, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
										<?php if ( arbee_has( arbee_v( $arbee_b, 'text' ) ) ) : ?>
											<p><?php echo arbee_lines( arbee_v( $arbee_b, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<?php if ( arbee_has( arbee_get( 'meal_title' ) ) ) : ?>
				<div class="mealsetboht">
					<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'meal_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php echo arbee_paras( arbee_get( 'meal_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
			<?php endif; ?>
			<?php if ( $arbee_logos ) : ?>
				<div class="ceryfboxdh">
					<div class="certpochgt">
						<?php if ( arbee_has( arbee_get( 'cert_title' ) ) ) : ?>
							<h2><?php echo arbee_text( arbee_get( 'cert_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
						<?php endif; ?>
					</div>
					<div class="swiper certiconspg certificationSlider">
						<div class="swiper-wrapper">
							<?php foreach ( $arbee_slides as $arbee_logo ) : ?>
								<div class="swiper-slide">
									<div class="certificationBx">
										<?php echo arbee_image( $arbee_logo, array( 'width' => 150, 'height' => 150, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => 'logo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<div style="clear: both;"></div>
		</div>
	</section>

</div>
<?php
get_footer();
