<?php
/**
 * Site-wide outgoing mail: custom From name/email.
 * Settings live under Theme Settings → Form delivery.
 * Transport itself (SMTP vs PHP mail()) is left to a dedicated plugin
 * (e.g. WP Mail SMTP) rather than a theme-level relay - that way outgoing
 * mail still attempts delivery via PHP mail() if no plugin is configured,
 * instead of silently depending on theme settings nobody filled in.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

/**
 * Wraps inner HTML in a standard branded shell — logo header, white content
 * card, plain-text footer — so every system email (enquiry notifications,
 * confirmations) looks consistent.
 */
function arbee_email_template( $heading, $inner_html ) {
	$site     = wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES );
	$logo_id  = arbee_opt( 'footer_logo' );
	$logo_url = $logo_id ? wp_get_attachment_image_url( $logo_id, 'medium' ) : '';
	$year     = gmdate( 'Y' );

	ob_start();
	?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="margin:0; padding:0; background:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">
	<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4; padding:30px 0;">
		<tr>
			<td align="center">
				<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%; background:#ffffff; border-radius:6px; overflow:hidden;">
					<tr>
						<td style="padding:24px; text-align:center;">
							<?php if ( $logo_url ) : ?>
								<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $site ); ?>" style="max-height:48px; max-width:220px;">
							<?php else : ?>
								<span style="color:#102b5a; font-size:20px; font-weight:bold;"><?php echo esc_html( $site ); ?></span>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td style="padding:30px; color:#333333; font-size:15px; line-height:1.6;">
							<h2 style="margin:0 0 20px; color:#102b5a; font-size:20px;"><?php echo esc_html( $heading ); ?></h2>
							<?php echo $inner_html; // phpcs:ignore WordPress.Security.EscapeOutput ?>
						</td>
					</tr>
					<tr>
						<td style="background:#f4f4f4; padding:16px 30px; text-align:center; font-size:12px; color:#888888;">
							&copy; <?php echo esc_html( $year . ' ' . $site ); ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
	<?php
	return ob_get_clean();
}

add_filter(
	'wp_mail_from',
	function ( $email ) {
		$from = (string) arbee_opt( 'mail_from_email' );
		return ( '' !== $from && is_email( $from ) ) ? $from : $email;
	}
);

add_filter(
	'wp_mail_from_name',
	function ( $name ) {
		$from = (string) arbee_opt( 'mail_from_name' );
		return arbee_has( $from ) ? $from : $name;
	}
);
