<?php
/**
 * Template Name: OMG Studio Page
 *
 * Static content drawn from the existing OMG Studio site (its content is
 * SCF-driven there; kept static here per the approved plan). Reuses the
 * shared component set — teal palette applied via the svc-studio body
 * class (inc/services.php).
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();

// Content lives in omg_hybrid_studio_landing_args() (inc/brand-services.php),
// shared with /booth-sales/.
get_template_part( 'template-parts/service-landing', null, omg_hybrid_studio_landing_args() );

get_footer();
