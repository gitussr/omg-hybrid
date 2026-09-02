<?php
/**
 * OMG Studio — Photography / Videography layout (LAYOUT FAMILY B).
 *
 * Shared layout for the Photography & Videography page. Rebuilt on the
 * omg-hybrid component set; the page content stays SCF-driven (see
 * template-photography-and-videography.php, which reads the fields). The
 * "Remarkable Results" band is fixed content and lives in its section
 * part. Cyan palette comes from the svc-studio body class.
 *
 * $args:
 *   hero        array  -> sections/hero          ('inner' variant)
 *   rows        array  -> sections/service-rows  (the photo / video cards)
 *   remarkable  bool   -> render sections/studio-remarkable when truthy
 *   other       array{ heading?, description?, cards[] } -> sections/other-services
 *   marquee     array{ title?, logos[] }         -> sections/marquee
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

if ( ! empty( $args['hero'] ) ) {
	get_template_part( 'template-parts/sections/hero', null, $args['hero'] );
}

if ( ! empty( $args['rows'] ) ) {
	get_template_part( 'template-parts/sections/service-rows', null, array(
		'rows' => $args['rows'],
	) );
}

if ( ! empty( $args['remarkable'] ) ) {
	get_template_part( 'template-parts/sections/studio-remarkable' );
}

if ( ! empty( $args['other']['cards'] ) ) {
	get_template_part( 'template-parts/sections/other-services', null, $args['other'] );
}

if ( ! empty( $args['marquee']['logos'] ) ) {
	get_template_part( 'template-parts/sections/marquee', null, $args['marquee'] );
}
