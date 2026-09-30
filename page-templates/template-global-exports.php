<?php
/**
 * Template Name: Global Exports
 *
 * Converted from global-exports.php.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

get_header();

$arbee_grades  = arbee_rows( 'fm_grades' );
$arbee_rows    = arbee_rows( 'fm_rows' );
$arbee_regions = arbee_rows( 'oil_regions' );
$arbee_apps    = arbee_rows( 'apps' );
$arbee_docs    = arbee_rows( 'log_docs' );
$arbee_shield  = arbee_asset( 'images/shields5.png' );
?>
<div id="pageWrapper" class="sustainabilityPage">

	<?php arbee_part( 'sections/page-banner' ); ?>

	<?php if ( arbee_has( arbee_get( 'fm_title' ) ) || $arbee_rows ) : ?>
		<section class="advantagesecbg globalsevfg">
			<div class="container">
				<div class="mealleftbg">
					<?php if ( arbee_has( arbee_get( 'fm_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'fm_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php echo arbee_paras( arbee_get( 'fm_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<?php if ( $arbee_grades ) : ?>
						<ul class="grotpack">
							<?php foreach ( $arbee_grades as $arbee_g ) : ?>
								<li><?php echo arbee_text( arbee_v( $arbee_g, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
				<?php if ( $arbee_rows ) : ?>
					<div class="mealrightbg">
						<div class="paragorbox">
							<ul class="headcatogtab">
								<li><?php echo arbee_text( arbee_get( 'fm_col1' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>
								<li><?php echo arbee_text( arbee_get( 'fm_col2' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>
							</ul>
							<?php foreach ( $arbee_rows as $arbee_r ) : ?>
								<ul class="contcatogpara">
									<li><?php echo arbee_text( arbee_v( $arbee_r, 'label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>
									<li><?php echo arbee_text( arbee_v( $arbee_r, 'value' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>
								</ul>
							<?php endforeach; ?>
							<div style="clear: both;"></div>
						</div>
					</div>
				<?php endif; ?>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( arbee_has( arbee_get( 'oil_title' ) ) || $arbee_regions || $arbee_apps ) : ?>
		<section class="advantagesecbg marketbgsop">
			<div class="container">
				<div class="markeshop">
					<?php if ( arbee_has( arbee_get( 'oil_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'oil_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php if ( arbee_has( arbee_get( 'oil_text' ) ) ) : ?>
						<p class="paraarbeespec"><?php echo arbee_lines( arbee_get( 'oil_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
					<?php endif; ?>
				</div>
				<?php if ( $arbee_regions ) : ?>
					<div class="marketarea">
						<?php foreach ( $arbee_regions as $arbee_reg ) : ?>
							<?php $arbee_list = is_array( arbee_v( $arbee_reg, 'countries' ) ) ? arbee_v( $arbee_reg, 'countries' ) : array(); ?>
							<div class="marketsetbox">
								<?php if ( arbee_v( $arbee_reg, 'map' ) ) : ?>
									<div class="mapmarket"><?php echo arbee_image( arbee_v( $arbee_reg, 'map' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
								<?php endif; ?>
								<h2><?php echo arbee_text( arbee_v( $arbee_reg, 'name' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
								<?php if ( $arbee_list ) : ?>
									<ul>
										<?php foreach ( $arbee_list as $arbee_c ) : ?>
											<li><a>
													<h3><?php echo arbee_text( arbee_v( $arbee_c, 'name' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?> <?php if ( arbee_v( $arbee_c, 'flag' ) ) : ?><span><?php echo arbee_image( arbee_v( $arbee_c, 'flag' ), array( 'alt' => 'flag' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php endif; ?></h3>
												</a></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<?php if ( $arbee_apps ) : ?>
					<div class="exportbox">
						<?php if ( arbee_has( arbee_get( 'apps_title' ) ) ) : ?>
							<h2><?php echo arbee_text( arbee_get( 'apps_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
						<?php endif; ?>
						<ul>
							<?php foreach ( $arbee_apps as $arbee_a ) : ?>
								<li><a><?php if ( arbee_v( $arbee_a, 'icon' ) ) : ?><span><?php echo arbee_image( arbee_v( $arbee_a, 'icon' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php endif; ?>
										<h3><?php echo arbee_lines( arbee_v( $arbee_a, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
									</a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>

	<section class="advantagesecbg">
		<div class="container">
			<?php if ( arbee_get( 'log_image' ) ) : ?>
				<div class="logistboxbg"><?php echo arbee_image( arbee_get( 'log_image' ), array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
			<?php endif; ?>
			<?php if ( arbee_has( arbee_get( 'log_title' ) ) || $arbee_docs ) : ?>
				<div class="logistcont">
					<?php if ( arbee_has( arbee_get( 'log_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'log_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php echo arbee_paras( arbee_get( 'log_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<?php if ( $arbee_docs ) : ?>
						<ul>
							<?php foreach ( $arbee_docs as $arbee_d ) : ?>
								<li><a><?php if ( arbee_v( $arbee_d, 'icon' ) ) : ?><span><?php echo arbee_image( arbee_v( $arbee_d, 'icon' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php endif; ?>
										<h3><?php echo arbee_lines( arbee_v( $arbee_d, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
									</a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div style="clear: both;"></div>
			<?php if ( arbee_has( arbee_get( 'cta_title' ) ) ) : ?>
				<div class="chainbox exportfork">
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

</div>
<?php
get_footer();
