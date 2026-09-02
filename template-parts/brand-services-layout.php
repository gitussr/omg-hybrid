<?php
/**
 * Brand "Our Services" layout — Entertainment / LiVE / Props & Theming.
 *
 * Banner -> service rows (all text-left / image-right, #anchor per
 * service) -> the brand "Ready to…" CTA. Colour comes from the svc-*
 * body class set by inc/services.php; this file never names a colour.
 *
 * $args: the omg_hybrid_brand_services() bundle — { hero, rows, cta }.
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

if ( ! empty( $args['cta'] ) ) {
	get_template_part( 'template-parts/sections/cta', null, $args['cta'] );
}
