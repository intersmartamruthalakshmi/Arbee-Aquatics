<?php
/**
 * 404 page. The original compiled CSS already styles `.errorPage #Error`
 * (assets/sass/5-pages/_error.sass) and the `noBanner` body class; this template
 * provides the matching markup.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

get_header();

$arbee_title = arbee_opt( 'e404_title' );
$arbee_text  = arbee_opt( 'e404_text' );
?>
<div id="pageWrapper" class="errorPage">
	<section class="innerpagebgbanner privacybg">
		<div class="innerbgsecimg"><img src="<?php echo esc_url( arbee_asset( 'images/privacybg.jpg' ) ); ?>" alt=""></div>
	</section>
	<section id="Error" class="advantagesecbg">
		<div class="container">
			<div class="content">
				<?php if ( arbee_opt( 'e404_image' ) ) : ?>
					<div class="imgBx"><?php echo arbee_image( arbee_opt( 'e404_image' ), array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
				<?php endif; ?>
				<div class="txtWrapper">
					<h1 class="title"><?php echo arbee_text( arbee_has( $arbee_title ) ? $arbee_title : __( 'Page not found', 'arbee' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
					<?php if ( arbee_has( $arbee_text ) ) : ?>
						<div class="subT"><?php echo arbee_lines( $arbee_text ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<?php endif; ?>
				</div>
				<?php
				$arbee_btn = arbee_opt( 'e404_button' );
				echo arbee_has( arbee_v( $arbee_btn, 'url' ) ) ? arbee_link( $arbee_btn, 'expmorebth' ) : '<a class="expmorebth" href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Back to Home', 'arbee' ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput
				?>
			</div>
		</div>
	</section>
</div>
<?php
get_footer();
