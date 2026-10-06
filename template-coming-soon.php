<?php
/**
 * Template Name: Coming Soon
 *
 * Holding page for divisions / services that don't have their own page yet
 * (client 2026-09-24) — first used by the OMG Food & Beverage card in the
 * "Our Services" / "Other Services" sections. Built from the home page's
 * own components so it carries the same look: the shared hero, the gold +
 * cream svc-group palette (the `coming-soon` slug is listed in
 * omg_hybrid_group_page_slugs()) and the shared client logo grid.
 *
 * Copy is deliberately generic so the page can front any upcoming service.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$img = OMG_HYBRID_URI . '/assets/images/';

get_header();

get_template_part( 'template-parts/sections/hero', null, array(
	'variant'     => 'home',
	'title'       => 'Coming Soon',
	'description' => 'Something new is on its way from the OMG family. Stay tuned.',
	'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Free Quote' ),
	'slides'      => array(
		array( 'type' => 'image', 'url' => $img . 'omg-entertainment-new-banner-01.jpg' ),
	),
) );

// Intro section, shared with the OMG Food & Beverage page (task-019).
get_template_part( 'template-parts/sections/coming-soon' );

get_template_part( 'template-parts/sections/marquee', null, array(
	'title'          => 'THE BEST BRANDS CHOOSE THE BEST BRAND',
	// Keep the 4-row logo slider on phones too, not the one-row strip
	// (client task-016, 2026-10-05).
	'hide_on_mobile' => false,
) );

get_footer();
