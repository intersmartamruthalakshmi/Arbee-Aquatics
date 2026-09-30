<?php
/**
 * Template Name: About Us
 *
 * Converted from about.php.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

get_header();

$arbee_overlay = arbee_asset( 'images/objectgt.png' );
?>
<div id="pageWrapper" class="aboutPage">

	<?php arbee_part( 'sections/page-banner' ); ?>

	<?php arbee_part( 'sections/trusted' ); ?>

	<?php if ( arbee_has( arbee_get( 'factory_title' ) ) || arbee_get( 'factory_image' ) ) : ?>
		<section class="factorysecbc">
			<div class="fcactoybgtop"><img src="<?php echo esc_url( $arbee_overlay ); ?>" alt=""></div>
			<div class="container">
				<div class="freshfactleft">
					<?php if ( arbee_has( arbee_get( 'factory_eyebrow' ) ) ) : ?>
						<h2><?php echo arbee_text( arbee_get( 'factory_eyebrow' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
					<?php endif; ?>
					<?php if ( arbee_has( arbee_get( 'factory_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'factory_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php echo arbee_paras( arbee_get( 'factory_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
				<?php if ( arbee_get( 'factory_image' ) ) : ?>
					<div class="freshfactright"><?php echo arbee_image( arbee_get( 'factory_image' ), array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
				<?php endif; ?>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>

	<?php $arbee_companies = arbee_rows( 'group_companies' ); ?>
	<?php if ( arbee_has( arbee_get( 'group_title' ) ) || $arbee_companies ) : ?>
		<section class="agecytabbc">
			<div class="fcactoybgtop"><img src="<?php echo esc_url( $arbee_overlay ); ?>" alt=""></div>
			<div class="container">
				<div class="protiebopfg">
					<div class="hoplorot">
						<?php if ( arbee_has( arbee_get( 'group_title' ) ) ) : ?>
							<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'group_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
						<?php endif; ?>
						<?php if ( arbee_has( arbee_get( 'group_intro' ) ) ) : ?>
							<p class="paraarbeespec"><?php echo arbee_lines( arbee_get( 'group_intro' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
						<?php endif; ?>
					</div>
					<?php if ( arbee_get( 'group_logo' ) ) : ?>
						<div class="hawbox"><?php echo arbee_image( arbee_get( 'group_logo' ), array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<?php endif; ?>
				</div>
				<div class="sliderpropwarp">
					<div class="leftprotihop">
						<?php if ( arbee_has( arbee_get( 'group_text' ) ) ) : ?>
							<p class="paraarbeespec"><?php echo arbee_lines( arbee_get( 'group_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
						<?php endif; ?>
					</div>
					<?php if ( $arbee_companies ) : ?>
						<div class="agentsliderfop">
							<div class="owl-carousel owl-theme slideragent">
								<?php foreach ( $arbee_companies as $arbee_c ) : ?>
									<?php $arbee_url = arbee_v( $arbee_c, 'url' ); ?>
									<a class="item"<?php echo $arbee_url ? ' href="' . esc_url( $arbee_url ) . '"' : ''; ?>><?php echo arbee_image( arbee_v( $arbee_c, 'image' ), array( 'alt' => arbee_v( $arbee_c, 'name' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
										<div class="fopsort"></div>
										<span>
											<h3><?php echo arbee_text( arbee_v( $arbee_c, 'name' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
											<?php if ( arbee_has( arbee_v( $arbee_c, 'description' ) ) ) : ?>
												<h4><?php echo arbee_text( arbee_v( $arbee_c, 'description' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h4>
											<?php endif; ?>
										</span>
									</a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( arbee_has( arbee_get( 'vm_title' ) ) || arbee_has( arbee_get( 'vision_text' ) ) || arbee_has( arbee_get( 'mission_text' ) ) ) : ?>
		<section class="vissonecgsecbg">
			<div class="vissoniagehop"><img src="<?php echo esc_url( arbee_asset( 'images/objectgtright.png' ) ); ?>" alt=""></div>
			<div class="container">
				<?php if ( arbee_get( 'vm_image' ) ) : ?>
					<div class="rightvissonimg"><?php echo arbee_image( arbee_get( 'vm_image' ), array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
				<?php endif; ?>
				<div class="vissonfctrgt">
					<div class="gopvisson">
						<?php if ( arbee_has( arbee_get( 'vm_title' ) ) ) : ?>
							<h1 class="headstylecom"><?php echo arbee_text( arbee_get( 'vm_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
						<?php endif; ?>
						<?php if ( arbee_has( arbee_get( 'vision_title' ) ) ) : ?>
							<h2><?php if ( arbee_get( 'vision_icon' ) ) : ?><span><?php echo arbee_image( arbee_get( 'vision_icon' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span> <?php endif; ?><?php echo arbee_text( arbee_get( 'vision_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
						<?php endif; ?>
						<?php if ( arbee_has( arbee_get( 'vision_text' ) ) ) : ?>
							<p class="paraarbeespec"><?php echo arbee_lines( arbee_get( 'vision_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
						<?php endif; ?>
					</div>
					<div class="gopvissonrap">
						<?php if ( arbee_has( arbee_get( 'mission_title' ) ) ) : ?>
							<h2><?php if ( arbee_get( 'mission_icon' ) ) : ?><span><?php echo arbee_image( arbee_get( 'mission_icon' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span> <?php endif; ?><?php echo arbee_text( arbee_get( 'mission_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
						<?php endif; ?>
						<?php if ( arbee_has( arbee_get( 'mission_text' ) ) ) : ?>
							<p class="paraarbeespec"><?php echo arbee_lines( arbee_get( 'mission_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
						<?php endif; ?>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( arbee_has( arbee_get( 'nature_title' ) ) || arbee_get( 'nature_image' ) ) : ?>
		<section class="factorysecbc whitfactbg">
			<div class="fcactoybgtop"><img src="<?php echo esc_url( $arbee_overlay ); ?>" alt=""></div>
			<div class="container">
				<div class="freshfactleft">
					<?php if ( arbee_has( arbee_get( 'nature_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'nature_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php echo arbee_paras( arbee_get( 'nature_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
				<?php if ( arbee_get( 'nature_image' ) ) : ?>
					<div class="freshfactright"><?php echo arbee_image( arbee_get( 'nature_image' ), array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
				<?php endif; ?>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( arbee_has( arbee_get( 'perf_title' ) ) || arbee_get( 'perf_image' ) ) : ?>
		<section class="factorysecbc perfbgtog">
			<div class="fcactoybgtop"><img src="<?php echo esc_url( $arbee_overlay ); ?>" alt=""></div>
			<div class="container">
				<?php if ( arbee_get( 'perf_image' ) ) : ?>
					<div class="freshfactright"><?php echo arbee_image( arbee_get( 'perf_image' ), array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
				<?php endif; ?>
				<div class="freshfactleft">
					<?php if ( arbee_has( arbee_get( 'perf_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'perf_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php echo arbee_paras( arbee_get( 'perf_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>

</div>
<?php
get_footer();
