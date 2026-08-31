<?php
/**
 * Shared OMG Entertainment layout.
 *
 * Rendered by BOTH:
 *   - front-page.php                  ($args['context'] = 'home')
 *   - template-omg-entertainment.php  ($args['context'] = 'landing')
 *
 * For the current phase the two contexts render IDENTICALLY (master brief
 * §3). The only planned future difference is the two sections directly
 * below the hero — kept here as their own, independently addressable
 * get_template_part() calls so later instructions can change their
 * content / visibility / order without duplicating the page. Do NOT
 * invent the differences yet.
 *
 * PHASE 2 NOTE: the content below is placeholder sample content wired to
 * theme assets, so the layout is testable. Phase 3 replaces it with the
 * real OMG Entertainment content (static).
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$context = ( $args['context'] ?? 'home' ) === 'landing' ? 'landing' : 'home';
$img     = OMG_HYBRID_URI . '/assets/images/';

get_template_part( 'template-parts/sections/hero', null, array(
	'variant'     => 'home',
	'eyebrow'     => 'OMG Entertainment',
	'title'       => 'The Entertainment People Talk About For Weeks',
	'description' => 'Casino nights, race days, poker tables and showstopping performers — the entertainment that turns any event into the one everyone remembers.',
	'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Free Quote' ),
	'slides'      => array(
		array( 'type' => 'image', 'url' => $img . 'hero-bg-3.jpg' ),
		array( 'type' => 'image', 'url' => $img . 'hero-bg-1.jpg' ),
	),
) );

/* ==================================================================
 * MODULAR SECTION 1 — directly below the hero.
 * Home vs. inner-landing will eventually differ here. Identical for now.
 * ================================================================== */
get_template_part( 'template-parts/omg-entertainment/below-hero-1', null, array( 'context' => $context ) );

/* ==================================================================
 * MODULAR SECTION 2 — directly below the hero.
 * Home vs. inner-landing will eventually differ here. Identical for now.
 * ================================================================== */
get_template_part( 'template-parts/omg-entertainment/below-hero-2', null, array( 'context' => $context ) );

/* ---- Shared sections (identical in both contexts) ---- */

get_template_part( 'template-parts/sections/service-rows', null, array(
	'heading' => 'Our Entertainment Services',
	'rows'    => array(
		array(
			'id'         => 'casino-fun-nights',
			'ribbon'     => 'From $999',
			'title'      => 'Casino Fun Nights',
			'paragraph'  => 'Full-sized professional casino tables and entertainment-skilled croupiers, straight to your venue. Guests play for fun on unlimited chips — zero real-money risk.',
			'bullets'    => array( 'Blackjack, Roulette, Poker, Craps & the Money Wheel', 'Croupiers with 100+ years combined experience', 'Optional awards ceremony for your top players' ),
			'image'      => $img . 'our-booth-img-1.jpg',
			'link_url'   => '#casino-fun-nights',
			'link_label' => 'Explore Casino Fun Nights',
		),
		array(
			'id'        => 'horse-racing-fun-nights',
			'ribbon'    => 'From $1,650',
			'title'     => 'Horse Racing Fun Nights',
			'paragraph' => 'Race-day atmosphere brought straight to your event — live race simulations, a professional MC and your very own bookies.',
			'bullets'   => array( 'Live race simulations with an MC race caller', 'Your own bookies with funny-money betting slips', 'Optional best-dressed & King/Queen of the Track awards' ),
			'image'     => $img . 'our-booth-img-2.jpg',
			'reverse'   => true,
		),
		array(
			'id'        => 'poker-tournaments',
			'ribbon'    => 'From $999',
			'title'     => 'Poker Tournaments',
			'paragraph' => 'From a casual social game to a full-scale professional tournament — we bring the tables, the cards and the atmosphere.',
			'bullets'   => array( 'Texas Hold’Em plus Omaha, 7 Card Stud & HORSE on request', 'No limits on time or player numbers', 'Professional dealers on every table' ),
			'image'     => $img . 'our-booth-img-3.jpg',
		),
	),
) );

get_template_part( 'template-parts/sections/why-choose', null, array(
	'heading' => 'Why Choose OMG Entertainment?',
	'bullets' => array(
		'Full-sized, Australian-made casino equipment',
		'Entertainment-skilled, experienced croupiers',
		'Transparent, what-you-see-is-what-you-get pricing',
		'Fully customisable game selection',
		'Add-on props, DJ, photo booth & performers available',
		'Trusted across Sydney, Brisbane, Adelaide, Perth & regional Australia',
	),
	'body'    => 'Let OMG Entertainment turn your next event into an unforgettable night.',
	'buttons' => array(
		array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Quote' ),
		array( 'url' => home_url( '/contact/' ), 'label' => 'Book an Event' ),
	),
) );

get_template_part( 'template-parts/sections/testimonials', null, array(
	'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
	'items'       => array(
		array( 'quote' => 'Everyone had such a great time, and all of your staff made everything so easy. We really appreciate all of your hard work.', 'cite' => '— Lara C., Sydney NSW' ),
		array( 'quote' => 'They were great to deal with all the way. We had the casino tables package for a bucks night and the boys had a great time.', 'cite' => '— Veronica P., Leumeah NSW' ),
		array( 'quote' => 'I wish I could give 6 stars! Everyone had a great time and the party went off without a hitch. Would recommend to anyone in a heartbeat!', 'cite' => '— Danielle G., Cabarita NSW' ),
	),
) );

get_template_part( 'template-parts/sections/other-services', null, array(
	'heading' => 'Explore The Rest Of The OMG Group',
	'cards'   => array(
		array( 'image' => $img . 'oos-img-1.png', 'logo' => $img . 'oos-logo-1.png', 'title' => 'OMG Studio', 'description' => 'Photo booths, video booths, photography & videography.', 'url' => home_url( '/omg-studio/' ) ),
		array( 'image' => $img . 'oos-img-2.png', 'logo' => $img . 'oos-logo-2.png', 'title' => 'OMG LiVE', 'description' => 'Elite DJs, atmospheric lighting and unforgettable live bands.', 'url' => home_url( '/omg-live/' ) ),
		array( 'image' => $img . 'oos-img-3.png', 'logo' => $img . 'oos-logo-3.png', 'title' => 'OMG Props & Theming', 'description' => 'Casino props, grand entrances, theme walls, furniture & AV.', 'url' => home_url( '/omg-props-theming/' ) ),
	),
) );

get_template_part( 'template-parts/sections/cta', null, array(
	'title'    => 'Ready To Book Your Entertainment?',
	'subtitle' => 'From casino nights to legendary tribute performances — get in touch for a free, no-obligation quote.',
) );

get_template_part( 'template-parts/sections/marquee', null, array(
	'title' => 'Trusted By',
	'logos' => array(
		$img . 'marque-logo1.jpg', $img . 'marque-logo2.jpg', $img . 'marque-logo3.jpg',
		$img . 'marque-logo4.jpg', $img . 'marque-logo5.jpg', $img . 'marque-logo6.jpg',
	),
) );
