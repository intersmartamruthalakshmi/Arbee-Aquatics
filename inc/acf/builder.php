<?php
/**
 * Compact helpers for registering ACF Pro field groups in PHP.
 *
 * Field keys are generated deterministically as field_<group>_<name>[_<sub>…]
 * so the content importer can target them, and so the field groups live
 * in version control with the theme.
 *
 * @package Arbee
 */

defined( 'ABSPATH' ) || exit;

function arbee_f( $type, $name, $label, $extra = array() ) {
	return array_merge(
		array(
			'type'  => $type,
			'name'  => $name,
			'label' => $label,
		),
		$extra
	);
}

function arbee_f_text( $name, $label, $extra = array() ) {
	return arbee_f( 'text', $name, $label, $extra );
}

/**
 * Multi-line text. new_lines is left empty: templates format it (paragraphs / <br>).
 */
function arbee_f_textarea( $name, $label, $rows = 3, $extra = array() ) {
	return arbee_f(
		'textarea',
		$name,
		$label,
		array_merge(
			array(
				'rows'      => $rows,
				'new_lines' => '',
			),
			$extra
		)
	);
}

function arbee_f_paras( $name, $label, $extra = array() ) {
	return arbee_f_textarea( $name, $label, 6, array_merge( array( 'instructions' => __( 'Leave an empty line between paragraphs.', 'arbee' ) ), $extra ) );
}

function arbee_f_heading( $name, $label, $extra = array() ) {
	return arbee_f_textarea( $name, $label, 2, array_merge( array( 'instructions' => __( 'Press Enter for a line break.', 'arbee' ) ), $extra ) );
}

function arbee_f_image( $name, $label, $extra = array() ) {
	return arbee_f(
		'image',
		$name,
		$label,
		array_merge(
			array(
				'return_format' => 'id',
				'preview_size'  => 'thumbnail',
				'library'       => 'all',
			),
			$extra
		)
	);
}

function arbee_f_video( $name, $label, $extra = array() ) {
	return arbee_f(
		'file',
		$name,
		$label,
		array_merge(
			array(
				'return_format' => 'id',
				'library'       => 'all',
				'mime_types'    => 'mp4,webm',
			),
			$extra
		)
	);
}

function arbee_f_link( $name, $label, $extra = array() ) {
	return arbee_f(
		'link',
		$name,
		$label,
		array_merge(
			array(
				'return_format' => 'array',
				'instructions'  => __( 'Use the URL #request-quote to open the Request a Quote popup.', 'arbee' ),
			),
			$extra
		)
	);
}

function arbee_f_repeater( $name, $label, $sub_fields, $extra = array() ) {
	return arbee_f(
		'repeater',
		$name,
		$label,
		array_merge(
			array(
				'layout'       => 'block',
				'button_label' => __( 'Add item', 'arbee' ),
				'sub_fields'   => $sub_fields,
			),
			$extra
		)
	);
}

function arbee_f_group( $name, $label, $sub_fields, $extra = array() ) {
	return arbee_f(
		'group',
		$name,
		$label,
		array_merge(
			array(
				'layout'     => 'block',
				'sub_fields' => $sub_fields,
			),
			$extra
		)
	);
}

function arbee_f_tab( $label ) {
	return array(
		'type'      => 'tab',
		'name'      => '',
		'label'     => $label,
		'placement' => 'top',
	);
}

/**
 * Assign keys recursively.
 *
 * Top level:  field_<group>_<name>
 * Sub fields: <parent key>__<name>  — the double underscore keeps a sub field
 * (e.g. repeater "uses" → "title") from colliding with a top-level field
 * whose name happens to be "uses_title".
 */
function arbee_acf_keys( $fields, $prefix, $sep = '_' ) {
	foreach ( $fields as $i => $field ) {
		$slug                = '' !== $field['name'] ? $field['name'] : 'tab_' . sanitize_title( $field['label'] ) . '_' . $i;
		$fields[ $i ]['key'] = $prefix . $sep . $slug;
		if ( ! empty( $field['sub_fields'] ) ) {
			$fields[ $i ]['sub_fields'] = arbee_acf_keys( $field['sub_fields'], $fields[ $i ]['key'], '__' );
		}
		if ( ! empty( $field['conditional_logic'] ) ) {
			foreach ( $fields[ $i ]['conditional_logic'] as $g => $rules ) {
				foreach ( $rules as $r => $rule ) {
					$fields[ $i ]['conditional_logic'][ $g ][ $r ]['field'] = $prefix . $sep . $rule['field'];
				}
			}
		}
	}
	return $fields;
}

/**
 * Register a group. $id becomes group_<id> and prefixes field keys as field_<id>.
 */
function arbee_acf_group( $id, $title, $fields, $location, $extra = array() ) {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	acf_add_local_field_group(
		array_merge(
			array(
				'key'                   => 'group_' . $id,
				'title'                 => $title,
				'fields'                => arbee_acf_keys( $fields, 'field_' . $id ),
				'location'              => $location,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'active'                => true,
			),
			$extra
		)
	);
}

/**
 * Location rule: page uses the given template.
 */
function arbee_loc_template( $template ) {
	return array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => $template,
			),
		),
	);
}

function arbee_loc_front_page() {
	return array(
		array(
			array(
				'param'    => 'page_type',
				'operator' => '==',
				'value'    => 'front_page',
			),
		),
	);
}

/**
 * The field key for a top-level field of a group (used by the importer).
 */
function arbee_field_key( $group_id, $name ) {
	return 'field_' . $group_id . '_' . $name;
}
