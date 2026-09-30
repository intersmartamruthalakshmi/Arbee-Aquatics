<?php
/**
 * Site footer — converted from includes/footer.php.
 * Scripts that were inline here now live in assets/js and are enqueued (inc/enqueue.php).
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

$arbee_certs     = arbee_opt( 'footer_certifications' );
$arbee_social    = arbee_opt( 'footer_social' );
$arbee_map       = arbee_opt( 'footer_map' );
$arbee_phone     = arbee_opt( 'hq_phone' );
$arbee_email     = arbee_opt( 'hq_email' );
$arbee_copyright = arbee_opt( 'copyright' );
$arbee_credit    = arbee_opt( 'credit' );
$arbee_certs     = is_array( $arbee_certs ) ? $arbee_certs : array();
$arbee_social    = is_array( $arbee_social ) ? $arbee_social : array();
?>
<footer>
	<div class="respcontainer">
		<div class="footerlogosec">
			<?php if ( arbee_opt( 'footer_logo' ) ) : ?>
				<div class="logofoterhg"><?php echo arbee_image( arbee_opt( 'footer_logo' ), array( 'alt' => 'logo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
			<?php endif; ?>
			<?php if ( arbee_has( arbee_opt( 'footer_about' ) ) ) : ?>
				<p><?php echo arbee_lines( arbee_opt( 'footer_about' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
			<?php endif; ?>
		</div>
		<div class="footermenuhopk">
			<?php if ( arbee_has( arbee_opt( 'footer_company_title' ) ) ) : ?>
				<h2><?php echo arbee_text( arbee_opt( 'footer_company_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
			<?php endif; ?>
			<?php arbee_footer_menu( 'footer_company', 'foterdragmenu' ); ?>
		</div>
		<div class="footermenuhopk">
			<?php if ( arbee_has( arbee_opt( 'footer_products_title' ) ) ) : ?>
				<h2><?php echo arbee_text( arbee_opt( 'footer_products_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
			<?php endif; ?>
			<?php arbee_footer_menu( 'footer_products', 'foterdragmenu' ); ?>
			<?php if ( arbee_has( arbee_v( $arbee_map, 'label' ) ) && arbee_has( arbee_v( $arbee_map, 'url' ) ) ) : ?>
				<a href="<?php echo esc_url( arbee_v( $arbee_map, 'url' ) ); ?>" class="foterrehtbtn" target="_blank" rel="noopener">
					<?php if ( arbee_v( $arbee_map, 'icon' ) ) : ?>
						<span><?php echo arbee_image( arbee_v( $arbee_map, 'icon' ), array( 'alt' => 'map' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<?php endif; ?>
					<?php echo arbee_text( arbee_v( $arbee_map, 'label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</a>
			<?php endif; ?>
		</div>
		<div class="headquatbogt">
			<div class="ropboxtokhap">
				<?php if ( arbee_has( arbee_opt( 'hq_title' ) ) ) : ?>
					<h2><?php echo arbee_text( arbee_opt( 'hq_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
				<?php endif; ?>
				<?php if ( arbee_has( arbee_opt( 'hq_address' ) ) ) : ?>
					<p><?php echo arbee_lines( arbee_opt( 'hq_address' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
				<?php endif; ?>
				<?php if ( arbee_has( arbee_v( $arbee_phone, 'label' ) ) ) : ?>
					<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', (string) arbee_v( $arbee_phone, 'number', arbee_v( $arbee_phone, 'label' ) ) ) ); ?>" class="mailbprot">
						<?php if ( arbee_v( $arbee_phone, 'icon' ) ) : ?>
							<span><?php echo arbee_image( arbee_v( $arbee_phone, 'icon' ), array( 'alt' => 'icon' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<?php endif; ?>
						<?php echo arbee_text( arbee_v( $arbee_phone, 'label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</a> <br>
				<?php endif; ?>
				<?php if ( is_email( arbee_v( $arbee_email, 'address' ) ) ) : ?>
					<a href="<?php echo esc_url( 'mailto:' . antispambot( arbee_v( $arbee_email, 'address' ) ) ); ?>" class="mailbprot">
						<?php if ( arbee_v( $arbee_email, 'icon' ) ) : ?>
							<span><?php echo arbee_image( arbee_v( $arbee_email, 'icon' ), array( 'alt' => 'icon' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<?php endif; ?>
						<?php echo esc_html( antispambot( arbee_v( $arbee_email, 'address' ) ) ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<?php if ( $arbee_certs || $arbee_social ) : ?>
			<div class="bgclrlogofog">
				<?php
				$arbee_last = count( $arbee_certs ) - 1;
				foreach ( $arbee_certs as $arbee_i => $arbee_cert ) :
					if ( ! arbee_v( $arbee_cert, 'logo' ) ) {
						continue;
					}
					$arbee_url = arbee_v( $arbee_cert, 'url' );
					?>
					<div class="<?php echo $arbee_i === $arbee_last ? 'goallastpck' : 'goalgoptak'; ?>"><a<?php echo $arbee_url ? ' href="' . esc_url( $arbee_url ) . '" target="_blank" rel="noopener"' : ''; ?>><?php echo arbee_image( arbee_v( $arbee_cert, 'logo' ), array( 'alt' => 'logo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></div>
				<?php endforeach; ?>
				<?php if ( $arbee_social ) : ?>
					<ul class="socialcapork">
						<?php
						foreach ( $arbee_social as $arbee_s ) :
							if ( ! arbee_v( $arbee_s, 'icon' ) ) {
								continue;
							}
							$arbee_url = arbee_v( $arbee_s, 'url' );
							?>
							<li><a<?php echo $arbee_url ? ' href="' . esc_url( $arbee_url ) . '" target="_blank" rel="noopener"' : ''; ?><?php echo arbee_has( arbee_v( $arbee_s, 'label' ) ) ? ' aria-label="' . esc_attr( arbee_v( $arbee_s, 'label' ) ) . '"' : ''; ?>><?php echo arbee_image( arbee_v( $arbee_s, 'icon' ), array( 'alt' => arbee_v( $arbee_s, 'label', 'social-icon' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ( arbee_has( arbee_v( $arbee_copyright, 'company' ) ) || arbee_has( arbee_v( $arbee_copyright, 'suffix' ) ) ) : ?>
			<div class="copygotsec">© <?php echo esc_html( wp_date( 'Y' ) ); ?>
				<?php if ( arbee_has( arbee_v( $arbee_copyright, 'company' ) ) ) : ?>
					<a<?php echo arbee_v( $arbee_copyright, 'url' ) ? ' href="' . esc_url( arbee_v( $arbee_copyright, 'url' ) ) . '"' : ''; ?>><?php echo arbee_text( arbee_v( $arbee_copyright, 'company' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>.
				<?php endif; ?>
				<?php echo arbee_text( arbee_v( $arbee_copyright, 'suffix' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
		<?php endif; ?>
		<?php if ( has_nav_menu( 'footer_legal' ) ) : ?>
			<div class="privacytoc">
				<?php arbee_footer_menu( 'footer_legal' ); ?>
			</div>
		<?php endif; ?>
		<?php if ( arbee_has( arbee_v( $arbee_credit, 'name' ) ) ) : ?>
			<div class="intersop"><?php echo arbee_text( arbee_v( $arbee_credit, 'prefix' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<?php echo arbee_image( arbee_v( $arbee_credit, 'logo' ), array( 'alt' => 'logo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<a<?php echo arbee_v( $arbee_credit, 'url' ) ? ' href="' . esc_url( arbee_v( $arbee_credit, 'url' ) ) . '" target="_blank" rel="noopener"' : ''; ?>><?php echo arbee_text( arbee_v( $arbee_credit, 'name' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a> </div>
		<?php endif; ?>
		<div style="clear: both;"></div>
	</div>
</footer>

<?php if ( arbee_has( arbee_opt( 'floating_quote_label' ) ) ) : ?>
	<button type="button" class="quote-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
		<div class="txt"><?php echo arbee_text( arbee_opt( 'floating_quote_label' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
	</button>
<?php endif; ?>

<?php
$arbee_float_phone = preg_replace( '/[^0-9+]/', '', (string) arbee_opt( 'floating_phone' ) );
$arbee_float_email = arbee_opt( 'floating_email' );
if ( $arbee_float_phone || is_email( $arbee_float_email ) ) :
	?>
	<ul id="fixedRgt">
		<?php if ( $arbee_float_phone ) : ?>
			<li class="call">
				<a href="<?php echo esc_url( 'tel:' . $arbee_float_phone ); ?>" aria-label="<?php esc_attr_e( 'Call us', 'arbee' ); ?>">
					<img alt="Call" class="lazy" width="40" height="40" src="<?php echo esc_url( arbee_asset( 'images/icon-call.svg' ) ); ?>">
				</a>
			</li>
		<?php endif; ?>
		<?php if ( is_email( $arbee_float_email ) ) : ?>
			<li class="mail">
				<a href="<?php echo esc_url( 'mailto:' . antispambot( $arbee_float_email ) ); ?>" aria-label="<?php esc_attr_e( 'Email us', 'arbee' ); ?>">
					<img alt="Mail" class="lazy" width="40" height="40" src="<?php echo esc_url( arbee_asset( 'images/icon-mail.svg' ) ); ?>">
				</a>
			</li>
		<?php endif; ?>
	</ul>
<?php endif; ?>

<?php arbee_part( 'footer/quote-modal' ); ?>

<?php wp_footer(); ?>
</body>

</html>
