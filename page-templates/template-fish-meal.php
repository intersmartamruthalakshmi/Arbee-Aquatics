<?php
/**
 * Template Name: Product: Fish Meal
 *
 * Converted from fish-meal.php. Can be reused for other products with the same layout.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

get_header();

$arbee_grades  = arbee_rows( 'grades' );
$arbee_sizes   = arbee_rows( 'pack_sizes' );
$arbee_meta    = arbee_rows( 'pack_meta' );
$arbee_clogos  = arbee_rows( 'cert_logos' );
$arbee_steps   = arbee_rows( 'process_steps' );
$arbee_markets = arbee_rows( 'markets' );
$arbee_uses    = arbee_rows( 'uses' );
$arbee_apps    = arbee_rows( 'apps' );
$arbee_shield  = arbee_asset( 'images/shields5.png' );
$arbee_frame   = arbee_asset( 'images/frame145.png' );
?>
<div id="pageWrapper" class="fishmealPage">

	<?php arbee_part( 'sections/page-banner' ); ?>

	<section class="advantagesecbg fishtankpog">
		<div class="container">
			<?php if ( arbee_has( arbee_get( 'intro_title' ) ) || arbee_has( arbee_get( 'intro_text' ) ) ) : ?>
				<div class="advantleftbg fishtropark">
					<div class="framicut"><img src="<?php echo esc_url( $arbee_frame ); ?>" alt=""></div>
					<?php if ( arbee_has( arbee_get( 'intro_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'intro_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php if ( arbee_has( arbee_get( 'intro_subtitle' ) ) ) : ?>
						<h2><?php echo arbee_text( arbee_get( 'intro_subtitle' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
					<?php endif; ?>
					<?php echo arbee_paras( arbee_get( 'intro_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
			<?php endif; ?>
			<?php if ( arbee_get( 'intro_image' ) ) : ?>
				<div class="fishadvatage"><?php echo arbee_image( arbee_get( 'intro_image' ), array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
			<?php endif; ?>
			<?php if ( $arbee_grades ) : ?>
				<div class="rangetogbox">
					<?php if ( arbee_has( arbee_get( 'range_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_text( arbee_get( 'range_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						<?php foreach ( $arbee_grades as $arbee_i => $arbee_g ) : ?>
							<li class="nav-item" role="presentation">
								<button class="nav-link<?php echo 0 === $arbee_i ? ' active' : ''; ?>" id="pills-grade-<?php echo (int) $arbee_i; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-grade-<?php echo (int) $arbee_i; ?>"
									type="button" role="tab" aria-controls="pills-grade-<?php echo (int) $arbee_i; ?>" aria-selected="<?php echo 0 === $arbee_i ? 'true' : 'false'; ?>"><?php echo arbee_text( arbee_v( $arbee_g, 'tab_label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
			<div style="clear: both;"></div>
		</div>
	</section>

	<?php if ( $arbee_grades ) : ?>
		<section class="factorysecbc mealkrapfox">
			<div class="fcactoybgtop"><img src="<?php echo esc_url( arbee_asset( 'images/objectgt.png' ) ); ?>" alt=""></div>
			<div class="container">
				<div class="tab-content" id="pills-tabContent">
					<?php
					foreach ( $arbee_grades as $arbee_i => $arbee_g ) :
						$arbee_specs  = is_array( arbee_v( $arbee_g, 'specs' ) ) ? arbee_v( $arbee_g, 'specs' ) : array();
						$arbee_params = is_array( arbee_v( $arbee_g, 'params' ) ) ? arbee_v( $arbee_g, 'params' ) : array();
						?>
						<div class="tab-pane fade<?php echo 0 === $arbee_i ? ' show active' : ''; ?>" id="pills-grade-<?php echo (int) $arbee_i; ?>" role="tabpanel" aria-labelledby="pills-grade-<?php echo (int) $arbee_i; ?>-tab">
							<div class="mealleftbg">
								<div class="shawgopark"><img src="<?php echo esc_url( $arbee_shield ); ?>" alt=""></div>
								<?php if ( arbee_has( arbee_v( $arbee_g, 'name' ) ) ) : ?>
									<h2><?php echo arbee_text( arbee_v( $arbee_g, 'name' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
								<?php endif; ?>
								<?php if ( arbee_has( arbee_v( $arbee_g, 'title' ) ) ) : ?>
									<h1 class="headstylecom"><?php echo arbee_text( arbee_v( $arbee_g, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
								<?php endif; ?>
								<?php if ( arbee_has( arbee_v( $arbee_g, 'subtitle' ) ) ) : ?>
									<h3><?php echo arbee_lines( arbee_v( $arbee_g, 'subtitle' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
								<?php endif; ?>
								<?php echo arbee_paras( arbee_v( $arbee_g, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
							</div>
							<?php if ( $arbee_specs || $arbee_params ) : ?>
								<div class="mealrightbg">
									<div class="bowlfishmok">
										<?php if ( $arbee_specs ) : ?>
											<?php if ( arbee_has( arbee_v( $arbee_g, 'spec_title' ) ) ) : ?>
												<h2><?php echo arbee_text( arbee_v( $arbee_g, 'spec_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
											<?php endif; ?>
											<ul class="bowllabops">
												<?php foreach ( $arbee_specs as $arbee_s ) : ?>
													<li><span><?php echo arbee_text( arbee_v( $arbee_s, 'label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><?php echo arbee_text( arbee_v( $arbee_s, 'value' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span></li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
										<?php if ( $arbee_params ) : ?>
											<?php if ( arbee_has( arbee_v( $arbee_g, 'param_title' ) ) ) : ?>
												<h2><?php echo arbee_text( arbee_v( $arbee_g, 'param_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
											<?php endif; ?>
											<ul class="bowllabops">
												<?php foreach ( $arbee_params as $arbee_s ) : ?>
													<li><span><?php echo arbee_text( arbee_v( $arbee_s, 'label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><?php echo arbee_text( arbee_v( $arbee_s, 'value' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span></li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</div>
								</div>
							<?php endif; ?>
							<div style="clear: both;"></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( arbee_has( arbee_get( 'source_title' ) ) || arbee_get( 'source_image' ) ) : ?>
		<section class="souspebox">
			<?php if ( arbee_get( 'source_image' ) ) : ?>
				<div class="sousleft"><?php echo arbee_image( arbee_get( 'source_image' ), array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
			<?php endif; ?>
			<div class="sousright">
				<?php if ( arbee_has( arbee_get( 'source_title' ) ) ) : ?>
					<h2><?php echo arbee_text( arbee_get( 'source_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
				<?php endif; ?>
				<?php if ( arbee_has( arbee_get( 'source_subtitle' ) ) ) : ?>
					<h3><?php echo arbee_text( arbee_get( 'source_subtitle' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
				<?php endif; ?>
				<?php echo arbee_paras( arbee_get( 'source_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</div>
			<div style="clear: both;"></div>
		</section>
	<?php endif; ?>

	<section class="advantagesecbg ProcessingMethod">
		<div class="container">
			<?php if ( arbee_has( arbee_get( 'pack_title' ) ) || arbee_has( arbee_get( 'cert_title' ) ) ) : ?>
				<div class="packboxdof">
					<?php if ( arbee_has( arbee_get( 'pack_title' ) ) ) : ?>
						<div class="loppacksr">
							<h2><?php if ( arbee_get( 'pack_icon' ) ) : ?><span><?php echo arbee_image( arbee_get( 'pack_icon' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php endif; ?><?php echo arbee_text( arbee_get( 'pack_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
							<?php if ( arbee_has( arbee_get( 'pack_subtitle' ) ) ) : ?>
								<h3><?php echo arbee_text( arbee_get( 'pack_subtitle' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
							<?php endif; ?>
							<?php if ( $arbee_sizes ) : ?>
								<ul class="lofrapkrap">
									<?php foreach ( $arbee_sizes as $arbee_s ) : ?>
										<li>
											<div class="hraper"><?php if ( arbee_v( $arbee_s, 'icon' ) ) : ?><span><?php echo arbee_image( arbee_v( $arbee_s, 'icon' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php endif; ?>
												<h4><?php echo arbee_text( arbee_v( $arbee_s, 'weight' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h4>
												<h5><?php echo arbee_text( arbee_v( $arbee_s, 'type' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h5>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							<?php foreach ( $arbee_meta as $arbee_m ) : ?>
								<h6><span><?php echo arbee_text( arbee_v( $arbee_m, 'label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span> <?php echo arbee_text( arbee_v( $arbee_m, 'value' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h6>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<?php if ( arbee_has( arbee_get( 'cert_title' ) ) ) : ?>
						<div class="loppacksr hopwork">
							<h2><?php if ( arbee_get( 'cert_icon' ) ) : ?><span><?php echo arbee_image( arbee_get( 'cert_icon' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php endif; ?><?php echo arbee_text( arbee_get( 'cert_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
							<?php if ( arbee_has( arbee_get( 'cert_subtitle' ) ) ) : ?>
								<h3><?php echo arbee_text( arbee_get( 'cert_subtitle' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
							<?php endif; ?>
							<?php if ( $arbee_clogos ) : ?>
								<div class="certipacketbx">
									<ul class="owl-carousel owl-theme certsliderpog">
										<?php foreach ( $arbee_clogos as $arbee_l ) : ?>
											<?php $arbee_url = arbee_v( $arbee_l, 'url' ); ?>
											<li class="item"><a<?php echo $arbee_url ? ' href="' . esc_url( $arbee_url ) . '"' : ''; ?>><?php echo arbee_image( arbee_v( $arbee_l, 'logo' ), array( 'alt' => 'logo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
										<?php endforeach; ?>
									</ul>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( arbee_has( arbee_get( 'process_title' ) ) || $arbee_steps ) : ?>
				<div class="processpod">
					<?php if ( arbee_has( arbee_get( 'process_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_text( arbee_get( 'process_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php if ( arbee_has( arbee_get( 'process_subtitle' ) ) ) : ?>
						<h2><?php echo arbee_text( arbee_get( 'process_subtitle' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
					<?php endif; ?>
					<?php if ( $arbee_steps ) : ?>
						<ul class="methodlab">
							<?php foreach ( $arbee_steps as $arbee_s ) : ?>
								<li><a><?php if ( arbee_v( $arbee_s, 'icon' ) ) : ?><span><?php echo arbee_image( arbee_v( $arbee_s, 'icon' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php endif; ?>
										<h3><?php echo arbee_lines( arbee_v( $arbee_s, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
										<?php if ( arbee_has( arbee_v( $arbee_s, 'text' ) ) ) : ?>
											<h4><?php echo arbee_lines( arbee_v( $arbee_s, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h4>
										<?php endif; ?>
									</a></li>
							<?php endforeach; ?>
						</ul>
						<div class="dotproceed"></div>
					<?php endif; ?>
					<div style="clear: both;"></div>
					<?php echo arbee_link( arbee_get( 'process_button' ), 'procbtndoc' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
			<?php endif; ?>
			<?php if ( arbee_has( arbee_get( 'markets_title' ) ) || $arbee_markets ) : ?>
				<div class="marketbog">
					<?php if ( arbee_has( arbee_get( 'markets_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_text( arbee_get( 'markets_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php if ( arbee_has( arbee_get( 'markets_text' ) ) ) : ?>
						<p class="paraarbeespec"><?php echo arbee_lines( arbee_get( 'markets_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
					<?php endif; ?>
					<?php if ( $arbee_markets ) : ?>
						<div class="swiper countrySlider">
							<div class="swiper-wrapper">
								<?php foreach ( $arbee_markets as $arbee_c ) : ?>
									<div class="swiper-slide">
										<div class="countryBx">
											<?php if ( arbee_v( $arbee_c, 'flag' ) ) : ?>
												<div class="icon">
													<?php echo arbee_image( arbee_v( $arbee_c, 'flag' ), array( 'width' => 90, 'height' => 60, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => 'flag' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
												</div>
											<?php endif; ?>
											<div class="txt"><?php echo arbee_text( arbee_v( $arbee_c, 'name' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( $arbee_uses || $arbee_apps ) : ?>
				<div class="wideboxfg">
					<?php if ( $arbee_uses ) : ?>
						<?php if ( arbee_has( arbee_get( 'uses_title' ) ) ) : ?>
							<h2><?php echo arbee_text( arbee_get( 'uses_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
						<?php endif; ?>
						<div class="anglebodf">
							<div class="swiper angleSlider">
								<div class="swiper-wrapper">
									<?php foreach ( $arbee_uses as $arbee_u ) : ?>
										<div class="swiper-slide">
											<div class="angleBx">
												<div class="title"><?php echo arbee_text( arbee_v( $arbee_u, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
												<?php if ( arbee_has( arbee_v( $arbee_u, 'text' ) ) ) : ?>
													<div class="txt"><?php echo arbee_lines( arbee_v( $arbee_u, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
												<?php endif; ?>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( $arbee_apps ) : ?>
						<?php if ( arbee_has( arbee_get( 'apps_title' ) ) ) : ?>
							<h2><?php echo arbee_text( arbee_get( 'apps_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
						<?php endif; ?>
						<div class="applicapbox">
							<div class="swiper appSlider">
								<div class="swiper-wrapper">
									<?php foreach ( $arbee_apps as $arbee_a ) : ?>
										<div class="swiper-slide">
											<div class="appBx">
												<?php if ( arbee_v( $arbee_a, 'icon' ) ) : ?>
													<div class="icon">
														<?php echo arbee_image( arbee_v( $arbee_a, 'icon' ), array( 'width' => 40, 'height' => 40, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
													</div>
												<?php endif; ?>
												<div class="txt"><?php echo arbee_lines( arbee_v( $arbee_a, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( arbee_has( arbee_get( 'cta_title' ) ) ) : ?>
				<div class="chainbox">
					<div class="chaisw1"><img src="<?php echo esc_url( $arbee_shield ); ?>" alt=""></div>
					<div class="chaisw2"><img src="<?php echo esc_url( $arbee_shield ); ?>" alt=""></div>
					<div class="racarbox">
						<h1 class="headstylecom"><?php echo arbee_text( arbee_get( 'cta_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
						<?php if ( arbee_has( arbee_get( 'cta_text' ) ) ) : ?>
							<p class="paraarbeespec"><?php echo arbee_lines( arbee_get( 'cta_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
						<?php endif; ?>
						<?php echo arbee_link( arbee_get( 'cta_button' ), 'racarboxbtn' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</div>
				</div>
			<?php endif; ?>
			<div style="clear: both;"></div>
		</div>
	</section>

	<?php if ( arbee_has( arbee_get( 'keywords' ) ) ) : ?>
		<section class="factorysecbc botsapbox">
			<div class="container">
				<p class="paraarbeespec"><?php echo arbee_lines( arbee_get( 'keywords' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>
</div>
<?php
get_footer();
