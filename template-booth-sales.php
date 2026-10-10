<?php
/**
 * Template Name: Booth Sales Page
 *
 * /booth-sales/ (client 2026-10-10): coming-soon page for the OMG Studio
 * "Booth Sales" sub-service, which previously had no page (mega-menu link
 * was "#", Studio card went to /coming-soon/). Follows /omg-studio/: the
 * same banner slides and common sections, read from
 * omg_hybrid_studio_landing_args() (inc/brand-services.php), with the
 * Coming Soon intro in place of the Studio welcome.
 *
 * Studio palette via omg_hybrid_studio_inner_templates() (inc/services.php),
 * and the page-omg-studio body class (inc/setup.php) so the Studio page's
 * own button colours apply here too.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$studio = omg_hybrid_studio_landing_args();

// Banner: the Studio slides, with this page's own heading and copy.
$hero                = $studio['hero'];
$hero['title']       = 'Booth Sales';
$hero['description'] = 'Own a professional photo booth, with full setup and ongoing support included. Coming soon.';
$hero['cta']         = array( 'url' => home_url( '/contact/' ), 'label' => 'Register Your Interest' );

// Our Products: the other Studio products, available to hire now.
$cards = array_values( array_filter( $studio['cards'], static function ( $card ) {
	return 'Booth Sales' !== $card['title'];
} ) );

get_header();

get_template_part( 'template-parts/sections/hero', null, $hero );

get_template_part( 'template-parts/sections/coming-soon', null, array(
	'eyebrow' => 'Coming soon',
	'heading' => 'Own Your Own Photo Booth',
	'copy'    => array(
		'We&rsquo;re getting ready to offer the professional photo booths our team runs at events for sale, with full setup and ongoing support included. Booth options and pricing are being finalised now.',
		'Get in touch to register your interest and we&rsquo;ll let you know as soon as Booth Sales launches. In the meantime, every OMG Studio booth is available to hire for your next event.',
	),
	'points'  => array(
		array( 'title' => 'Event-Proven Booths', 'text' => 'The same professional booths OMG Studio brings to weddings, corporate events and parties.' ),
		array( 'title' => 'Full Setup Included', 'text' => 'We set your booth up and walk you through it, so you&rsquo;re ready from your very first event.' ),
		array( 'title' => 'Ongoing Support', 'text' => 'Our team stays on hand after the sale whenever you need help or advice.' ),
	),
	'back'    => array( 'url' => home_url( '/omg-studio/' ), 'label' => 'Back to OMG Studio' ),
) );

// Common sections, in the /omg-studio/ order (service-landing.php): Our
// Products, Other Services, Why Choose, logo grid, testimonials, CTA band.
get_template_part( 'template-parts/service-landing', null, array(
	'cards_heading'     => $studio['cards_heading'],
	'cards_intro'       => $studio['cards_intro'],
	'cards'             => $cards,
	'other_heading'     => $studio['other_heading'],
	'other_description' => $studio['other_description'],
	'other'             => $studio['other'],
	'why'               => $studio['why'],
	'marquee'           => $studio['marquee'],
	'testimonials'      => $studio['testimonials'],
	'cta'               => $studio['cta'],
) );

get_footer();
