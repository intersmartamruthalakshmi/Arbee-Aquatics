<?php
/**
 * Template Name: Sustainability
 *
 * Converted from sustainability.php.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

get_header();

$arbee_clean   = arbee_rows( 'clean_items' );
$arbee_commits = arbee_rows( 'commitments' );
?>
<div id="pageWrapper" class="sustainabilityPage">

	<?php arbee_part( 'sections/page-banner' ); ?>

	<?php if ( arbee_has( arbee_get( 'intro_title' ) ) || arbee_get( 'intro_image' ) ) : ?>
		<section class="advantagesecbg">
			<div class="container">
				<div class="sustainleft">
					<?php if ( arbee_has( arbee_get( 'intro_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_inline( arbee_get( 'intro_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php if ( arbee_has( arbee_get( 'intro_subtitle' ) ) ) : ?>
						<h2><?php echo arbee_text( arbee_get( 'intro_subtitle' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
					<?php endif; ?>
					<?php echo arbee_paras( arbee_get( 'intro_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
				<?php if ( arbee_get( 'intro_image' ) ) : ?>
					<div class="sustainright"><?php echo arbee_image( arbee_get( 'intro_image' ), array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
				<?php endif; ?>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( arbee_has( arbee_get( 'clean_title' ) ) || $arbee_clean ) : ?>
		<section class="advantagesecbg sustbokap">
			<div class="container">
				<div class="supleftgt">
					<?php if ( arbee_has( arbee_get( 'clean_title' ) ) ) : ?>
						<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'clean_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php endif; ?>
					<?php echo arbee_paras( arbee_get( 'clean_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
				<?php if ( $arbee_clean ) : ?>
					<div class="suprightgt">
						<ul>
							<?php foreach ( $arbee_clean as $arbee_c ) : ?>
								<li> <?php if ( arbee_v( $arbee_c, 'icon' ) ) : ?><span><?php echo arbee_image( arbee_v( $arbee_c, 'icon' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php endif; ?>
									<h3><?php echo arbee_lines( arbee_v( $arbee_c, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
									<?php if ( arbee_has( arbee_v( $arbee_c, 'text' ) ) ) : ?>
										<p class="paraarbeespec"><?php echo arbee_lines( arbee_v( $arbee_c, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( arbee_has( arbee_get( 'commit_title' ) ) || $arbee_commits ) : ?>
		<section class="advantagesecbg">
			<div class="container">
				<?php if ( arbee_has( arbee_get( 'commit_title' ) ) ) : ?>
					<div class="commitboxfg">
						<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'commit_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					</div>
				<?php endif; ?>
				<?php if ( $arbee_commits ) : ?>
					<div class="souceboxjk">
						<ul>
							<?php foreach ( $arbee_commits as $arbee_i => $arbee_c ) : ?>
								<li>
									<h2><?php echo esc_html( arbee_index( $arbee_i ) ); ?></h2>
									<h3><?php echo arbee_text( arbee_v( $arbee_c, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
									<?php if ( arbee_has( arbee_v( $arbee_c, 'text' ) ) ) : ?>
										<p class="paraarbeespec"><?php echo arbee_lines( arbee_v( $arbee_c, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<div style="clear: both;"></div>
			</div>
		</section>
	<?php endif; ?>

</div>
<?php
get_footer();
