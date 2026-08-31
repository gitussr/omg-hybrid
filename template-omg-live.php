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
	'rows' => array(
		array(
			'id'         => 'djs-dj-booth',
			'ribbon'     => 'Professional DJ Hire',
			'title'      => 'DJs &amp; DJ Booth',
			'paragraph'  => 'More than just a playlist &mdash; our open-format DJs master the art of reading the room, transitioning from sophisticated lounge and jazz during cocktails to energetic dance tracks when the party peaks, all through club-standard audio and a sleek, custom-designed booth.',
			'bullets'    => array(
				'High-fidelity, club-standard PA systems scaled to guest count',
				'Wireless microphones included for speeches and MC duties',
				'Sleek, custom-designed booths matching your event aesthetic',
			),
			'image'      => $img . 'dj-custom-new.jpg',
			'image_alt'  => 'DJ performing at an OMG LiVE event',
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Enquire About DJ Hire',
		),
		array(
			'id'         => 'event-lighting-hire',
			'ribbon'     => 'Atmosphere By Design',
			'title'      => 'Event Lighting Hire',
			'paragraph'  => 'We focus on atmospheric lighting, not stadium-scale production &mdash; transforming ordinary venues into extraordinary spaces. From sophisticated warm tones for a formal gala to vibrant, colour-matched washes for a product launch, our clean, modern LED rigs run efficiently in any venue.',
			'bullets'    => array(
				'Wireless, cable-free LED uplighting for walls, pillars &amp; features',
				'Static and dynamic colour options, including custom colour matching',
				'Seamless compatibility with our DJ and live band services',
			),
			'image'      => $img . 'events-custom-new.jpg',
			'image_alt'  => 'Coloured LED lighting in use at an OMG LiVE event',
			'reverse'    => true,
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Request A Lighting Quote',
		),
		array(
			'id'         => 'live-bands',
			'ribbon'     => 'Australia&rsquo;s Finest Musical Artists',
			'title'      => 'Live Bands &amp; Musicians',
			'paragraph'  => 'Nothing replaces the energy of a live performance. Our roster of vetted, professional session musicians and powerhouse performers ranges from acoustic soloists and jazz ensembles to full party bands and specialty performers, suited to everything from intimate dinners to large corporate galas.',
			'bullets'    => array(
				'Acoustic soloists &amp; duos, jazz ensembles, full party bands &amp; specialty acts',
				'Vetted, seasoned professionals with corporate &amp; luxury event experience',
				'Versatile, customisable setlists matched to your guest list',
			),
			'image'      => $img . 'omg-entertainment-banner1.jpg',
			'image_alt'  => 'Guests enjoying live entertainment at an OMG LiVE event',
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Check Artist Availability',
		),
	),
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
