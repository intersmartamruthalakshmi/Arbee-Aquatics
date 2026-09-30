<?php
/**
 * Template helpers: ACF access, safe text formatting, images and links.
 *
 * Every helper returns an empty string for empty input, so templates can
 * skip markup when an editor clears a field.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

/**
 * ACF-safe getter (returns null when ACF is inactive instead of fataling).
 */
function arbee_get( $name, $post_id = false ) {
	return function_exists( 'get_field' ) ? get_field( $name, $post_id ) : null;
}

function arbee_opt( $name ) {
	return arbee_get( $name, 'option' );
}

/**
 * Repeater rows as an array (never null).
 */
function arbee_rows( $name, $post_id = false ) {
	$rows = arbee_get( $name, $post_id );
	return is_array( $rows ) ? $rows : array();
}

/**
 * Value from a repeater row / group array.
 */
function arbee_v( $row, $key, $default = '' ) {
	return ( is_array( $row ) && isset( $row[ $key ] ) && null !== $row[ $key ] ) ? $row[ $key ] : $default;
}

function arbee_has( $value ) {
	if ( is_array( $value ) ) {
		return ! empty( $value );
	}
	return '' !== trim( (string) $value );
}

/**
 * Plain text, escaped.
 */
function arbee_text( $text ) {
	return esc_html( trim( (string) $text ) );
}

/**
 * Plain text, escaped, with editor line breaks converted to <br>.
 */
function arbee_lines( $text ) {
	return nl2br( esc_html( trim( (string) $text ) ), false );
}

/**
 * Inline HTML allowed in headings (e.g. <span>Green</span>), line breaks kept.
 */
function arbee_inline_tags() {
	return array(
		'br'     => array(),
		'span'   => array( 'class' => true ),
		'strong' => array(),
		'b'      => array(),
		'em'     => array(),
		'i'      => array(),
		'a'      => array(
			'href'   => true,
			'target' => true,
			'rel'    => true,
		),
	);
}

function arbee_inline( $text ) {
	return nl2br( wp_kses( trim( (string) $text ), arbee_inline_tags() ), false );
}

/**
 * Paragraph block: blank lines separate paragraphs, single line breaks become <br>.
 * Output mirrors the original markup: <p class="paraarbeespec">…</p>.
 */
function arbee_paras( $text, $class = 'paraarbeespec' ) {
	$text = trim( str_replace( "\r\n", "\n", (string) $text ) );
	if ( '' === $text ) {
		return '';
	}
	$out   = '';
	$class = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	foreach ( preg_split( "/\n\s*\n/", $text ) as $para ) {
		$out .= '<p' . $class . '>' . arbee_inline( $para ) . '</p>';
	}
	return $out;
}

/**
 * URL of a file shipped with the theme (decorative artwork, scripts, styles).
 */
function arbee_asset( $path ) {
	return ARBEE_URI . '/assets/' . ltrim( $path, '/' );
}

/**
 * <img> for a Media Library attachment.
 *
 * $attr can override width/height to match the original markup's layout hints.
 * The attachment's own alt text wins; $attr['alt'] is only a fallback.
 */
function arbee_image( $image, $attr = array() ) {
	$id = is_array( $image ) ? (int) arbee_v( $image, 'ID', arbee_v( $image, 'id', 0 ) ) : (int) $image;
	if ( ! $id ) {
		return '';
	}
	$src = wp_get_attachment_image_src( $id, 'full' );
	if ( ! $src ) {
		return '';
	}

	$media_alt = trim( (string) get_post_meta( $id, '_wp_attachment_image_alt', true ) );
	$atts      = array(
		'src'    => $src[0],
		'width'  => $src[1] ? $src[1] : null,
		'height' => $src[2] ? $src[2] : null,
	);
	$atts      = array_merge( $atts, $attr );
	$atts['alt'] = '' !== $media_alt ? $media_alt : arbee_v( $attr, 'alt', '' );

	$srcset = wp_get_attachment_image_srcset( $id, 'full' );
	if ( $srcset ) {
		$atts['srcset'] = $srcset;
		$atts['sizes']  = wp_get_attachment_image_sizes( $id, 'full' );
	}

	$html = '<img';
	foreach ( $atts as $name => $value ) {
		if ( null === $value || false === $value ) {
			continue;
		}
		$html .= ' ' . $name . '="' . ( 'src' === $name ? esc_url( $value ) : esc_attr( $value ) ) . '"';
	}
	return $html . '>';
}

/**
 * URL of a Media Library file (video etc.).
 */
function arbee_file_url( $file ) {
	$id = is_array( $file ) ? (int) arbee_v( $file, 'ID', arbee_v( $file, 'id', 0 ) ) : (int) $file;
	return $id ? (string) wp_get_attachment_url( $id ) : '';
}

/**
 * The special URL "#request-quote" opens the Request a Quote modal.
 */
function arbee_is_quote_url( $url ) {
	return '#request-quote' === substr( (string) $url, -strlen( '#request-quote' ) );
}

/**
 * href/target attributes for an ACF link array. Empty string when there is no URL,
 * so wrappers like <a class="prodBx"> render without a dead href.
 */
function arbee_link_attrs( $link ) {
	$url = trim( (string) arbee_v( $link, 'url' ) );
	if ( '' === $url ) {
		return '';
	}
	if ( arbee_is_quote_url( $url ) ) {
		return ' href="#request-quote" data-bs-toggle="modal" data-bs-target="#exampleModal"';
	}
	$out    = ' href="' . esc_url( $url ) . '"';
	$target = arbee_v( $link, 'target' );
	if ( $target ) {
		$out .= ' target="' . esc_attr( $target ) . '" rel="noopener"';
	}
	return $out;
}

/**
 * Button/link from an ACF link array. Returns '' if URL or label is missing,
 * so no empty buttons are ever printed.
 */
function arbee_link( $link, $class = '', $label = null ) {
	$title = null === $label ? (string) arbee_v( $link, 'title' ) : (string) $label;
	$attrs = arbee_link_attrs( $link );
	if ( '' === $attrs || '' === trim( $title ) ) {
		return '';
	}
	return '<a' . ( $class ? ' class="' . esc_attr( $class ) . '"' : '' ) . $attrs . '>' . esc_html( $title ) . '</a>';
}

/**
 * Two-digit counter used by numbered cards ("01", "02", …).
 */
function arbee_index( $i ) {
	return sprintf( '%02d', (int) $i + 1 );
}

/**
 * Render a template part with arguments.
 */
function arbee_part( $slug, $args = array() ) {
	get_template_part( 'template-parts/' . $slug, null, $args );
}
