<?php
/**
 * Secure Custom Fields options page.
 *
 * Re-registers the "Theme Settings" options page (same menu slug as the
 * previous theme) so the existing field data keeps rendering:
 *   - contact_details  (phone, email, whatsapp, facebook, instagram)
 *   - header_stars     (rating shown in the header top bar)
 *   - footer_title
 *   - cta_buttons      (footer CTA repeater)
 *
 * Per the approved Phase 1 plan, the shared header/footer reuse these
 * already-populated fields. New landing-page body content is static.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

add_action( 'acf/init', 'omg_hybrid_register_options_page' );
function omg_hybrid_register_options_page() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page( array(
		'page_title'      => __( 'Theme General Settings', 'omg-hybrid' ),
		'menu_title'      => __( 'Theme Settings', 'omg-hybrid' ),
		'menu_slug'       => 'theme-general-settings',
		'capability'      => 'edit_posts',
		'icon_url'        => 'dashicons-superhero',
		'position'        => '2.5',
		'redirect'        => false,
		'update_button'   => __( 'Update', 'omg-hybrid' ),
		'updated_message' => __( 'Options Updated', 'omg-hybrid' ),
	) );
}

/**
 * Convenience accessor for the contact details group, always returning an
 * array so callers can use $details['phone_number'] without notices.
 */
function omg_hybrid_contact_details() {
	$details = omg_hybrid_option( 'contact_details' );
	return is_array( $details ) ? $details : array();
}
