<?php
/**
 * Template Name: OMG Entertainment Page
 *
 * The inner "Our Services → OMG Entertainment" landing page. Uses the same
 * shared layout as the home page (master brief §3) — identical for now,
 * with the two below-hero sections kept modular for future divergence.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/omg-entertainment-layout', null, array( 'context' => 'landing' ) );

get_footer();
