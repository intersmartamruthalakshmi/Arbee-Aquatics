<?php
/**
 * Fallback template (blog index / archives / search). The original site had no blog;
 * this keeps any such URL on-brand instead of showing an unstyled page.
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
				<?php if ( have_posts() ) : ?>
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>
					<?php endwhile; ?>
					<?php the_posts_pagination(); ?>
				<?php else : ?>
					<h2><?php esc_html_e( 'Nothing found', 'arbee' ); ?></h2>
				<?php endif; ?>
			</div>
			<div style="clear: both;"></div>
		</div>
	</section>
</div>
<?php
get_footer();
