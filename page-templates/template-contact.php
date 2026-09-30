<?php
/**
 * Template Name: Contact Us
 *
 * Converted from contact.php. The form (HTML-only in the original) now submits
 * through inc/forms.php.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

get_header();

$arbee_lines_of = function ( $name ) {
	return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) arbee_get( $name ) ) ) ) );
};
$arbee_codes  = $arbee_lines_of( 'form_codes' );
$arbee_topics = $arbee_lines_of( 'form_topics' );
$arbee_items  = arbee_rows( 'touch_items' );
?>
<div id="pageWrapper" class="contactPage">

	<?php arbee_part( 'sections/page-banner' ); ?>

	<section class="advantagesecbg">
		<div class="container">
			<div class="contactcap">
				<?php if ( arbee_has( arbee_get( 'form_title' ) ) ) : ?>
					<h1 class="headstylecom"><?php echo arbee_text( arbee_get( 'form_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
				<?php endif; ?>
				<?php if ( arbee_has( arbee_get( 'form_text' ) ) ) : ?>
					<p class="paraarbeespec"><?php echo arbee_lines( arbee_get( 'form_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
				<?php endif; ?>
				<form class="contsoap arbee-enquiry-form" action="" method="post" novalidate>
					<input type="hidden" name="form" value="contact">
					<div class="arbee-hp" aria-hidden="true">
						<label for="contact_website">Website</label>
						<input type="text" id="contact_website" name="website" tabindex="-1" autocomplete="off">
					</div>
					<div class="contrleft">
						<div class="contrbook">
							<div class="covercontact"> <label class="conspanfox" for="contact_full_name"><?php echo arbee_text( arbee_get( 'form_label_name' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
								<input type="text" id="contact_full_name" name="full_name" class="form-control" placeholder="<?php echo esc_attr( arbee_get( 'form_ph_name' ) ); ?>" required data-validate="required" autocomplete="name" maxlength="120">
							</div>
						</div>
						<div class="contrbook">
							<div class="covercontact1"> <label class="conspanfox" for="contact_phone"><?php echo arbee_text( arbee_get( 'form_label_phone' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label><span class="flagcontact"><img
										src="<?php echo esc_url( arbee_asset( 'images/flag.png' ) ); ?>" alt="" /></span>
								<select class="form-select" name="country_code" aria-label="<?php esc_attr_e( 'Country code', 'arbee' ); ?>">
									<?php foreach ( $arbee_codes as $arbee_code ) : ?>
										<option value="<?php echo esc_attr( $arbee_code ); ?>"><?php echo esc_html( $arbee_code ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="covercontact2">
								<input type="tel" id="contact_phone" name="phone" class="form-control" placeholder="<?php echo esc_attr( arbee_get( 'form_ph_phone' ) ); ?>" required data-validate="required phone" autocomplete="tel-national">
							</div>
							<div style="clear: both;"></div>
						</div>
						<div class="jackwop">
							<div class="jackwopleft">
								<div class="contrbook">
									<div class="covercontact"> <label class="conspanfox" for="contact_email"><?php echo arbee_text( arbee_get( 'form_label_email' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
										<input type="email" id="contact_email" name="email" class="form-control" placeholder="<?php echo esc_attr( arbee_get( 'form_ph_email' ) ); ?>" required data-validate="required email" autocomplete="email">
									</div>
								</div>
							</div>
							<div class="jackwopright">
								<div class="contrbook">
									<div class="covercontact"> <label class="conspanfox" for="contact_topic"><?php echo arbee_text( arbee_get( 'form_label_topic' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
										<select class="form-select" id="contact_topic" name="topic" data-validate="required">
											<?php foreach ( $arbee_topics as $arbee_topic ) : ?>
												<option value="<?php echo esc_attr( $arbee_topic ); ?>"><?php echo esc_html( $arbee_topic ); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="contright">
						<div class="contrtextarea">
							<div class="covertextarea"> <label class="conspanfox" for="contact_comments"><?php echo arbee_text( arbee_get( 'form_label_comments' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
								<textarea class="form-control" id="contact_comments" name="comments" placeholder="<?php echo esc_attr( arbee_get( 'form_ph_comments' ) ); ?>" rows="8" maxlength="5000"></textarea>
							</div>
						</div>
						<button type="submit" class="enqurfobtn"><?php echo arbee_text( arbee_get( 'form_submit' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
						<div style="clear: both;"></div>
					</div>
				</form>
			</div>
			<div class="gettouchbox">
				<div class="innergetbox">
					<div class="getlefthg">
						<?php if ( arbee_has( arbee_get( 'touch_title' ) ) ) : ?>
							<h1><?php echo arbee_lines( arbee_get( 'touch_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
						<?php endif; ?>
						<?php if ( arbee_has( arbee_get( 'touch_text' ) ) ) : ?>
							<p><?php echo arbee_lines( arbee_get( 'touch_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
						<?php endif; ?>
					</div>
					<?php if ( arbee_has( arbee_get( 'factory_title' ) ) || arbee_has( arbee_get( 'factory_address' ) ) ) : ?>
						<div class="getrighthg">
							<h2><?php if ( arbee_get( 'factory_icon' ) ) : ?><span><?php echo arbee_image( arbee_get( 'factory_icon' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><br><?php endif; ?>
								<?php echo arbee_text( arbee_get( 'factory_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
							<?php if ( arbee_has( arbee_get( 'factory_address' ) ) ) : ?>
								<p><?php echo arbee_lines( arbee_get( 'factory_address' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
				<?php if ( $arbee_items ) : ?>
					<div class="getwarkbox">
						<ul>
							<?php foreach ( $arbee_items as $arbee_it ) : ?>
								<?php $arbee_url = trim( (string) arbee_v( $arbee_it, 'url' ) ); ?>
								<li><a<?php echo $arbee_url ? ' href="' . esc_url( $arbee_url, array( 'http', 'https', 'mailto', 'tel' ) ) . '"' : ''; ?>><?php if ( arbee_v( $arbee_it, 'icon' ) ) : ?><span><?php echo arbee_image( arbee_v( $arbee_it, 'icon' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php endif; ?>
										<div class="wapsark">
											<h3><?php echo arbee_text( arbee_v( $arbee_it, 'title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h3>
											<h4><?php echo arbee_text( arbee_v( $arbee_it, 'value' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h4>
										</div>
									</a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( arbee_has( arbee_get( 'careers_title' ) ) ) : ?>
				<div class="shapebord">
					<div class="leftfapsop">
						<h1><?php echo arbee_text( arbee_get( 'careers_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
						<?php if ( arbee_has( arbee_get( 'careers_text' ) ) ) : ?>
							<p class="paraarbeespec"><?php echo arbee_lines( arbee_get( 'careers_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
						<?php endif; ?>
						<?php echo arbee_link( arbee_get( 'careers_button' ), 'explorebtn' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<div style="clear: both;"></div>
					</div>
					<?php if ( arbee_get( 'careers_image' ) ) : ?>
						<div class="rightfapsop"><?php echo arbee_image( arbee_get( 'careers_image' ), array( 'alt' => 'photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div style="clear: both;"></div>
		</div>
	</section>

</div>
<?php
get_footer();
