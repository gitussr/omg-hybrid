<?php
/**
 * Template Name: OMG Props & Theming Page
 *
 * PHASE 2: placeholder content so the layout + yellow palette are
 * testable. Phase 6 rebuilds this from the existing OMG Props & Theming
 * website content (static), reusing the shared components.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

get_header();

$img = OMG_HYBRID_URI . '/assets/images/';

get_template_part( 'template-parts/service-landing', null, array(
	'hero' => array(
		'variant'     => 'home',
		'eyebrow'     => 'OMG Props &amp; Theming',
		'title'       => 'Set The Scene Before A Single Guest Arrives',
		'description' => 'Casino props, grand entrances, theme walls, furniture and AV tech — the styling and equipment that transforms your venue.',
		'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Free Quote' ),
		'slides'      => array( array( 'type' => 'image', 'url' => $img . 'omg-studio-golden-bg.jpg' ) ),
	),
	'rows_heading' => 'Our Props &amp; Theming Services',
	'rows' => array(
		array(
			'id'        => 'casino-props',
			'title'     => 'Casino Props',
			'paragraph' => 'Decorative and entertainment props that set the scene — illuminated marquee letters, a programmable Welcome to Vegas LED sign, oversized dice and full themed bundles.',
			'bullets'   => array( 'Light-up marquee letters & Vegas LED signage', 'Giant dice and card-suit props', 'Themed bundles: carpet, wall & stand-ups' ),
			'image'     => $img . 'omg-studio-golden-bg-2.jpg',
		),
		array(
			'id'        => 'grand-entrance-themes',
			'title'     => 'Grand Entrance Themes',
			'paragraph' => 'First impressions set the tone — a red carpet and bollards, a custom entrance sign in a Vegas, James Bond or Gatsby theme, or a directional cinema-style marquee.',
			'bullets'   => array( 'Red carpet & bollards, plain or branded', 'Vegas, James Bond & Gatsby entrance signage', 'Customisable cinema-style marquee signs' ),
			'image'     => $img . 'omg-studio-golden-bg-3.jpg',
			'reverse'   => true,
		),
		array(
			'id'        => 'theme-walls',
			'title'     => 'Theme Walls',
			'paragraph' => 'Backlit LED Maxi and Mini theme walls or standard backdrop panels in Casino Royale, 1920s Gatsby, Las Vegas, Moulin Rouge or Hollywood themes.',
			'bullets'   => array( 'LED Maxi (6m) & Mini (1.4m) backlit walls', 'Standard backdrop panels in five themes', 'A photo-worthy focal point for any event' ),
			'image'     => $img . 'omg-studio-golden-bg.jpg',
		),
		array(
			'id'        => 'furniture',
			'title'     => 'Furniture',
			'paragraph' => 'Lounge and cocktail furniture, styling props and display tables — delivered and set up around your chosen theme.',
			'bullets'   => array( 'Lounge & cocktail furniture styled to your theme', 'Display and prop tables for games or photo areas', 'Delivered, set up and styled as part of your package' ),
			'image'     => $img . 'our-booth-img-1.jpg',
			'reverse'   => true,
		),
		array(
			'id'        => 'audio-visual-tech',
			'title'     => 'Audio / Visual Tech',
			'paragraph' => 'Clean, reliable sound and screen equipment to back up your styling — PA systems, microphones and display screens that integrate with our DJ and lighting services.',
			'bullets'   => array( 'PA systems and wireless microphones', 'Display screens for presentations or branding', 'Coordinates with OMG LiVE sound & lighting' ),
			'image'     => $img . 'our-booth-img-2.jpg',
		),
	),
	'why' => array(
		'heading' => 'Why Choose OMG Props &amp; Theming?',
		'bullets' => array( 'A full styling and equipment package', 'Signature themes done properly', 'Delivered, set up and styled for you', 'Coordinates with the rest of the OMG Group', 'Flexible bundles for any budget', 'Trusted across Australia' ),
		'body'    => 'Let OMG Props & Theming transform your venue.',
		'buttons' => array( array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Quote' ) ),
	),
	'other' => array(
		array( 'image' => $img . 'oos-img-1.png', 'logo' => $img . 'oos-logo-1.png', 'title' => 'OMG Entertainment', 'description' => 'Casino nights, race days, poker & performers.', 'url' => home_url( '/omg-entertainment/' ) ),
		array( 'image' => $img . 'oos-img-2.png', 'logo' => $img . 'oos-logo-2.png', 'title' => 'OMG Studio', 'description' => 'Photo booths, video booths & photography.', 'url' => home_url( '/omg-studio/' ) ),
		array( 'image' => $img . 'oos-img-3.png', 'logo' => $img . 'oos-logo-3.png', 'title' => 'OMG LiVE', 'description' => 'Elite DJs, lighting and live bands.', 'url' => home_url( '/omg-live/' ) ),
	),
	'cta' => array(
		'title'    => 'Ready To Style Your Event?',
		'subtitle' => 'Props, theming, furniture or AV — get in touch for a free, no-obligation quote.',
	),
	'marquee' => array(
		'title' => 'Trusted By',
		'logos' => array( $img . 'marque-logo1.jpg', $img . 'marque-logo2.jpg', $img . 'marque-logo3.jpg', $img . 'marque-logo4.jpg', $img . 'marque-logo5.jpg', $img . 'marque-logo6.jpg' ),
	),
) );

get_footer();
