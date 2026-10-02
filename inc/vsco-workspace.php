<?php
/**
 * VSCO Workspace CRM — assembles the "Message"/notes payload for the
 * Contact Page Form (form id 1) before the VSCO Workspace Gravity Forms
 * add-on reads the entry. VSCO's create-lead API has no Address/Company
 * field and no per-category notes, so this flattens the 5 service
 * checkbox groups + inquiry type + address + company + the existing
 * Message field into one hidden field, which the VSCO feed then maps to
 * its "Message" field.
 *
 * Requires a Hidden field on the form with Admin Label "vsco_notes".
 * A second Hidden field with Admin Label "vsco_source" and Default
 * Value "Website" (set in wp-admin, no code needed) feeds VSCO's Source.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'gform_pre_submission_1', 'omg_vsco_build_notes' );

function omg_vsco_build_notes( $form ) {
	$notes_field_id = omg_vsco_find_field_id_by_admin_label( $form, 'vsco_notes' );
	if ( ! $notes_field_id ) {
		return $form;
	}

	$checkbox_groups = array(
		72 => 'OMG Entertainment',
		66 => 'OMG Studio',
		79 => 'OMG Live',
		81 => 'OMG Props & Theming',
		83 => 'OMG Food & Beverage',
	);

	$parts = array();

	foreach ( $checkbox_groups as $field_id => $heading ) {
		$field = GFAPI::get_field( $form, $field_id );
		if ( ! $field || empty( $field->inputs ) ) {
			continue;
		}

		$picked = array();
		foreach ( $field->inputs as $input ) {
			$value = rgpost( 'input_' . str_replace( '.', '_', $input['id'] ) );
			if ( $value !== '' && $value !== null ) {
				$picked[] = $value;
			}
		}

		if ( $picked ) {
			$parts[] = '**' . $heading . '**: ' . implode( ', ', $picked );
		}
	}

	$inquiry_type = rgpost( 'input_52' );
	if ( $inquiry_type && $inquiry_type !== 'Choose a type' ) {
		$parts[] = '**Inquiry Type**: ' . $inquiry_type;
	}

	$address_bits = array_filter( array(
		rgpost( 'input_69' ), // Event Address
		rgpost( 'input_70' ), // Suburb
		rgpost( 'input_57' ), // State
		rgpost( 'input_71' ), // Postal Code
	) );
	if ( $address_bits ) {
		$parts[] = '**Event Address**: ' . implode( ', ', $address_bits );
	}

	$company = rgpost( 'input_59' );
	if ( $company ) {
		$parts[] = '**Company**: ' . $company;
	}

	$message = rgpost( 'input_11' );
	if ( $message ) {
		$parts[] = '**Message**: ' . $message;
	}

	$notes = mb_substr( implode( "\n\n", $parts ), 0, 2000 );

	$_POST[ 'input_' . $notes_field_id ] = $notes;

	return $form;
}

function omg_vsco_find_field_id_by_admin_label( $form, $admin_label ) {
	foreach ( $form['fields'] as $field ) {
		if ( isset( $field->adminLabel ) && $field->adminLabel === $admin_label ) {
			return $field->id;
		}
	}
	return null;
}
