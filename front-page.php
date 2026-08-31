<?php
/**
 * Front page — the OMG Entertainment home page.
 *
 * Uses the shared OMG Entertainment layout in 'home' context. WordPress
 * picks this template up automatically for the static front page, so the
 * page's assigned template is not used here.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/omg-entertainment-layout', null, array( 'context' => 'home' ) );

get_footer();
