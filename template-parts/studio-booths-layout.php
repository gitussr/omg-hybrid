<?php
/**
 * OMG Studio — "Our Booths" layout (LAYOUT FAMILY A).
 *
 * Shared layout for the booth page. Rebuilt on the omg-hybrid component
 * set; content stays SCF-driven (see template-our-booths.php, which reads
 * the fields and hands over this bundle). Cyan palette comes from the
 * svc-studio body class (inc/services.php) — no colour is set here.
 *
 * $args:
 *   hero      array  -> sections/hero            ('inner' variant)
 *   rows      array  -> sections/service-rows    (booth cards)
 *   showcase  bool   -> render sections/booth-showcase when truthy
 *   other     array{ heading?, description?, cards[] } -> sections/other-services
 *   marquee   array{ title?, logos[] }           -> sections/marquee
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

if ( ! empty( $args['showcase'] ) ) {
	get_template_part( 'template-parts/sections/booth-showcase' );
}

if ( ! empty( $args['other']['cards'] ) ) {
	get_template_part( 'template-parts/sections/other-services', null, $args['other'] );
}

if ( ! empty( $args['marquee']['logos'] ) ) {
	get_template_part( 'template-parts/sections/marquee', null, $args['marquee'] );
}
