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

// "Other Services" — full 5-division grid, same component/content as the
// home page (client 2026-09-29 — was a 4-card subset excluding LiVE).
get_template_part(
	'template-parts/brand-services-layout',
	null,
	array_merge(
		omg_hybrid_brand_services( 'live' ),
		array(
			'other' => array(
				'heading'     => 'Other Services',
				'description' => 'Why stop there? Take your event to the next level with our full suite of event services &mdash; from high-energy DJs and live music to booths, photography and full styling, all under one roof.',
			),
		)
	)
);

// Logo grid before the footer — matches the OMG Entertainment landing
// "Best Brands" block (client 2026-09-17).
$uploads = home_url( '/wp-content/uploads' );
get_template_part(
	'template-parts/sections/marquee',
	null,
	array(
		'title' => 'The Best BRANDS CHOOSE THE BEST BRAND',
		'logos' => array(
			$uploads . '/2026/04/logo-1.jpg',  $uploads . '/2026/04/logo-2.jpg',  $uploads . '/2026/04/logo-3.jpg',
			$uploads . '/2026/04/logo-4.jpg',  $uploads . '/2026/04/logo-5.jpg',  $uploads . '/2026/04/logo-6.jpg',
			$uploads . '/2026/04/logo-7.jpg',  $uploads . '/2026/04/logo-8.jpg',  $uploads . '/2026/04/logo-9.jpg',
			$uploads . '/2026/04/logo-10.jpg', $uploads . '/2026/04/logo-11.jpg', $uploads . '/2026/04/logo-12.jpg',
			$uploads . '/2026/04/logo-13.jpg', $uploads . '/2026/04/logo-14.jpg', $uploads . '/2026/04/logo-15.jpg',
			$uploads . '/2026/04/logo-16.jpg', $uploads . '/2026/04/logo-17.jpg', $uploads . '/2026/04/logo-18.jpg',
			$uploads . '/2026/04/logo-19.jpg', $uploads . '/2026/04/logo-20.jpg', $uploads . '/2026/04/logo-21.jpg',
			$uploads . '/2026/04/logo-22.jpg',
		),
	)
);

get_footer();
