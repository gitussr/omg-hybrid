<?php
/**
 * Template Name: OMG Live Page
 *
 * Static content, rebuilt on the shared components from the existing
 * OMG LiVE material (the old Bootstrap site is a content reference only —
 * none of its markup or CSS is carried over). Purple palette via the
 * svc-live body class (inc/services.php).
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();

$img     = OMG_HYBRID_URI . '/assets/images/';
$uploads = home_url( '/wp-content/uploads' );

get_template_part( 'template-parts/service-landing', null, array(
	'hero' => array(
		'variant'     => 'home',
		'eyebrow'     => 'OMG LiVE',
		'title'       => 'Read The Room. Keep It Moving.',
		'description' => 'Elite DJs, atmospheric lighting and unforgettable live bands &mdash; club-standard sound and production that reads the room and keeps it moving.',
		'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Check Availability' ),
		'slides'      => array(
			array( 'type' => 'image', 'url' => $img . 'omg-live-hero.jpg' ),
			array( 'type' => 'image', 'url' => $img . 'welcome-live.jpg' ),
			array( 'type' => 'image', 'url' => $img . 'dj-custom-new.jpg' ),
		),
	),
	'welcome' => array(
		'heading'     => 'Welcome to',
		'heading_logo' => array( 'url' => $img . 'oos-logo-live-lg.png', 'alt' => 'OMG LiVE' ),
		'paragraphs'  => array(
			'Lights up. Bass drops. Everyone&rsquo;s dancing. That&rsquo;s an OMG Live Party.',
			'Our DJs roll in with a full DJ-Booth and a Light Show that turns any room into a club. Want the crowd singing? Grab the mic with Karaoke or queue the hits on our Jukebox. Then bring on the showstoppers: Dazzling Showgirls, Live Bands, jaw-dropping Magicians, Elvis and Michael Jackson Impersonators, and Paparazzi who treat every guest like a Celebrity.',
			'Corporate Function, Charity Gala or Birthday bash, we bring the DJ hire, Lighting and Live Entertainment that keep the party going all night long.',
		),
		// DORMANT (client 2026-09-28): the .oh-welcome__points list is hidden.
		// welcome.php only reads 'bullets' - rename this key back to show it.
		'bullets_dormant' => array(
			array( 'label' => 'Vetted Entertainers', 'text' => 'We only work with professional artists who have a proven ability to read a room, command a stage, and set the perfect vibe.' ),
			array( 'label' => 'All-In-One DJ Solutions', 'text' => 'Our DJs come fully equipped with high-end sound and lighting, offering a seamless, &ldquo;plug-and-play&rdquo; experience for any venue.' ),
			array( 'label' => 'Atmospheric Lighting', 'text' => 'We provide professional LED lighting hire&mdash;including wireless uplights and PAR cans&mdash;designed to transform your space with ease.' ),
			array( 'label' => 'The OMG Standard', 'text' => 'As part of Australia&rsquo;s leading entertainment group, we guarantee 5-star service and reliability from the first inquiry to the final song.' ),
		),
		'buttons'     => omg_hybrid_cta_buttons(),
		'image'       => $img . 'welcome-live.jpg',
		'image_alt'   => 'OMG LiVE DJ setup with professional sound and stage lighting',
		'image_style' => 'photo',
	),
	'cards_heading' => 'Our Products',
	'cards_intro' => '<strong>Your Party, Your Playlist, Your Stars</strong>. Explore our lineup below and get ready for packed dance floors, jaw-dropping light shows and entertainment nobody will forget',
	'cards' => array(
		array(
			'icon'        => $img . 'live-svc-dj.png',
			'title'       => 'DJs, DJ-Booths &amp; Lighting',
			'description' => 'Pumping Beats, a sleek DJ-Booth and Dazzling Lights that turn any venue into the hottest dance floor in town.',
			'url'         => home_url( '/omg-live/our-services/#djs-dj-booth' ),
			'link_label'  => 'VISIT US',
		),
		// live-svc-karaoke.png drawn 2026-09-28 to match the set (512px,
		// #9D5BBE, 30px round stroke). Our Services has no karaoke section
		// yet, so this card links to the page top.
		array(
			'icon'        => $img . 'live-svc-karaoke.png',
			'title'       => 'Karaoke &amp; Jukebox',
			'description' => 'Grab the Mic or pick the next Hit. Our Karaoke and Jukebox hire turns every guest into a Superstar.',
			'url'         => home_url( '/omg-live/our-services/' ),
			'link_label'  => 'VISIT US',
		),
		array(
			'icon'        => $img . 'live-svc-bands.png',
			'title'       => 'Entertainers &amp; Performers',
			'description' => 'Showgirls, Live Bands, Magicians, Elvis and Michael Jackson Impersonators, and Paparazzi who make every guest feel like a Celebrity',
			'url'         => home_url( '/omg-live/our-services/#live-bands' ),
			'link_label'  => 'VISIT US',
		),
	),
	// The service detail rows are shared with /omg-live/our-services/ and
	// live in inc/brand-services.php. Not rendered here (service-landing.php
	// skips 'rows' — dormant since 2026-09-01), passed so the data model
	// stays in one place.
	'rows' => omg_hybrid_brand_services( 'live' )['rows'],
	'why' => array(
		'heading' => 'Why Choose OMG LiVE?',
		'bullets' => array(
			'Handpicked DJs, bands and performers',
			'DJs arrive with full sound and lighting',
			'Wireless uplights and LED lighting hire',
			'Mix and match acts to suit your crowd',
			'Transparent pricing, no hidden costs',
			'$20 million public liability cover',
		),
		'body'    => 'Let OMG LiVE get your room moving.',
		'buttons' => array(
			array( 'url' => 'tel:1300300664', 'label' => 'Call Us' ),
			array( 'url' => home_url( '/contact/' ), 'label' => 'Book an Event' ),
			array( 'url' => 'mailto:info@OMGent.com.au', 'label' => 'Email Us' ),
		),
	),
	// Quotes shared with /omg-live/our-services/ (inc/brand-services.php).
	'testimonials' => omg_hybrid_brand_testimonials( 'live' ),
	'other_heading' => 'Other Services',
	'other_description' => 'Why stop at the Dance Floor? Complete the night with the full OMG Experience: Casino Tables, Race Nights and Poker Tournaments, Photo-Booths and Photography, Props and Theming, plus Food, Drinks and Professional Staff. It&rsquo;s everything your event needs, all under one roof.',
	'other' => array(
		array( 'image' => $img . 'omg-entertainment-banner1.jpg', 'logo' => $img . 'oos-logo-entertainment-lg.png', 'title' => 'OMG Entertainment', 'description' => 'Casino nights, race days, poker &amp; showstopping performers.', 'url' => home_url( '/omg-entertainment/' ), 'link_label' => 'Visit OMG Entertainment' ),
		array( 'image' => $img . 'omg-studio-display.jpg', 'logo' => $img . 'oos-logo-studio-lg.png', 'title' => 'OMG Studio', 'description' => 'Photo booths, video booths, photography &amp; videography.', 'url' => home_url( '/omg-studio/' ), 'link_label' => 'Visit OMG Studio' ),
		array( 'image' => $img . 'props-custom-new.jpg', 'logo' => $img . 'oos-logo-props-lg.png', 'title' => 'OMG Props &amp; Theming', 'description' => 'Casino props, grand entrances, theme walls, furniture &amp; AV.', 'url' => home_url( '/omg-props-theming/' ), 'link_label' => 'Visit OMG Props &amp; Theming' ),
		array( 'logo' => $img . 'oos-logo-fnb-2026c.png', 'title' => 'OMG Food &amp; Beverage', 'description' => 'Catering, mobile bars, bartenders &amp; mixologists, plus professional staff hire.', 'url' => home_url( '/coming-soon/' ), 'link_label' => 'Visit OMG Food &amp; Beverage' ),
	),
	'cta' => array(
		'title'    => 'Ready To Get The Room Moving?',
		'subtitle' => 'DJs, Karaoke, Live Bands and Showstopping Performers.<br>Get a free, no-obligation quote today and let&rsquo;s get the party started',
	),
	'marquee' => array(
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
	),
) );

get_footer();
