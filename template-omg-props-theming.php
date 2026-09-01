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
		'slides'      => array( array( 'type' => 'image', 'url' => $img . 'props-custom-new.jpg' ) ),
	),
	'welcome' => array(
		// TODO: placeholder copy &amp; image — replace with the real Props &amp; Theming welcome content.
		'heading'     => 'Welcome to OMG Props &amp; Theming',
		'paragraphs'  => array(
			'Lorem ipsum dolor sit amet, consectetur adipiscing elit. From light-up letters and Vegas signage to full theme walls and grand entrances, we bring the props and styling that turn an ordinary room into the venue everyone talks about.',
			'Sed do eiusmod tempor incididunt ut labore. Every piece is delivered, set up and styled around your theme, so all you have to do is walk in and enjoy the transformation.',
		),
		'bullets'     => array(
			array( 'label' => 'Signature Themes, Done Properly', 'text' => 'Ut enim ad minim veniam &mdash; Casino Royale, 1920s Gatsby, Las Vegas, Moulin Rouge and Hollywood, styled with real attention to detail.' ),
			array( 'label' => 'Delivered, Set Up &amp; Styled', 'text' => 'Quis nostrud exercitation ullamco laboris &mdash; our team handles the heavy lifting, the layout and the finishing touches.' ),
			array( 'label' => 'Flexible Bundles For Any Budget', 'text' => 'Duis aute irure dolor in reprehenderit &mdash; mix and match props, walls, furniture and AV to suit the event and the spend.' ),
		),
		'buttons'     => omg_hybrid_cta_buttons(),
		'image'       => $img . 'props-detail.jpg',
		'image_alt'   => 'Las Vegas themed backdrop wall styled with OMG casino props',
		'image_style' => 'photo',
	),
	'cards_intro' => 'Five ways to set the scene &mdash; mix and match to transform your venue.',
	'cards' => array(
		array(
			// TODO: placeholder icon — replace with the real Casino Props icon.
			'icon'        => $img . 'props-svc-casino.svg',
			'title'       => 'Casino Props',
			'description' => 'Light-up marquee letters, programmable Vegas signage, giant dice and themed package bundles that set the scene for any casino night.',
			'url'         => '#casino-props',
			'link_label'  => 'VISIT US',
		),
		array(
			// TODO: placeholder icon — replace with the real Grand Entrance icon.
			'icon'        => $img . 'props-svc-entrance.svg',
			'title'       => 'Grand Entrance Themes',
			'description' => 'Red carpet and bollards, custom Vegas, James Bond or Gatsby entrance signage and cinema-style marquees for an upscale arrival.',
			'url'         => '#grand-entrance-themes',
			'link_label'  => 'VISIT US',
		),
		array(
			// TODO: placeholder icon — replace with the real Theme Walls icon.
			'icon'        => $img . 'props-svc-walls.svg',
			'title'       => 'Theme Walls',
			'description' => 'Backlit LED Maxi and Mini theme walls and backdrop panels in five signature themes &mdash; a ready-made, photo-worthy focal point.',
			'url'         => '#theme-walls',
			'link_label'  => 'VISIT US',
		),
		array(
			// TODO: placeholder icon — replace with the real Furniture icon.
			'icon'        => $img . 'props-svc-furniture.svg',
			'title'       => 'Furniture',
			'description' => 'Lounge and cocktail furniture, styling props and display tables, delivered and set up around your chosen theme.',
			'url'         => '#furniture',
			'link_label'  => 'VISIT US',
		),
		array(
			// TODO: placeholder icon — replace with the real Audio / Visual Tech icon.
			'icon'        => $img . 'props-svc-av.svg',
			'title'       => 'Audio / Visual Tech',
			'description' => 'Clean, reliable PA systems, microphones and display screens that integrate seamlessly with our DJ, lighting and live services.',
			'url'         => '#audio-visual-tech',
			'link_label'  => 'VISIT US',
		),
	),
	'rows' => array(
		array(
			'id'         => 'casino-props',
			'ribbon'     => 'Casino Props',
			'title'      => 'Casino Props',
			'paragraph'  => 'Decorative and entertainment props that set the scene for any casino-themed event &mdash; from illuminated marquee letters and a programmable Welcome to Vegas LED sign to oversized dice and full themed package bundles pairing a red carpet, theme wall and playing-card stand-ups.',
			'bullets'    => array(
				'Light-up marquee letters &amp; programmable Vegas LED signage',
				'Giant dice and card-suit props in James Bond, Gatsby &amp; Vegas themes',
				'Themed package bundles combining carpet, wall &amp; stand-ups',
			),
			'image'      => $img . 'events-custom-new.jpg',
			'image_alt'  => 'Casino-themed event styled with OMG props',
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Enquire About Casino Props',
		),
		array(
			'id'         => 'grand-entrance-themes',
			'ribbon'     => 'Grand Entrance Themes',
			'title'      => 'Grand Entrance Themes',
			'paragraph'  => 'First impressions set the tone. A red carpet and bollards, a custom entrance sign in a Vegas, James Bond or Gatsby theme, or a directional cinema-style marquee &mdash; each one styled to give your guests an upscale arrival experience from the moment they walk in.',
			'bullets'    => array(
				'Red carpet &amp; bollards, in plain or OMG-branded finishes',
				'Vegas, James Bond &amp; Gatsby themed entrance signage',
				'Customisable cinema-style marquee signs',
			),
			'image'      => $img . 'omg-studio-golden-bg-3.jpg',
			'image_alt'  => 'Illuminated themed entrance styling for an OMG event',
			'reverse'    => true,
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Enquire About Grand Entrances',
		),
		array(
			'id'         => 'theme-walls',
			'ribbon'     => 'Statement Backdrops',
			'title'      => 'Theme Walls',
			'paragraph'  => 'Backlit LED Maxi and Mini theme walls or standard backdrop panels, styled in Casino Royale, 1920s Gatsby, Las Vegas, Moulin Rouge or Hollywood themes &mdash; the perfect statement backdrop for photos, staging or a full room transformation.',
			'bullets'    => array(
				'LED Maxi (6m) &amp; Mini (1.4m) backlit theme walls',
				'Standard backdrop panels in five signature themes',
				'A ready-made, photo-worthy focal point for any event',
			),
			'image'      => $img . 'props-detail.jpg',
			'image_alt'  => 'Las Vegas themed backdrop wall with props styled for an event',
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Enquire About Theme Walls',
		),
		array(
			'id'         => 'furniture',
			'ribbon'     => 'Furniture',
			'title'      => 'Furniture',
			'paragraph'  => 'Lounge and cocktail furniture, styling props and display tables that tie your event styling together &mdash; delivered and set up around your chosen theme, whether that&rsquo;s a casino night, a corporate gala or a themed celebration.',
			'bullets'    => array(
				'Lounge &amp; cocktail furniture styled to your event theme',
				'Display and prop tables for casino games or photo areas',
				'Delivered, set up and styled as part of your package',
			),
			'image'      => $img . 'our-booth-img-1.jpg',
			'image_alt'  => 'Styled event setup with themed props and furniture',
			'reverse'    => true,
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Enquire About Furniture',
		),
		array(
			'id'         => 'audio-visual-tech',
			'ribbon'     => 'Audio / Visual Tech',
			'title'      => 'Audio / Visual Tech',
			'paragraph'  => 'Clean, reliable sound and screen equipment to back up your event styling &mdash; PA systems, microphones and display screens that integrate seamlessly with our DJ, lighting and live entertainment services for a fully coordinated event.',
			'bullets'    => array(
				'PA systems and wireless microphones for speeches &amp; MCs',
				'Display screens available for presentations or branding',
				'Coordinates seamlessly with OMG LiVE sound &amp; lighting',
			),
			'image'      => $img . 'events-custom-new.jpg',
			'image_alt'  => 'AV and lighting equipment set up at a styled OMG event',
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Enquire About AV Tech',
		),
	),
	'why' => array(
		'heading' => 'Why Choose OMG Props &amp; Theming?',
		'bullets' => array(
			'A full styling and equipment package',
			'Signature themes done properly',
			'Delivered, set up and styled for you',
			'Coordinates with the rest of the OMG Group',
			'Flexible bundles for any budget',
			'Trusted across Sydney &amp; regional Australia',
		),
		'body'    => 'Let OMG Props &amp; Theming transform your venue.',
		'buttons' => array(
			array( 'url' => 'tel:1300300664', 'label' => 'Call Us' ),
			array( 'url' => home_url( '/contact/' ), 'label' => 'Book an Event' ),
			array( 'url' => 'mailto:info@OMGgroup.com.au', 'label' => 'Email Us' ),
		),
	),
	'testimonials' => array(
		'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
		'items' => array(
			array( 'quote' => 'From the initial planning to the final execution, their team was professional, attentive and truly brought our vision to life. Highly recommend their services for any occasion!', 'cite' => '&mdash; Sorted Photography &amp; Videography' ),
			array( 'quote' => 'We hired the OMG group for our corporate Christmas party and let me tell you &mdash; everyone had the best night! The styling completely transformed the room.', 'cite' => '&mdash; Elisa Chinnabootr' ),
			array( 'quote' => 'We hired OMG group for our mid-year office party and their service and quality was excellent.', 'cite' => '&mdash; Aarti Mehra' ),
		),
	),
	'other_heading' => 'Other Services',
	'other' => array(
		array( 'image' => $img . 'omg-entertainment-banner1.jpg', 'logo' => $img . 'oos-logo-1.png', 'title' => 'OMG Entertainment', 'description' => 'Casino nights, race days, poker &amp; showstopping performers.', 'url' => home_url( '/omg-entertainment/' ), 'link_label' => 'Visit OMG Entertainment' ),
		array( 'image' => $img . 'omg-studio-display.jpg', 'logo' => $img . 'oos-logo-studio.jpg', 'title' => 'OMG Studio', 'description' => 'Photo booths, video booths, photography &amp; videography.', 'url' => home_url( '/omg-studio/' ), 'link_label' => 'Visit OMG Studio' ),
		array( 'image' => $img . 'omg-live-hero.jpg', 'logo' => $img . 'oos-logo-2.png', 'title' => 'OMG LiVE', 'description' => 'Elite DJs, atmospheric lighting and unforgettable live bands.', 'url' => home_url( '/omg-live/' ), 'link_label' => 'Visit OMG LiVE' ),
	),
	'cta' => array(
		'title'    => 'Ready To Style Your Event?',
		'subtitle' => 'Props, theming, furniture or AV &mdash; get in touch for a free, no-obligation quote.',
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
