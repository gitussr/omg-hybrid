<?php
/**
 * Template Name: OMG Props & Theming — Our Services
 *
 * /omg-props-theming/our-services/ — the five OMG Props & Theming services
 * as anchored rows. Yellow palette via the svc-props body class
 * (inc/services.php -> omg_hybrid_brand_inner_templates()).
 * Content: inc/brand-services.php.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/brand-services-layout', null, omg_hybrid_brand_services( 'props' ) );

get_footer();
