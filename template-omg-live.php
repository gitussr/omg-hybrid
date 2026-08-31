<?php
/**
 * Template Name: OMG Live Page
 *
 * PHASE 2: placeholder content so the layout + purple palette are
 * testable. Phase 5 rebuilds this from the existing OMG LiVE HTML site
 * content (static), reusing the shared components.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();

$img = OMG_HYBRID_URI . '/assets/images/';

get_template_part( 'template-parts/service-landing', null, array(
	'hero' => array(
		'variant'     => 'home',
		'eyebrow'     => 'OMG LiVE',
		'title'       => 'Read The Room. Keep It Moving.',
		'description' => 'Elite DJs, atmospheric lighting and unforgettable live bands — club-standard sound and production for any event.',
		'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Check Availability' ),
		'slides'      => array( array( 'type' => 'image', 'url' => $img . 'our-impact-single-image-1.jpg' ) ),
	),
	'rows_heading' => 'Our LiVE Services',
	'rows' => array(
		array(
			'id'        => 'djs-dj-booth',
			'title'     => 'DJs &amp; DJ Booth',
			'paragraph' => 'Open-format DJs who master the art of reading the room — from lounge and jazz during cocktails to peak-time dance tracks, through club-standard audio and a sleek custom booth.',
			'bullets'   => array( 'Club-standard PA scaled to guest count', 'Wireless microphones for speeches & MC duties', 'Sleek custom booths matched to your aesthetic' ),
			'image'     => $img . 'our-impact-single-image-2.jpg',
		),
		array(
			'id'        => 'event-lighting-hire',
			'title'     => 'Event Lighting Hire',
			'paragraph' => 'Atmospheric lighting that transforms ordinary venues — from warm tones for a formal gala to vibrant colour-matched washes for a product launch.',
			'bullets'   => array( 'Wireless LED uplighting for walls & features', 'Static and dynamic colour, including custom matching', 'Works seamlessly with our DJ and live band services' ),
			'image'     => $img . 'our-impact-single-image-3.jpg',
			'reverse'   => true,
		),
		array(
			'id'        => 'live-bands',
			'title'     => 'Live Bands &amp; Musicians',
			'paragraph' => 'Vetted, professional session musicians and powerhouse performers — from acoustic soloists and jazz ensembles to full party bands and specialty acts.',
			'bullets'   => array( 'Soloists, duos, jazz ensembles & full party bands', 'Seasoned professionals with luxury-event experience', 'Customisable setlists matched to your guest list' ),
			'image'     => $img . 'our-impact-single-image-4.jpg',
		),
	),
	'why' => array(
		'heading' => 'Why Choose OMG LiVE?',
		'bullets' => array( 'Club-standard sound and production', 'Open-format DJs who read the room', 'Clean, modern LED lighting rigs', 'Vetted professional musicians', 'One team for DJ, lighting & live music', 'Trusted across corporate & luxury events' ),
		'body'    => 'Let OMG LiVE get your room moving.',
		'buttons' => array( array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Quote' ) ),
	),
	'testimonials' => array(
		'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
		'items' => array(
			array( 'quote' => 'The DJ read the room perfectly all night and the lighting completely transformed the venue. Faultless.', 'cite' => '— Event Manager, Sydney NSW' ),
		),
	),
	'other' => array(
		array( 'image' => $img . 'oos-img-1.png', 'logo' => $img . 'oos-logo-1.png', 'title' => 'OMG Entertainment', 'description' => 'Casino nights, race days, poker & performers.', 'url' => home_url( '/omg-entertainment/' ) ),
		array( 'image' => $img . 'oos-img-2.png', 'logo' => $img . 'oos-logo-2.png', 'title' => 'OMG Studio', 'description' => 'Photo booths, video booths & photography.', 'url' => home_url( '/omg-studio/' ) ),
		array( 'image' => $img . 'oos-img-3.png', 'logo' => $img . 'oos-logo-3.png', 'title' => 'OMG Props & Theming', 'description' => 'Casino props, entrances, theme walls & AV.', 'url' => home_url( '/omg-props-theming/' ) ),
	),
	'cta' => array(
		'title'    => 'Ready To Get The Room Moving?',
		'subtitle' => 'DJs, lighting or live music — get in touch for a free, no-obligation quote.',
	),
	'marquee' => array(
		'title' => 'Trusted By',
		'logos' => array( $img . 'marque-logo1.jpg', $img . 'marque-logo2.jpg', $img . 'marque-logo3.jpg', $img . 'marque-logo4.jpg', $img . 'marque-logo5.jpg', $img . 'marque-logo6.jpg' ),
	),
) );

get_footer();
