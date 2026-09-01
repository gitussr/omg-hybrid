<?php
/**
 * Template Name: OMG Studio Page
 *
 * Static content drawn from the existing OMG Studio site (its content is
 * SCF-driven there; kept static here per the approved plan). Reuses the
 * shared component set — teal palette applied via the svc-studio body
 * class (inc/services.php).
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
		'eyebrow'     => 'OMG Studio',
		'title'       => 'Ready? Set? Pose!',
		'description' => 'We bring the laughter, fun and excitement to every event &mdash; one click at a time. Photo booths, video booths, photography and videography, in whatever format suits your event best.',
		'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Free Quote' ),
		'slides'      => array( array( 'type' => 'image', 'url' => $img . 'omg-studio-display.jpg' ) ),
	),
	'welcome' => array(
		'heading'    => 'Welcome to OMG Studio',
		'paragraphs' => array(
			'We believe every event deserves to be unforgettable. We specialise in Photobooth Hire/Sales, Photography, Video Guest Books, and Videography for weddings, corporate events, birthdays, and special celebrations.',
			'Our mission is simple: To create &ldquo;OMG&rdquo; moments and fun experiences that your guests will remember forever.',
			'What makes OMG Studio different is our commitment to quality, reliability, and customer experience. We don&rsquo;t just provide services&mdash;we create memories that last a lifetime.',
		),
		'buttons'    => omg_hybrid_cta_buttons(),
		'image'      => $img . 'welcome-studio-filmstrip.jpg',
		'image_alt'  => 'OMG Studio photo booth prints from weddings and events',
	),
	'cards_intro' => 'Five ways to capture your event &mdash; pick the formats that suit your day best.',
	'cards' => array(
		array(
			'title'       => 'Photo Booths',
			'description' => 'From the compact Mini-Studio Booth to the DSLR-powered Studio Deluxe &mdash; crisp instant prints and digital sharing for every guest.',
			'url'         => '#photo-booths',
			'link_label'  => 'VISIT US',
		),
		array(
			'title'       => 'Video Phone-Booth',
			'description' => 'A retro-cool alternative to the guestbook &mdash; guests pick up the receiver and record a video message worth keeping.',
			'url'         => '#video-phone-booth',
			'link_label'  => 'VISIT US',
		),
		array(
			'title'       => '360 Video Booth',
			'description' => 'Step on, spin around and go viral with immersive slow-motion HD video, captured from every angle and ready to share.',
			'url'         => '#360-video-booth',
			'link_label'  => 'VISIT US',
		),
		array(
			'title'       => 'Photography',
			'description' => 'Premium and roaming photographers who skip the forced poses and capture your event as it really happens.',
			'url'         => '#photography',
			'link_label'  => 'VISIT US',
		),
		array(
			'title'       => 'Videography',
			'description' => 'A cinematic eye on every frame &mdash; highlight reels, wedding films and social-ready cuts that tell the story.',
			'url'         => '#videography',
			'link_label'  => 'VISIT US',
		),
	),
	'rows' => array(
		array(
			'id'         => 'photo-booths',
			'ribbon'     => 'Photo Booths',
			'title'      => 'Photo Booths',
			'paragraph'  => 'From the compact, budget-friendly Mini-Studio Booth to the Studio Deluxe Booth &mdash; powered by a Canon DSLR camera and professional studio lighting &mdash; our photo booths deliver crisp, high-quality prints and instant digital sharing for guests of every event.',
			'bullets'    => array(
				'Mini-Studio Booth &mdash; maximum fun in a compact, budget-friendly setup',
				'Studio Deluxe Booth &mdash; Canon DSLR camera &amp; professional studio lighting',
				'Instant prints plus digital sharing for every guest',
			),
			'image'      => $img . 'omg-studio-booth-img-insta.jpg',
			'image_alt'  => 'Guests using an OMG Studio photo booth at an event',
			'link_url'   => home_url( '/our-booths/' ),
			'link_label' => 'Explore Our Photo Booths',
		),
		array(
			'id'         => 'video-phone-booth',
			'ribbon'     => 'Video Phone-Booth',
			'title'      => 'Video Phone-Booth',
			'paragraph'  => 'Step on screen, pick up the receiver and leave a message. Our retro-cool Video Phone-Booth ditches the traditional guestbook for an interactive experience that blends nostalgic charm with a genuinely memorable keepsake for guests.',
			'bullets'    => array(
				'A fresh, interactive alternative to the traditional guestbook',
				'Guests record video messages worth keeping',
				'Retro styling that suits weddings, parties &amp; corporate events',
			),
			'image'      => $img . 'omg-studio-video-phone-booth-img-insta.jpg',
			'image_alt'  => 'Guest recording a message at the OMG Studio Video Phone-Booth',
			'reverse'    => true,
			'link_url'   => home_url( '/our-booths/#booth-2' ),
			'link_label' => 'See The Video Phone-Booth',
		),
		array(
			'id'         => '360-video-booth',
			'ribbon'     => 'Studio 360 Video-Booth',
			'title'      => '360 Video Booth',
			'paragraph'  => 'Step on, spin around and go viral. The OMG Studio 360 Video-Booth is an immersive experience that captures high-energy, slow-motion HD video from every angle &mdash; perfect for guests who want to share the moment straight away.',
			'bullets'    => array(
				'Immersive, slow-motion HD video from every angle',
				'Instant, share-ready clips for social media',
				'A high-energy centrepiece for any event',
			),
			'image'      => $img . 'omg-studio-360-booth.jpg',
			'image_alt'  => 'Guest using the OMG Studio 360 Video-Booth',
			'link_url'   => home_url( '/our-booths/#booth-3' ),
			'link_label' => 'See The 360 Video-Booth',
		),
		array(
			'id'         => 'photography',
			'ribbon'     => 'Candid Moments, Premium Quality',
			'title'      => 'Photography',
			'paragraph'  => 'From premium event photography for corporate functions and galas to budget-friendly roaming photography for weddings and private parties, our photographers ditch the cheesy, forced poses and blend seamlessly into your event to capture it as it really happens.',
			'bullets'    => array(
				'Lead professional photographer for structured itineraries',
				'Roaming photography that captures authentic, candid reactions',
				'Fast turnaround, high-resolution galleries',
			),
			'image'      => $img . 'event-photography-thumbnail.jpg',
			'image_alt'  => 'OMG Studio photographer capturing guests at an event',
			'reverse'    => true,
			'link_url'   => home_url( '/photography-videography/#main-block-0' ),
			'link_label' => 'View Our Photography',
		),
		array(
			'id'         => 'videography',
			'ribbon'     => 'Your Event, Directed By The Best',
			'title'      => 'Videography',
			'paragraph'  => 'A cinematic eye on every frame, producing high-end visual stories from your event. From polished corporate highlight reels and brand launches to sentimental wedding films and quick-turnaround social media reels, we capture the story, not just the footage.',
			'bullets'    => array(
				'Cinematic highlight reels for corporate &amp; brand events',
				'Sentimental, story-led wedding films',
				'Social-first vertical cuts &amp; Instagram Reels, ready to post',
			),
			'image'      => $img . 'event-videography.jpg',
			'image_alt'  => 'OMG Studio videographer filming at an event',
			'link_url'   => home_url( '/photography-videography/#main-block-2' ),
			'link_label' => 'View Our Videography',
		),
	),
	'why' => array(
		'heading' => 'Why Choose OMG Studio?',
		'bullets' => array(
			'Premium photobooth experiences',
			'Professional photography &amp; videography',
			'High-end equipment &amp; lighting',
			'Friendly and experienced team',
			'Reliable service across Sydney &amp; Australia',
			'Stunning photos and cinematic videos',
		),
		'body'    => 'Let OMG Studio turn your event into an unforgettable experience.',
		'buttons' => array(
			array( 'url' => 'tel:1300300664', 'label' => 'Call Us' ),
			array( 'url' => home_url( '/contact/' ), 'label' => 'Book an Event' ),
			array( 'url' => 'mailto:info@OMGgroup.com.au', 'label' => 'Email Us' ),
		),
	),
	'testimonials' => array(
		'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
		'items' => array(
			array( 'quote' => 'The photo booth was an absolute hit! Everyone loved it. Angelique was our attendant and she was an absolute delight. I cannot recommend OMG Studio highly enough &mdash; so professional and friendly. A heartfelt THANK YOU!', 'cite' => '&mdash; Rana D., Seven Hills NSW' ),
			array( 'quote' => 'Photobooth was a hit at the party. Easy going, really professional and so much fun! Can&rsquo;t wait to use them again!', 'cite' => '&mdash; Khalehla S., Campbelltown NSW' ),
			array( 'quote' => 'From the initial planning to the final execution, their team was professional, attentive and truly brought our vision to life. Highly recommend their services for any occasion!', 'cite' => '&mdash; Sorted Photography &amp; Videography' ),
		),
	),
	'other_heading' => 'Other Services',
	'other' => array(
		array( 'image' => $img . 'omg-entertainment-banner1.jpg', 'logo' => $img . 'oos-logo-1.png', 'title' => 'OMG Entertainment', 'description' => 'Casino nights, race days, poker &amp; showstopping performers.', 'url' => home_url( '/omg-entertainment/' ), 'link_label' => 'Visit OMG Entertainment' ),
		array( 'image' => $img . 'omg-live-hero.jpg', 'logo' => $img . 'oos-logo-2.png', 'title' => 'OMG LiVE', 'description' => 'Elite DJs, atmospheric lighting and unforgettable live bands.', 'url' => home_url( '/omg-live/' ), 'link_label' => 'Visit OMG LiVE' ),
		array( 'image' => $img . 'props-custom-new.jpg', 'logo' => $img . 'oos-logo-3.png', 'title' => 'OMG Props &amp; Theming', 'description' => 'Casino props, grand entrances, theme walls, furniture &amp; AV.', 'url' => home_url( '/omg-props-theming/' ), 'link_label' => 'Visit OMG Props &amp; Theming' ),
	),
	'cta' => array(
		'title'    => 'Let&rsquo;s Capture Your Event Perfectly',
		'subtitle' => 'Booths, photography or videography &mdash; get in touch for a free, no-obligation quote.',
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
