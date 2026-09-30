<?php
/**
 * "Request a Quote" modal — from includes/footer.php (#exampleModal).
 * The commented-out legacy modal in the original was dropped.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

$arbee_topics = array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) arbee_opt( 'quote_topics' ) ) ) ) );
$arbee_ph     = arbee_opt( 'quote_topic_placeholder' );
?>
<div class="modal fade arbeeModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="overlayImg">
			<img src="<?php echo esc_url( arbee_asset( 'images/modal-overlay.svg' ) ); ?>" width="900" height="700" loading="lazy" class="lazy"
				alt="">
		</div>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php esc_attr_e( 'Close', 'arbee' ); ?>"></button>
			</div>
			<div class="modal-body">
				<div class="dFlx">
					<div class="lSide">
						<div class="imgBx">
							<?php echo arbee_image( arbee_opt( 'quote_image' ), array( 'width' => 470, 'height' => 630, 'loading' => 'lazy', 'class' => 'lazy', 'alt' => 'Pop Image' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						</div>
					</div>
					<div class="rgSide">
						<?php if ( arbee_has( arbee_opt( 'quote_title' ) ) ) : ?>
							<div class="title" id="exampleModalLabel"><?php echo arbee_text( arbee_opt( 'quote_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
						<?php endif; ?>
						<form action="" method="post" class="arbee-enquiry-form" novalidate>
							<input type="hidden" name="form" value="quote">
							<div class="arbee-hp" aria-hidden="true">
								<label for="quote_website">Website</label>
								<input type="text" id="quote_website" name="website" tabindex="-1" autocomplete="off">
							</div>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="quote_full_name"><?php echo arbee_text( arbee_opt( 'quote_label_name' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
										<input type="text" id="quote_full_name" name="full_name" placeholder="<?php echo esc_attr( arbee_opt( 'quote_ph_name' ) ); ?>" class="form-control"
											required data-validate="required" autocomplete="name" maxlength="120">
										<div class="help-block danger d-none">Invalid Input</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="mobile_code"><?php echo arbee_text( arbee_opt( 'quote_label_code' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
										<input type="text" placeholder="" class="form-control mobile_code"
											id="mobile_code" name="country_code_display" required>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label for="quote_phone"><?php echo arbee_text( arbee_opt( 'quote_label_phone' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
										<input type="tel" id="quote_phone" name="phone" placeholder="<?php echo esc_attr( arbee_opt( 'quote_ph_phone' ) ); ?>" class="form-control"
											required data-validate="required phone" autocomplete="tel-national">
										<div class="help-block danger d-none">Invalid Input</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="quote_email"><?php echo arbee_text( arbee_opt( 'quote_label_email' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
										<input type="email" id="quote_email" name="email" placeholder="<?php echo esc_attr( arbee_opt( 'quote_ph_email' ) ); ?>" class="form-control"
											required data-validate="required email" autocomplete="email">
										<div class="help-block danger d-none">Invalid Input</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group select">
										<label for="quote_topic"><?php echo arbee_text( arbee_opt( 'quote_label_topic' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
										<select class="form-control select2" id="quote_topic" name="topic" data-select2-id="select2" data-validate="required"
											aria-label="<?php echo esc_attr( arbee_opt( 'quote_label_topic' ) ); ?>">
											<?php if ( arbee_has( $arbee_ph ) ) : ?>
												<option value="" selected disabled="disabled"><?php echo arbee_text( $arbee_ph ); // phpcs:ignore WordPress.Security.EscapeOutput ?></option>
											<?php endif; ?>
											<?php foreach ( $arbee_topics as $arbee_topic ) : ?>
												<option value="<?php echo esc_attr( $arbee_topic ); ?>"><?php echo esc_html( $arbee_topic ); ?></option>
											<?php endforeach; ?>
										</select>
										<div class="help-block danger d-none">Invalid Input</div>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="quote_comments"><?php echo arbee_text( arbee_opt( 'quote_label_comments' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
										<textarea name="comments" placeholder="<?php echo esc_attr( arbee_opt( 'quote_ph_comments' ) ); ?>" class="form-control" id="quote_comments" maxlength="5000"></textarea>
									</div>
								</div>
							</div>
							<div class="btnWrap">
								<button type="submit" class="expmorebth"><?php echo arbee_text( arbee_opt( 'quote_submit' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
