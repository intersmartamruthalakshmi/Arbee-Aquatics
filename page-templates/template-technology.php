<?php
/**
 * Template Name: Technology & Process
 *
 * Converted from technology.php. The process diagram layout is fixed (each
 * node has a positional CSS class); its labels, icons and numbers are editable.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * One diagram node: <li class="…"><a><span><img></span><h3>…</h3><h4>…</h4><h6>NN</h6></a>[extra]</li>
 */
$arbee_node = function ( $name, $class = '', $extra = '' ) {
	$node = arbee_get( $name );
	if ( ! arbee_has( arbee_v( $node, 'title' ) ) ) {
		return '';
	}
	$html  = '<li' . ( $class ? ' class="' . esc_attr( $class ) . '"' : '' ) . '><a>';
	$html .= arbee_v( $node, 'icon' ) ? '<span>' . arbee_image( arbee_v( $node, 'icon' ), array( 'alt' => '' ) ) . '</span>' : '';
	$html .= '<h3>' . arbee_lines( arbee_v( $node, 'title' ) ) . '</h3>';
	$html .= arbee_has( arbee_v( $node, 'subtitle' ) ) ? '<h4>' . arbee_text( arbee_v( $node, 'subtitle' ) ) . '</h4>' : '';
	$html .= arbee_has( arbee_v( $node, 'number' ) ) ? '<h6>' . arbee_text( arbee_v( $node, 'number' ) ) . '</h6>' : '';
	$html .= '</a>' . $extra . '</li>';
	return $html;
};

$arbee_cooker = arbee_get( 'cooker' );
$arbee_popup  = '';
if ( arbee_has( arbee_v( $arbee_cooker, 'popup_title' ) ) || arbee_has( arbee_v( $arbee_cooker, 'popup_text' ) ) ) {
	$arbee_popup = '<div class="cookerbox"><h5>' . arbee_text( arbee_v( $arbee_cooker, 'popup_title' ) ) . '</h5><p>' . arbee_lines( arbee_v( $arbee_cooker, 'popup_text' ) ) . '</p></div>';
}
?>
<div id="pageWrapper" class="fishmealPage">

	<?php arbee_part( 'sections/page-banner' ); ?>

	<section class="advantagesecbg techprograpg">
		<div class="container">
			<div class="techleftbg">
				<?php if ( arbee_has( arbee_get( 'intro_title' ) ) ) : ?>
					<h1 class="headstylecom"><?php echo arbee_lines( arbee_get( 'intro_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
				<?php endif; ?>
			</div>
			<div class="techrightbg">
				<?php echo arbee_paras( arbee_get( 'intro_text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</div>
			<div class="oilprocessbx">
				<?php if ( arbee_has( arbee_get( 'process_title' ) ) ) : ?>
					<h2><?php echo arbee_lines( arbee_get( 'process_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
				<?php endif; ?>
				<?php // phpcs:disable WordPress.Security.EscapeOutput -- node HTML is escaped inside $arbee_node. ?>
				<ul class="techniclab">
					<?php echo $arbee_node( 'raw_fish', 'blubgsec' ); ?>
					<?php echo $arbee_node( 'metal_detector' ); ?>
					<?php echo $arbee_node( 'cooker', 'coopopfg', $arbee_popup ); ?>
				</ul>
				<div style="clear: both;"></div>
				<ul class="techniclab">
					<?php echo $arbee_node( 'press', 'pressmec' ); ?>
				</ul>
				<div style="clear: both;"></div>
				<div class="leftoilbox">
					<ul class="techniclab">
						<?php echo $arbee_node( 'press_liquid', 'liquibox' ); ?>
						<?php echo $arbee_node( 'decanter', 'decanbox' ); ?>
					</ul>
					<div style="clear: both;"></div>
					<ul class="techniclab">
						<?php echo $arbee_node( 'oil_separator', 'oilsepbox' ); ?>
						<?php echo $arbee_node( 'oil', 'oilboxgt' ); ?>
					</ul>
					<div style="clear: both;"></div>
					<ul class="techniclab">
						<li class="dummybox"><a></a></li>
						<?php echo $arbee_node( 'crude_oil', 'crudesepbox' ); ?>
					</ul>
				</div>
				<div class="rightoilbox">
					<ul class="techniclab">
						<?php echo $arbee_node( 'press_cake', 'cakebox' ); ?>
						<?php echo $arbee_node( 'dryer', 'dryerbox' ); ?>
					</ul>
					<div style="clear: both;"></div>
					<ul class="techniclab">
						<?php echo $arbee_node( 'hammer_mill', 'hammerbox' ); ?>
						<?php echo $arbee_node( 'cooler', 'coolerbox' ); ?>
					</ul>
					<div style="clear: both;"></div>
					<ul class="techniclab">
						<?php echo $arbee_node( 'siever', 'sieverbox' ); ?>
						<?php echo $arbee_node( 'fish_meal', 'fishboxgt' ); ?>
					</ul>
				</div>
				<?php // phpcs:enable ?>
				<div style="clear: both;"></div>
			</div>
			<div style="clear: both;"></div>
		</div>
	</section>

</div>
<?php
get_footer();
