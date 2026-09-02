<?php
/**
 * Template Name: Our Booths Page
 *
 * LAYOUT FAMILY A. Rebuilt on the omg-hybrid component set (was a legacy
 * ported template). Content stays SCF-driven — this file only reads the
 * fields and hands the bundle to template-parts/studio-booths-layout.php.
 * The cyan Studio palette is applied via the svc-studio body class
 * (inc/services.php → omg_hybrid_studio_inner_templates()).
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();

/* ---------------------------------------------------------------------- *
 *  Hero — the SCF slider. The legacy inner hero printed the first
 *  slide's title/description over the image; the hero component keeps a
 *  single fixed overlay, so we take slide 0's copy.
 * ---------------------------------------------------------------------- */
$hero_sliders = get_field( 'hero_sliders' ) ?: array();
$hero_first   = $hero_sliders[0] ?? array();
$hero_slides  = array();
foreach ( $hero_sliders as $slide ) {
	if ( ! empty( $slide['image']['url'] ) ) {
		$hero_slides[] = array( 'type' => 'image', 'url' => $slide['image']['url'] );
	}
}

$hero = array(
	'variant'     => 'inner',
	'eyebrow'     => 'OMG Studio',
	'title'       => $hero_first['title'] ?? get_the_title(),
	'description' => $hero_first['description'] ?? '',
	'slides'      => $hero_slides,
);

/* ---------------------------------------------------------------------- *
 *  Booth cards — image/text rows, all text-left / image-right
 *  (legacy .private-party-section — no zigzag)
 * ---------------------------------------------------------------------- */
$categories = get_field( 'categories_section' ) ?: array();
$rows       = array();
foreach ( (array) ( $categories['cards'] ?? array() ) as $i => $card ) {
	$rows[] = array(
		'id'           => 'booth-' . $i,
		'title'        => $card['title'] ?? '',
		'content_html' => $card['content'] ?? '',
		'image'        => $card['image']['url'] ?? '',
		'image_alt'    => $card['image']['alt'] ?? '',
	);
}

get_template_part( 'template-parts/studio-booths-layout', null, array(
	'hero'     => $hero,
	'rows'     => $rows,
	'showcase' => true,
	'other'    => omg_hybrid_page7_other_services(),
	'marquee'  => omg_hybrid_page7_marquee(),
) );

get_footer();
