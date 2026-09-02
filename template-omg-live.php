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
		'slides'      => array( array( 'type' => 'image', 'url' => $img . 'omg-live-hero.jpg' ) ),
	),
	'welcome' => array(
		'heading'     => 'Welcome to OMG LiVE',
		'paragraphs'  => array(
			'At OMG Group, we specialize in the &ldquo;Wow&rdquo; factor. OMG LiVE is our dedicated division for premium entertainment and essential event lighting. Whether you are looking to hire a DJ for a corporate gala or need a live party band for a milestone celebration, we provide the elite talent and the professional lighting to ensure your event looks and feels spectacular.',
		),
		'bullets'     => array(
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
	'cards_intro' => 'Three ways to fill the room with sound and atmosphere.',
	'cards' => array(
		array(
			'icon'        => $img . 'live-svc-dj.png',
			'title'       => 'Professional DJ Hire',
			'description' => 'The perfect mix of charisma and technical skill. Our professional DJs provide a complete entertainment solution, arriving with premium sound systems and a massive library spanning every genre. From chill lounge vibes to high-octane dance floors, we handle the music and the tech for Corporate, Private, Wedding, and Special Events.',
			'url'         => home_url( '/omg-live/our-services/#djs-dj-booth' ),
			'link_label'  => 'VISIT US',
		),
		array(
			'icon'        => $img . 'live-svc-bands.png',
			'title'       => 'Live Bands &amp; Musicians',
			'description' => 'Add the unmistakable energy of live performance to your stage. Choose from acoustic soloists, jazz trios, or full-throttle party bands. We bring you Australia&rsquo;s elite musical acts &mdash; hand-picked performers who don&rsquo;t just play music, they command the stage and captivate every guest in the room.',
			'url'         => home_url( '/omg-live/our-services/#live-bands' ),
			'link_label'  => 'VISIT US',
		),
		array(
			'icon'        => $img . 'live-svc-lighting.png',
			'title'       => 'Event Lighting Hire',
			'description' => 'Transform your venue with a touch of light. We specialize in essential atmospheric lighting, including wireless LED uplighting and PAR cans. Whether you need to match your corporate branding or create a warm, elegant glow for a gala, our lighting solutions set the perfect mood.',
			'url'         => home_url( '/omg-live/our-services/#event-lighting-hire' ),
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
			'Club-standard sound and production',
			'Open-format DJs who read the room',
			'Clean, modern LED lighting rigs',
			'Vetted professional musicians',
			'One team for DJ, lighting &amp; live music',
			'Trusted across corporate &amp; luxury events',
		),
		'body'    => 'Let OMG LiVE get your room moving.',
		'buttons' => array(
			array( 'url' => 'tel:1300300664', 'label' => 'Call Us' ),
			array( 'url' => home_url( '/contact/' ), 'label' => 'Book an Event' ),
			array( 'url' => 'mailto:info@OMGgroup.com.au', 'label' => 'Email Us' ),
		),
	),
	'testimonials' => array(
		'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
		'items' => array(
			array( 'quote' => 'We hired the OMG group for our corporate Christmas party and let me tell you &mdash; everyone had the best night! The DJ read the room perfectly all night.', 'cite' => '&mdash; Elisa Chinnabootr' ),
			array( 'quote' => 'The lighting completely transformed the venue and the band kept the floor packed until the very end. Faultless from start to finish.', 'cite' => '&mdash; Corporate Event Manager, Sydney NSW' ),
			array( 'quote' => 'We hired OMG group for our mid-year office party and their service and quality was excellent.', 'cite' => '&mdash; Aarti Mehra' ),
		),
	),
	'other_heading' => 'Other Services',
	'other' => array(
		array( 'image' => $img . 'omg-entertainment-banner1.jpg', 'logo' => $img . 'oos-logo-1.png', 'title' => 'OMG Entertainment', 'description' => 'Casino nights, race days, poker &amp; showstopping performers.', 'url' => home_url( '/omg-entertainment/' ), 'link_label' => 'Visit OMG Entertainment' ),
		array( 'image' => $img . 'omg-studio-display.jpg', 'logo' => $img . 'oos-logo-studio.jpg', 'title' => 'OMG Studio', 'description' => 'Photo booths, video booths, photography &amp; videography.', 'url' => home_url( '/omg-studio/' ), 'link_label' => 'Visit OMG Studio' ),
		array( 'image' => $img . 'props-custom-new.jpg', 'logo' => $img . 'oos-logo-3.png', 'title' => 'OMG Props &amp; Theming', 'description' => 'Casino props, grand entrances, theme walls, furniture &amp; AV.', 'url' => home_url( '/omg-props-theming/' ), 'link_label' => 'Visit OMG Props &amp; Theming' ),
	),
	'cta' => array(
		'title'    => 'Ready To Get The Room Moving?',
		'subtitle' => 'DJs, lighting or live music &mdash; get in touch for a free, no-obligation quote.',
	),
	'marquee' => array(
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
	),
) );

get_footer();
