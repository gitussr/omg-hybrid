<?php
/**
 * Shared OMG Entertainment layout.
 *
 * Rendered by BOTH:
 *   - front-page.php                  ($args['context'] = 'home')
 *   - template-omg-entertainment.php  ($args['context'] = 'landing')
 *
 * The two contexts render IDENTICALLY for the current phase (master brief
 * §3). The only planned future difference is the two sections directly
 * below the hero — kept here as their own, independently addressable
 * get_template_part() calls (template-parts/omg-entertainment/below-hero-*)
 * so later instructions can change their content / visibility / order
 * without duplicating the page. Do NOT invent the differences yet.
 *
 * Content is static (approved plan). Copy and media are drawn from the
 * existing OMG Entertainment site.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$context = ( $args['context'] ?? 'home' ) === 'landing' ? 'landing' : 'home';
$img     = OMG_HYBRID_URI . '/assets/images/';
$video   = OMG_HYBRID_URI . '/assets/hero.mp4';
$uploads = home_url( '/wp-content/uploads' );

$hero_slides = array(
	array( 'type' => 'video', 'url' => $video, 'poster' => $img . 'omg-entertainment-banner1.jpg' ),
	array( 'type' => 'image', 'url' => $img . 'omg-entertainment-banner1.jpg' ),
);

// Home page only: the client's new banner leads the slider (2026-09-14).
// The OMG Entertainment landing page keeps the original two slides.
if ( 'home' === $context ) {
	array_unshift( $hero_slides, array( 'type' => 'image', 'url' => $img . 'omg-entertainment-new-banner-01.jpg' ) );

	// Five more event photos appended after the existing slides
	// (client 2026-09-30, sourced from omggroup.com.au uploads).
	foreach ( array( '02', '03', '04', '05', '06' ) as $n ) {
		$hero_slides[] = array( 'type' => 'image', 'url' => $img . 'omg-home-banner-' . $n . '.jpg' );
	}
}

// Home page per-slide copy (client task-018, 2026-10-05). Slide numbers
// as the client counts them (01 = the new banner, which has no text):
//   02 video        "Play for Fun Casinos"
//   04 banner 02    "Where Every Game Tell a Story", no dark tint
//   05 banner 03    no hero text, no tint (client, same day)
//   06 banner 04    "Don't Just Hear the Music. Feel the Moment", no tint
//   08 banner 06    "Building Connections Not Just Campaigns"
// 03 and 07 keep the main title. The h1 is uppercased in CSS. Copy as
// supplied by the client.
if ( 'home' === $context && 8 === count( $hero_slides ) ) {
	$hero_slides[1]['title']   = 'Play for Fun<br>Casinos';
	$hero_slides[3]['title']   = 'Where Every Game<br>Tell a Story';
	$hero_slides[3]['overlay'] = false;
	$hero_slides[4]['text']    = false;
	$hero_slides[4]['overlay'] = false;
	$hero_slides[5]['title']   = 'Don&rsquo;t Just Hear the Music.<br>Feel the Moment';
	$hero_slides[5]['overlay'] = false;
	$hero_slides[7]['title']   = 'Building Connections<br>Not Just Campaigns';
}

get_template_part( 'template-parts/sections/hero', null, array(
	'variant'     => 'home',
	'title'       => 'Creating Unforgettable<br>Event Experiences',
	'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Free Quote' ),
	'slides'      => $hero_slides,
	// Home page: no title / button over the first slide (client 2026-10-01);
	// the text shows from slide 2 on. The landing page keeps it on every slide.
	'hide_text_on_first' => 'home' === $context,
) );

/* ==================================================================
 * MODULAR SECTION 1 — directly below the hero (home vs inner-landing
 * will eventually differ; identical for now).
 * ================================================================== */
get_template_part( 'template-parts/omg-entertainment/below-hero-1', null, array( 'context' => $context ) );

/* ==================================================================
 * MODULAR SECTION 2 — directly below the hero (home vs inner-landing
 * will eventually differ; identical for now).
 * ================================================================== */
get_template_part( 'template-parts/omg-entertainment/below-hero-2', null, array( 'context' => $context ) );


// "Other Services" runs on the /omg-entertainment/ landing page only —
// the home page (context 'home') omits it per client request.
if ( 'home' !== $context ) :
get_template_part( 'template-parts/sections/other-services', null, array(
	'heading'     => 'Other Services',
	'description' => 'Why stop at the tables? Complete the night with our full suite of event services: photo booths and photography, high-energy DJs and live music, props and theming, plus food, drinks and professional staff. It\'s everything your event needs, all under one roof.',
	'cards'       => array(
		array(
			'image'       => $img . 'omg-studio-display.jpg',
			'logo'        => $img . 'oos-logo-studio-lg.png',
			'title'       => 'OMG Studio',
			'description' => 'Photo booths, video booths, photography and videography &mdash; every moment of your event, captured.',
			'url'         => home_url( '/omg-studio/' ),
			'link_label'  => 'Visit OMG Studio',
		),
		array(
			'image'       => $img . 'omg-live-hero.jpg',
			'logo'        => $img . 'oos-logo-live-lg.png',
			'title'       => 'OMG LiVE',
			'description' => 'High-energy DJs, expert lighting and professional live music for an immersive, engaging event.',
			'url'         => home_url( '/omg-live/' ),
			'link_label'  => 'Visit OMG LiVE',
		),
		array(
			'image'       => $img . 'props-custom-new.jpg',
			'logo'        => $img . 'oos-logo-props-lg.png',
			'title'       => 'OMG Props &amp; Theming',
			'description' => 'Casino props, light-up letters and theme walls, plus table, chair and decoration hire.',
			'url'         => home_url( '/omg-props-theming/' ),
			'link_label'  => 'Visit OMG Props &amp; Theming',
		),
		array(
			'logo'        => $img . 'oos-logo-fnb-2026c.png',
			'title'       => 'OMG Food &amp; Beverage',
			'description' => 'Catering, mobile bars, bartenders &amp; mixologists, plus professional staff hire.',
			'url'         => home_url( '/coming-soon/' ),
			'link_label'  => 'Visit OMG Food &amp; Beverage',
		),
	),
) );
endif;

/* ---- Shared sections (identical in both contexts) ---- */

/*
 * The alternating image/text "Our Services" detail rows now live on
 * their own page — /omg-entertainment/our-services/ — built from
 * omg_hybrid_brand_services( 'entertainment' ) (inc/brand-services.php).
 * Nothing services-row is rendered on this landing page.
 */

get_template_part( 'template-parts/sections/why-choose', null, array(
	'heading' => 'Why Choose OMG Entertainment?',
	'bullets' => array(
		'Full-sized, Australian-made casino equipment',
		'Entertainment-skilled, experienced croupiers',
		'Transparent pricing, no hidden costs',
		'Fully customisable game &amp; performer selection',
		'Add-on props, DJ, photo booth &amp; performers',
		'Fully insured $20 million public liability cover',
	),
	'buttons' => array(
		array( 'url' => 'tel:1300300664', 'label' => 'Call Us' ),
		array( 'url' => home_url( '/contact/' ), 'label' => 'Book an Event' ),
		array( 'url' => 'mailto:info@OMGent.com.au', 'label' => 'Email Us' ),
	),
) );





get_template_part( 'template-parts/sections/marquee', null, array(
	'title'          => 'THE BEST BRANDS CHOOSE THE BEST BRAND',
	// Home and /omg-entertainment/ both keep the 4-row grid on phones
	// (client 2026-10-05; /omg-entertainment/ had the one-row strip from
	// 2026-10-01).
	'hide_on_mobile' => false,
	'logos'          => array(
		$uploads . '/2026/04/logo-1.jpg',  $uploads . '/2026/04/logo-2.jpg',  $uploads . '/2026/04/logo-3.jpg',
		$uploads . '/2026/04/logo-4.jpg',  $uploads . '/2026/04/logo-5.jpg',  $uploads . '/2026/04/logo-6.jpg',
		$uploads . '/2026/04/logo-7.jpg',  $uploads . '/2026/04/logo-8.jpg',  $uploads . '/2026/04/logo-9.jpg',
		$uploads . '/2026/04/logo-10.jpg', $uploads . '/2026/04/logo-11.jpg', $uploads . '/2026/04/logo-12.jpg',
		$uploads . '/2026/04/logo-13.jpg', $uploads . '/2026/04/logo-14.jpg', $uploads . '/2026/04/logo-15.jpg',
		$uploads . '/2026/04/logo-16.jpg', $uploads . '/2026/04/logo-17.jpg', $uploads . '/2026/04/logo-18.jpg',
		$uploads . '/2026/04/logo-19.jpg', $uploads . '/2026/04/logo-20.jpg', $uploads . '/2026/04/logo-21.jpg',
		$uploads . '/2026/04/logo-22.jpg',
	),
) );

// Testimonials sit below the brands logo grid (client 2026-09-19).
// Quotes live in template-parts/omg-entertainment/testimonials.php, shared
// with the casino / poker / horse racing pages (client task-009).
get_template_part( 'template-parts/omg-entertainment/testimonials' );

// CTA band — last section before the footer, below the logo grid and
// testimonials (client 2026-09-24; previously sat between "Why Choose"
// and the logo grid). Runs in both contexts: the home page omitted it
// from 2026-09-17 until the client asked for it back (2026-10-01). Its
// home colours are set in shell.css (body.home .oh-cta).
get_template_part( 'template-parts/sections/cta', null, array(
	'title'    => 'READY TO ROLL THE DICE?',
	'subtitle' => 'Your Five-Star Event is one call away. Get a free, no-obligation quote today and lock in your date before it\'s gone.',
) );
