<?php
/**
 * Site-wide outgoing mail: custom From name/email, optional Brevo SMTP relay.
 * Settings live under Theme Settings → Form delivery / Email delivery (Brevo).
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
	$logo_id  = arbee_opt( 'header_logo' );
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
						<td style="background:#0089cf; padding:24px; text-align:center;">
							<?php if ( $logo_url ) : ?>
								<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $site ); ?>" style="max-height:48px; max-width:220px;">
							<?php else : ?>
								<span style="color:#ffffff; font-size:20px; font-weight:bold;"><?php echo esc_html( $site ); ?></span>
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

/**
 * Routes outgoing mail through Brevo's SMTP relay when enabled in
 * Theme Settings → Email delivery (Brevo). Left off, WordPress keeps
 * using its default PHP mail() transport.
 */
add_action(
	'phpmailer_init',
	function ( $phpmailer ) {
		if ( ! arbee_opt( 'brevo_enabled' ) ) {
			return;
		}
		$login = (string) arbee_opt( 'brevo_smtp_login' );
		$key   = (string) arbee_opt( 'brevo_smtp_key' );
		if ( '' === $login || '' === $key ) {
			return;
		}
		$host = arbee_has( arbee_opt( 'brevo_smtp_host' ) ) ? (string) arbee_opt( 'brevo_smtp_host' ) : 'smtp-relay.brevo.com';
		$port = arbee_has( arbee_opt( 'brevo_smtp_port' ) ) ? (int) arbee_opt( 'brevo_smtp_port' ) : 587;

		$phpmailer->isSMTP();
		$phpmailer->Host       = $host;
		$phpmailer->Port       = $port;
		$phpmailer->SMTPAuth   = true;
		$phpmailer->Username   = $login;
		$phpmailer->Password   = $key;
		$phpmailer->SMTPSecure = 465 === $port ? 'ssl' : 'tls';
	}
);
