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

get_template_part( 'template-parts/sections/hero', null, array(
	'variant'     => 'home',
	'eyebrow'     => 'OMG Entertainment',
	'title'       => 'Creating Unforgettable Event Experiences Across Australia',
	'description' => 'Casino nights, race days, poker tables and showstopping performers &mdash; the entertainment that turns any event into the one people are still talking about.',
	'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Free Quote' ),
	'slides'      => array(
		array( 'type' => 'video', 'url' => $video, 'poster' => $img . 'omg-entertainment-banner1.jpg' ),
		array( 'type' => 'image', 'url' => $img . 'omg-entertainment-banner1.jpg' ),
	),
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
		'Transparent, what-you-see-is-what-you-get pricing',
		'Fully customisable game &amp; performer selection',
		'Add-on props, DJ, photo booth &amp; performers available',
		'Trusted across Sydney, Brisbane, Adelaide, Perth &amp; regional Australia',
	),
	'body'    => 'Let OMG Entertainment turn your next event into an unforgettable night.',
	'buttons' => array(
		array( 'url' => 'tel:1300300664', 'label' => 'Call Us' ),
		array( 'url' => home_url( '/contact/' ), 'label' => 'Book an Event' ),
		array( 'url' => 'mailto:info@OMGgroup.com.au', 'label' => 'Email Us' ),
	),
) );

get_template_part( 'template-parts/sections/testimonials', null, array(
	'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
	'items'       => array(
		array( 'quote' => 'We hired the OMG group for our corporate Christmas party and let me tell you &mdash; everyone had the best night!', 'cite' => '&mdash; Elisa Chinnabootr' ),
		array( 'quote' => 'Thank you for coming to my husband&rsquo;s 40th casino party. Pablo and the girls were fantastic and very entertaining, explaining everything to new punters. It was lots of fun and got everyone involved.', 'cite' => '&mdash; Jess S., Cobbitty NSW' ),
		array( 'quote' => 'I wish I could give 6 stars! Everyone had a great time and the party went off without a hitch. Our croupiers were friendly, knowledgeable and made sure even the inexperienced players had a great time.', 'cite' => '&mdash; Danielle G., Cabarita NSW' ),
		array( 'quote' => 'They were great to deal with all the way. We had the casino tables package for a bucks night and the boys had a great time &mdash; the staff were amazing on the night.', 'cite' => '&mdash; Veronica P., Leumeah NSW' ),
		array( 'quote' => 'We hired OMG group for our mid-year office party and their service and quality was excellent.', 'cite' => '&mdash; Aarti Mehra' ),
	),
) );

get_template_part( 'template-parts/sections/other-services', null, array(
	'heading'     => 'Other Services',
	'description' => 'Why stop there? Take your event to the next level with our full suite of event services &mdash; from high-energy DJs and live music to booths, photography and full styling, all under one roof.',
	'cards'       => array(
		array(
			'image'       => $img . 'omg-studio-display.jpg',
			'logo'        => $img . 'oos-logo-studio.jpg',
			'title'       => 'OMG Studio',
			'description' => 'Photo booths, video booths, photography and videography &mdash; every moment of your event, captured.',
			'url'         => home_url( '/omg-studio/' ),
			'link_label'  => 'Visit OMG Studio',
		),
		array(
			'image'       => $img . 'omg-live-hero.jpg',
			'logo'        => $img . 'oos-logo-2.png',
			'title'       => 'OMG LiVE',
			'description' => 'High-energy DJs, expert lighting and professional live music for an immersive, engaging event.',
			'url'         => home_url( '/omg-live/' ),
			'link_label'  => 'Visit OMG LiVE',
		),
		array(
			'image'       => $img . 'props-custom-new.jpg',
			'logo'        => $img . 'oos-logo-3.png',
			'title'       => 'OMG Props &amp; Theming',
			'description' => 'Casino props, light-up letters and theme walls, plus table, chair and decoration hire.',
			'url'         => home_url( '/omg-props-theming/' ),
			'link_label'  => 'Visit OMG Props &amp; Theming',
		),
	),
) );

get_template_part( 'template-parts/sections/cta', null, array(
	'title'    => 'Ready To Book Your Entertainment?',
	'subtitle' => 'From casino nights to legendary tribute performances &mdash; get in touch for a free, no-obligation quote.',
) );

get_template_part( 'template-parts/sections/marquee', null, array(
	'title' => 'The Best Brands Choose the Best Brand',
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
) );
