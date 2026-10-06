<?php
/**
 * Template Name: OMG Props & Theming Page
 *
 * Static content on the shared components, from the existing OMG Props &
 * Theming material. Yellow palette via the svc-props body class
 * (inc/services.php).
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
		'eyebrow'     => 'OMG Props &amp; Theming',
		'title'       => 'Set The Scene Before A Single Guest Arrives',
		'description' => 'Casino props, grand entrances, theme walls, furniture and AV tech &mdash; the styling and equipment that sets the scene before a single guest arrives.',
		'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Free Quote' ),
		'slides'      => array(
			array( 'type' => 'image', 'url' => $img . 'props-custom-new.jpg' ),
			array( 'type' => 'image', 'url' => $img . 'events-custom-new.jpg' ),
			array( 'type' => 'image', 'url' => $img . 'hero-bg-2.jpg' ),
		),
	),
	'welcome' => array(
		'heading'     => 'Welcome to',
		'heading_logo' => array( 'url' => $img . 'oos-logo-props-lg.png', 'alt' => 'OMG Props & Theming' ),
		'paragraphs'  => array(
			'Walk in, look around, say &ldquo;wow.&rdquo; OMG Props &amp; Theming turns any venue into a whole new world before the first card is even dealt.',
			'Roll out the red carpet under a glowing Welcome to Vegas sign, light up the room with giant CASINO letters, and step inside a Las Vegas, 007 Casino Royale or Great Gatsby theme wall made for photos to name a few. We handle the rest too, with furniture and styling hire, event lighting and professional audio-visual gear, so your event looks, sounds and feels incredible.',
			'From Corporate Functions and Charity Galas to Birthdays and Private Parties, our Party Props and Event Theming set the scene your guests will remember.',
		),
		// DORMANT (client 2026-09-28): the .oh-welcome__points list is hidden.
		// welcome.php only reads 'bullets' - rename this key back to show it.
		'bullets_dormant' => array(
			array( 'label' => 'Signature Themes, Done Properly', 'text' => 'Ut enim ad minim veniam &mdash; Casino Royale, 1920s Gatsby, Las Vegas, Moulin Rouge and Hollywood, styled with real attention to detail.' ),
			array( 'label' => 'Delivered, Set Up &amp; Styled', 'text' => 'Quis nostrud exercitation ullamco laboris &mdash; our team handles the heavy lifting, the layout and the finishing touches.' ),
			array( 'label' => 'Flexible Bundles For Any Budget', 'text' => 'Duis aute irure dolor in reprehenderit &mdash; mix and match props, walls, furniture and AV to suit the event and the spend.' ),
		),
		'buttons'     => omg_hybrid_cta_buttons(),
		// Client 2026-09-24: was props-detail.jpg (294x165, too small for the
		// full-height welcome image box).
		'image'       => $img . 'welcome-props-casino-table.jpg',
		'image_alt'   => 'OMG-branded roulette table with stacks of casino chips at an event',
		'image_style' => 'photo',
	),
	'cards_heading' => 'Our Products',
	'cards_intro' => '<strong>Dream It, Theme It, Live It</strong>. Explore the collection below and book the Props, Lighting and Styling that turn your venue into the place everyone wants to be.',
	'cards' => array(
		array(
			'icon'        => $img . 'props-svc-casino.png',
			'title'       => 'Casino Props',
			'description' => 'Giant CASINO Light-up Letters, oversized Dice and Cards, and Balloons that bring the Vegas glow to any room.',
			'url'         => home_url( '/omg-props-theming/our-services/#casino-props' ),
			'link_label'  => 'VISIT US',
		),
		array(
			'icon'        => $img . 'props-svc-entrance.png',
			'title'       => 'Grand Entrance Themes',
			'description' => 'Red Carpet, Bollards, glowing Vegas and Cinema Signs, and elegant Drapes for a VIP arrival from the first step.',
			'url'         => home_url( '/omg-props-theming/our-services/#grand-entrance-themes' ),
			'link_label'  => 'VISIT US',
		),
		array(
			'icon'        => $img . 'props-svc-walls.png',
			'title'       => 'Theme Walls',
			'description' => 'Stunning LED and Themed Walls in Las Vegas, 007 Casino Royale and Great Gatsby styles, made for scene-setting and selfies.',
			'url'         => home_url( '/omg-props-theming/our-services/#theme-walls' ),
			'link_label'  => 'VISIT US',
		),
		array(
			'icon'        => $img . 'props-svc-furniture.png',
			'title'       => 'Furniture &amp; Styling Hire',
			'description' => 'Tables, Chairs, Covers and Runners, including custom-branded Casino Tables, styled to match your theme perfectly.',
			'url'         => home_url( '/omg-props-theming/our-services/#furniture' ),
			'link_label'  => 'VISIT US',
		),
		// Lighting and AV swapped places (client 2026-09-28): Lighting is 5th.
		array(
			'icon'        => $img . 'props-svc-lighting.png',
			'title'       => 'Event Lighting Hire',
			'description' => 'Uplights and Table Lights that bathe your venue in colour and set the mood from dusk until the last dance.',
			'url'         => home_url( '/omg-live/our-services/#event-lighting-hire' ),
			'link_label'  => 'VISIT US',
		),
		array(
			'icon'        => $img . 'props-svc-av.png',
			'title'       => 'Audio-Visual Hire',
			'description' => 'A BOSE L1 Pro 16 Sound System, Microphones or a 100-inch Screen with a bright short-throw Projector for speeches, slideshows and Big Moments.',
			'url'         => home_url( '/omg-props-theming/our-services/#audio-visual-tech' ),
			'link_label'  => 'VISIT US',
		),
	),
	// Service detail rows shared with /omg-props-theming/our-services/
	// (inc/brand-services.php); not rendered here (dormant).
	'rows' => omg_hybrid_brand_services( 'props' )['rows'],
	'why' => array(
		'heading' => 'Why Choose OMG Props &amp; Theming?',
		'bullets' => array(
			'Ready-made Vegas, 007 and Gatsby Themes',
			'Custom-Branded Tables and Entrance Signs',
			'Props, Lighting, Furniture and AV in one place',
			'Pairs perfectly with our Casino and Race Fun-Nights',
			'Transparent pricing, no hidden costs',
			'$20 million public liability cover',
		),
		'body'    => 'Let OMG Props &amp; Theming transform your venue.',
		'buttons' => array(
			array( 'url' => 'tel:1300300664', 'label' => 'Call Us' ),
			array( 'url' => home_url( '/contact/' ), 'label' => 'Book an Event' ),
			array( 'url' => 'mailto:info@OMGent.com.au', 'label' => 'Email Us' ),
		),
	),
	// Quotes shared with /omg-props-theming/our-services/ (inc/brand-services.php).
	'testimonials' => omg_hybrid_brand_testimonials( 'props' ),
	'other_heading' => 'Other Services',
	'other_description' => 'Why stop at the styling? Complete the night with the full OMG experience: Casino Tables, Race Nights and Poker Tournaments, Photo-Booths and Photography, DJs, Live Bands and Performers, plus Food, Drinks and Professional Staff. It&rsquo;s everything your event needs, all under one roof.',
	'other' => array(
		array( 'image' => $img . 'omg-entertainment-banner1.jpg', 'logo' => $img . 'oos-logo-entertainment-lg.png', 'title' => 'OMG Entertainment', 'description' => 'Casino nights, race days, poker &amp; showstopping performers.', 'url' => home_url( '/omg-entertainment/' ), 'link_label' => 'Visit OMG Entertainment' ),
		array( 'image' => $img . 'omg-studio-display.jpg', 'logo' => $img . 'oos-logo-studio-lg.png', 'title' => 'OMG Studio', 'description' => 'Photo booths, video booths, photography &amp; videography.', 'url' => home_url( '/omg-studio/' ), 'link_label' => 'Visit OMG Studio' ),
		array( 'image' => $img . 'omg-live-hero.jpg', 'logo' => $img . 'oos-logo-live-lg.png', 'title' => 'OMG LiVE', 'description' => 'Elite DJs, atmospheric lighting and unforgettable live bands.', 'url' => home_url( '/omg-live/' ), 'link_label' => 'Visit OMG LiVE' ),
		array( 'logo' => $img . 'oos-logo-fnb-2026c.png', 'title' => 'OMG Food &amp; Beverage', 'description' => 'Catering, mobile bars, bartenders &amp; mixologists, plus professional staff hire.', 'url' => home_url( '/omg-food-beverage/' ), 'link_label' => 'Visit OMG Food &amp; Beverage' ),
	),
	'cta' => array(
		'title'    => 'Let&rsquo;s Roll Out The Red Carpet',
		'subtitle' => 'Props, Theme Walls, Lighting, Furniture or AV, your showstopping venue is one call away. Get a free, no-obligation quote today and let&rsquo;s bring your theme to life.',
	),
	'marquee' => array(
		'title' => 'The Best BRANDS CHOOSE THE BEST BRAND',
		// Keep the 4-row logo slider on phones too, not the one-row strip
		// (client task-016, 2026-10-05).
		'hide_on_mobile' => false,
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
