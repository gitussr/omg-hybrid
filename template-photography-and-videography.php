<?php
/**
 * Template Name: Photography & Videography
 *
 * LAYOUT FAMILY B. Rebuilt on the omg-hybrid component set (was a legacy
 * ported template). Page content stays SCF-driven — this file reads the
 * fields and hands the bundle to template-parts/studio-media-layout.php.
 * The cyan Studio palette is applied via the svc-studio body class
 * (inc/services.php → omg_hybrid_studio_inner_templates()).
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();

/* ---------------------------------------------------------------------- *
 *  Hero — SCF `banner_section`
 * ---------------------------------------------------------------------- */
$banner = get_field( 'banner_section' ) ?: array();
$hero   = array(
	'variant'     => 'inner',
	'eyebrow'     => 'OMG Studio',
	'title'       => $banner['banner_title'] ?? get_the_title(),
	'description' => $banner['banner_subtitle'] ?? '',
	'slides'      => ! empty( $banner['banner_image']['url'] )
		? array( array( 'type' => 'image', 'url' => $banner['banner_image']['url'] ) )
		: array(),
);

/* ---------------------------------------------------------------------- *
 *  Photo / video cards — image/text rows, all text-left / image-right
 *  (legacy .private-party-section — no zigzag; anchor ids main-block-N
 *  kept — the Studio landing page and mega menu link to #main-block-0 /
 *  #main-block-2)
 * ---------------------------------------------------------------------- */
$categories = get_field( 'categories_section' ) ?: array();
$rows       = array();
foreach ( (array) ( $categories['cards'] ?? array() ) as $i => $card ) {
	$rows[] = array(
		'id'           => 'main-block-' . $i,
		'title'        => $card['title'] ?? '',
		'content_html' => $card['content'] ?? '',
		'image'        => $card['image']['url'] ?? '',
		'image_alt'    => $card['image']['alt'] ?? '',
	);
}

get_template_part( 'template-parts/studio-media-layout', null, array(
	'hero'       => $hero,
	'rows'       => $rows,
	'remarkable' => true,
	'other'      => omg_hybrid_page7_other_services(),
	'marquee'    => omg_hybrid_page7_marquee(),
) );

get_footer();
