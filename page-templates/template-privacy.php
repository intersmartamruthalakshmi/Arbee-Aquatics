<?php
/**
 * Template Name: Privacy / Legal
 *
 * Converted from privacy.php. Also suitable for Terms & Conditions.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div id="pageWrapper" class="contactPage">

	<?php arbee_part( 'sections/page-banner' ); ?>

	<section class="advantagesecbg privacparm">
		<div class="container">
			<div class="privaccon">
				<?php if ( arbee_has( arbee_get( 'legal_title' ) ) ) : ?>
					<h2><?php echo arbee_text( arbee_get( 'legal_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
				<?php endif; ?>
				<?php if ( arbee_has( arbee_get( 'legal_date' ) ) ) : ?>
					<h3><?php echo arbee_text( arbee_get( 'legal_date' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
				<?php endif; ?>
				<?php echo wp_kses_post( (string) arbee_get( 'legal_body' ) ); ?>
			</div>
			<div style="clear: both;"></div>
		</div>
	</section>

</div>
<?php
get_footer();
