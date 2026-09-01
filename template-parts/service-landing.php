<?php
/**
 * Generic service landing layout — OMG Studio / LiVE / Props & Theming.
 *
 * Renders the shared component set from a single data bundle. All colour
 * comes from the service body class (svc-*) set by inc/services.php, so
 * this file never references a service colour.
 *
 * $args:
 *   hero      array  -> template-parts/sections/hero
 *   welcome   array  -> template-parts/sections/welcome
 *   cards     array  -> template-parts/sections/service-cards cards[] (framed variant)
 *   rows      array  -> DORMANT. Reserved for a dedicated services page to
 *                       be designed later (instruction 2026-09-01). The
 *                       landing templates still pass the data so the copy /
 *                       images aren't lost; it is deliberately not rendered
 *                       here. Do not wire it back without new instruction.
 *   why       array{heading,bullets,body,buttons}
 *   cta       array{title,subtitle,buttons?}
 *   other     array  -> template-parts/sections/other-services cards[]
 *   marquee   array{title,logos}
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

if ( ! empty( $args['hero'] ) ) {
	get_template_part( 'template-parts/sections/hero', null, $args['hero'] );
}

if ( ! empty( $args['welcome'] ) ) {
	get_template_part( 'template-parts/sections/welcome', null, $args['welcome'] );
}

if ( ! empty( $args['cards'] ) ) {
	get_template_part( 'template-parts/sections/service-cards', null, array(
		'heading' => $args['cards_heading'] ?? 'Our Services',
		'intro'   => $args['cards_intro'] ?? '',
		'cards'   => $args['cards'],
		'variant' => 'framed',
	) );
}

/*
 * $args['rows'] — the alternating image/text "Our Services" detail rows —
 * is intentionally NOT rendered. That section moves to a dedicated services
 * page, to be designed later (instruction 2026-09-01).
 */

if ( ! empty( $args['why'] ) ) {
	get_template_part( 'template-parts/sections/why-choose', null, $args['why'] );
}

if ( ! empty( $args['testimonials'] ) ) {
	get_template_part( 'template-parts/sections/testimonials', null, $args['testimonials'] );
}

if ( ! empty( $args['other'] ) ) {
	get_template_part( 'template-parts/sections/other-services', null, array(
		'heading' => $args['other_heading'] ?? 'Explore The Rest Of The OMG Group',
		'cards'   => $args['other'],
	) );
}

if ( ! empty( $args['cta'] ) ) {
	get_template_part( 'template-parts/sections/cta', null, $args['cta'] );
}

if ( ! empty( $args['marquee'] ) ) {
	get_template_part( 'template-parts/sections/marquee', null, $args['marquee'] );
}
