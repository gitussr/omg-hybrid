<?php
/**
 * Template Name: OMG Entertainment — Our Services
 *
 * /omg-entertainment/our-services/ — the six OMG Entertainment services
 * as anchored rows. Red palette via the svc-entertainment body class
 * (inc/services.php -> omg_hybrid_brand_inner_templates()).
 * Content: inc/brand-services.php.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/brand-services-layout', null, omg_hybrid_brand_services( 'entertainment' ) );

// Shared client-logo slider (client 2026-09-23), as on the sibling
// /omg-live/our-services/ and /omg-props-theming/our-services/ pages.
get_template_part( 'template-parts/sections/marquee', null, omg_hybrid_page7_marquee() );

get_footer();
