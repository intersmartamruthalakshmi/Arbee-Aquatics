<?php
/**
 * Default page template (pages without one of the custom templates).
 * Uses the same banner + legal content styling as privacy.php.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div id="pageWrapper" class="contactPage">
	<section class="innerpagebgbanner privacybg">
		<div class="innerbgsecimg"><img src="<?php echo esc_url( arbee_asset( 'images/privacybg.jpg' ) ); ?>" alt=""></div>
	</section>
	<section class="advantagesecbg privacparm">
		<div class="container">
			<div class="privaccon">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>
			<div style="clear: both;"></div>
		</div>
	</section>
</div>
<?php
get_footer();
