<?php
/**
 * Template Name: OMG LiVE — Our Services
 *
 * /omg-live/our-services/ — the three OMG LiVE services as anchored rows.
 * Purple palette via the svc-live body class (inc/services.php ->
 * omg_hybrid_brand_inner_templates()). Content: inc/brand-services.php.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/brand-services-layout', null, omg_hybrid_brand_services( 'live' ) );

get_footer();
