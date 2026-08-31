<?php
/**
 * Template Name: OMG Studio Page
 *
 * PHASE 2: placeholder content wired to theme assets so the layout + teal
 * palette are testable. Phase 4 replaces this with the real OMG Studio
 * content (static), reusing the same shared components.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();

$img = OMG_HYBRID_URI . '/assets/images/';

get_template_part( 'template-parts/service-landing', null, array(
	'hero' => array(
		'variant'     => 'home',
		'eyebrow'     => 'OMG Studio',
		'title'       => 'Every Moment Of Your Event, Captured',
		'description' => 'Photo booths, video booths, photography and videography — in whatever format suits your event best.',
		'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Free Quote' ),
		'slides'      => array( array( 'type' => 'image', 'url' => $img . 'omg-studio-display.jpg' ) ),
	),
	'rows_heading' => 'Our Studio Services',
	'rows' => array(
		array(
			'id'        => 'photo-booths',
			'title'     => 'Photo Booths',
			'paragraph' => 'From the compact Mini-Studio Booth to the DSLR-powered Studio Deluxe Booth — crisp prints and instant digital sharing for every guest.',
			'bullets'   => array( 'Mini-Studio & Studio Deluxe options', 'DSLR camera & professional studio lighting', 'Instant prints plus digital sharing' ),
			'image'     => $img . 'our-booth-img-4.jpg',
		),
		array(
			'id'        => 'video-phone-booth',
			'title'     => 'Video Phone-Booth',
			'paragraph' => 'A retro-cool, interactive alternative to the traditional guestbook — guests pick up the receiver and record a message worth keeping.',
			'bullets'   => array( 'A fresh alternative to the guestbook', 'Video messages guests want to keep', 'Retro styling for weddings, parties & corporate' ),
			'image'     => $img . 'our-booth-img-5.jpg',
			'reverse'   => true,
		),
		array(
			'id'        => '360-video-booth',
			'title'     => '360 Video Booth',
			'paragraph' => 'Step on, spin around and go viral. Immersive slow-motion HD video from every angle, share-ready in seconds.',
			'bullets'   => array( 'Slow-motion HD video from every angle', 'Instant, share-ready clips', 'A high-energy centrepiece for any event' ),
			'image'     => $img . 'our-booth-img-6.jpg',
		),
	),
	'why' => array(
		'heading' => 'Why Choose OMG Studio?',
		'bullets' => array( 'Premium photobooth experiences', 'Professional photography & videography', 'High-end equipment & lighting', 'Friendly, experienced team', 'Reliable across Sydney & Australia', 'Stunning photos and cinematic videos' ),
		'body'    => 'Let OMG Studio turn your event into an unforgettable experience.',
		'buttons' => array( array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Quote' ), array( 'url' => home_url( '/our-booths/' ), 'label' => 'See Our Booths' ) ),
	),
	'testimonials' => array(
		'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
		'items' => array(
			array( 'quote' => 'The photo booth was an absolute hit! Everyone loved it. I cannot recommend OMG Studio highly enough — so professional and friendly.', 'cite' => '— Rana D., Seven Hills NSW' ),
			array( 'quote' => 'Photobooth was a hit at the party. Easy going, really professional and so much fun! Can’t wait to use them again!', 'cite' => '— Khalehla S., Campbelltown NSW' ),
		),
	),
	'other' => array(
		array( 'image' => $img . 'oos-img-1.png', 'logo' => $img . 'oos-logo-1.png', 'title' => 'OMG Entertainment', 'description' => 'Casino nights, race days, poker & performers.', 'url' => home_url( '/omg-entertainment/' ) ),
		array( 'image' => $img . 'oos-img-2.png', 'logo' => $img . 'oos-logo-2.png', 'title' => 'OMG LiVE', 'description' => 'Elite DJs, lighting and live bands.', 'url' => home_url( '/omg-live/' ) ),
		array( 'image' => $img . 'oos-img-3.png', 'logo' => $img . 'oos-logo-3.png', 'title' => 'OMG Props & Theming', 'description' => 'Casino props, entrances, theme walls & AV.', 'url' => home_url( '/omg-props-theming/' ) ),
	),
	'cta' => array(
		'title'    => 'Let’s Capture Your Event Perfectly',
		'subtitle' => 'Booths, photography or videography — get in touch for a free, no-obligation quote.',
	),
	'marquee' => array(
		'title' => 'Trusted By',
		'logos' => array( $img . 'marque-logo1.jpg', $img . 'marque-logo2.jpg', $img . 'marque-logo3.jpg', $img . 'marque-logo4.jpg', $img . 'marque-logo5.jpg', $img . 'marque-logo6.jpg' ),
	),
) );

get_footer();
