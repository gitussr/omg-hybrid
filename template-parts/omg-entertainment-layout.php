<?php
/**
 * Shared OMG Entertainment layout.
 *
 * Rendered by BOTH:
 *   - front-page.php                  ($args['context'] = 'home')
 *   - template-omg-entertainment.php  ($args['context'] = 'landing')
 *
 * The two contexts render IDENTICALLY for the current phase (master brief
 * §3). The only planned future difference is the two sections directly
 * below the hero — kept here as their own, independently addressable
 * get_template_part() calls (template-parts/omg-entertainment/below-hero-*)
 * so later instructions can change their content / visibility / order
 * without duplicating the page. Do NOT invent the differences yet.
 *
 * Content is static (approved plan). Copy and media are drawn from the
 * existing OMG Entertainment site.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$context = ( $args['context'] ?? 'home' ) === 'landing' ? 'landing' : 'home';
$img     = OMG_HYBRID_URI . '/assets/images/';
$video   = OMG_HYBRID_URI . '/assets/hero.mp4';
$uploads = home_url( '/wp-content/uploads' );

get_template_part( 'template-parts/sections/hero', null, array(
	'variant'     => 'home',
	'eyebrow'     => 'OMG Entertainment',
	'title'       => 'Creating Unforgettable Event Experiences Across Australia',
	'description' => 'Casino nights, race days, poker tables and showstopping performers &mdash; the entertainment that turns any event into the one people are still talking about.',
	'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Free Quote' ),
	'slides'      => array(
		array( 'type' => 'video', 'url' => $video, 'poster' => $img . 'omg-entertainment-banner1.jpg' ),
		array( 'type' => 'image', 'url' => $img . 'omg-entertainment-banner1.jpg' ),
	),
) );

/* ==================================================================
 * MODULAR SECTION 1 — directly below the hero (home vs inner-landing
 * will eventually differ; identical for now).
 * ================================================================== */
get_template_part( 'template-parts/omg-entertainment/below-hero-1', null, array( 'context' => $context ) );

/* ==================================================================
 * MODULAR SECTION 2 — directly below the hero (home vs inner-landing
 * will eventually differ; identical for now).
 * ================================================================== */
get_template_part( 'template-parts/omg-entertainment/below-hero-2', null, array( 'context' => $context ) );

/* ---- Shared sections (identical in both contexts) ---- */

get_template_part( 'template-parts/sections/service-rows', null, array(
	'rows' => array(
		array(
			'id'         => 'casino-fun-nights',
			'ribbon'     => 'From $999',
			'title'      => 'Casino Fun Nights',
			'paragraph'  => 'Full-sized, professional casino tables and entertainment-skilled croupiers, straight to your venue. Blackjack, Roulette, Poker, Craps and the Money Wheel run on premium Australian-made equipment, with guests playing for fun on unlimited chips &mdash; zero real-money risk.',
			'bullets'    => array(
				'Full-sized tables: Blackjack, Roulette, Poker, Baccarat, Craps, Sic Bo &amp; Money Wheel',
				'Entertainment-skilled croupiers with 100+ years of combined experience',
				'Optional awards ceremony to crown your top players',
			),
			'image'      => $img . 'omg-entertainment-banner1.jpg',
			'image_alt'  => 'Guests celebrating at an OMG Entertainment casino night',
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Enquire About Casino Fun Nights',
		),
		array(
			'id'        => 'horse-racing-fun-nights',
			'ribbon'    => 'From $1,650',
			'title'     => 'Horse Racing Fun Nights',
			'paragraph' => 'Skip the racecourse and bring race-day atmosphere straight to your event. Live race simulations, a professional MC and your very own bookies make for a fully customisable, dress-up-friendly experience for guests of every age.',
			'bullets'   => array(
				'Live race simulations with a professional MC race caller',
				'Your own "bookies" with funny-money betting slips &amp; payouts',
				'Optional best-dressed &amp; King/Queen of the Track awards',
			),
			'image'     => $img . 'omg-studio-golden-bg-2.jpg',
			'image_alt' => 'Gold sparkle backdrop styled for an OMG Entertainment race night',
			'reverse'   => true,
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Enquire About Race Nights',
		),
		array(
			'id'        => 'poker-tournaments',
			'ribbon'    => 'From $999',
			'title'     => 'Poker Tournaments',
			'paragraph' => 'Check, raise or fold &mdash; from a casual social game to a full-scale professional tournament, we bring the tables, the cards and the atmosphere. Texas Hold&rsquo;Em is our signature game, with Omaha, 7 Card Stud and HORSE available on request.',
			'bullets'   => array(
				'Texas Hold&rsquo;Em plus Omaha, 7 Card Stud &amp; HORSE on request',
				'No limits on time or player numbers',
				'Professional dealers keep every table running smoothly',
			),
			'image'     => $img . 'events.jpg',
			'image_alt' => 'OMG Entertainment poker table with chips and cards',
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Enquire About Poker Tournaments',
		),
		array(
			'id'        => 'showgirls',
			'ribbon'    => 'Showtime Glamour',
			'title'     => 'Showgirls',
			'paragraph' => 'A polished, professional showtime energy for any event &mdash; from a glamorous guest welcome to a full choreographed floor show. Costuming and routines are tailored to your venue, theme and audience.',
			'bullets'   => array(
				'Professional, rehearsed choreography',
				'Dazzling costuming suited to your event&rsquo;s theme',
				'Pairs seamlessly with our Casino Fun Nights',
			),
			'image'     => $img . 'omg-studio-golden-bg-3.jpg',
			'image_alt' => 'Glamorous performers at an OMG Entertainment event',
			'reverse'   => true,
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Enquire About Showgirls',
		),
		array(
			'id'        => 'magicians',
			'ribbon'    => 'From $880',
			'title'     => 'Magicians',
			'paragraph' => 'Light-hearted, jaw-dropping magic that gets every guest talking &mdash; from table-to-table close-up tricks to a polished 30-minute stage show. Family-friendly and built around genuine guest interaction.',
			'bullets'   => array(
				'Roving close-up magic, perfect for mingling events',
				'A 30-minute magic stage show for the whole room',
				'Flexible booking, from one hour to a full evening',
			),
			'image'     => $img . 'omg-studio-golden-bg.jpg',
			'image_alt' => 'Gold sparkle backdrop styled for an OMG Entertainment magic show',
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Enquire About Magicians',
		),
		array(
			'id'        => 'elvis-mj-impersonators',
			'ribbon'    => 'Legendary Tributes',
			'title'     => 'Elvis &amp; MJ Impersonators',
			'paragraph' => 'Two of the world&rsquo;s most iconic performers, brought to life for your event. Our Elvis and Michael Jackson tribute performers deliver showstopping vocals, unmistakable costuming and choreography, tailored to your run sheet.',
			'bullets'   => array(
				'The Elvis Experience &mdash; classic costuming &amp; unmistakable vocals',
				'The Michael Jackson Experience &mdash; iconic choreography',
				'Sing-along &amp; interactive moments that get guests on the floor',
			),
			'image'     => $img . 'roaming-photography.jpg',
			'image_alt' => 'Tribute performer greeting a guest at an OMG Entertainment event',
			'reverse'   => true,
			'link_url'   => home_url( '/contact/' ),
			'link_label' => 'Enquire About Tribute Acts',
		),
	),
) );

get_template_part( 'template-parts/sections/why-choose', null, array(
	'heading' => 'Why Choose OMG Entertainment?',
	'bullets' => array(
		'Full-sized, Australian-made casino equipment',
		'Entertainment-skilled, experienced croupiers',
		'Transparent, what-you-see-is-what-you-get pricing',
		'Fully customisable game &amp; performer selection',
		'Add-on props, DJ, photo booth &amp; performers available',
		'Trusted across Sydney, Brisbane, Adelaide, Perth &amp; regional Australia',
	),
	'body'    => 'Let OMG Entertainment turn your next event into an unforgettable night.',
	'buttons' => array(
		array( 'url' => 'tel:1300300664', 'label' => 'Call Us' ),
		array( 'url' => home_url( '/contact/' ), 'label' => 'Book an Event' ),
		array( 'url' => 'mailto:info@OMGgroup.com.au', 'label' => 'Email Us' ),
	),
) );

get_template_part( 'template-parts/sections/testimonials', null, array(
	'emblem_text' => 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ',
	'items'       => array(
		array( 'quote' => 'We hired the OMG group for our corporate Christmas party and let me tell you &mdash; everyone had the best night!', 'cite' => '&mdash; Elisa Chinnabootr' ),
		array( 'quote' => 'Thank you for coming to my husband&rsquo;s 40th casino party. Pablo and the girls were fantastic and very entertaining, explaining everything to new punters. It was lots of fun and got everyone involved.', 'cite' => '&mdash; Jess S., Cobbitty NSW' ),
		array( 'quote' => 'I wish I could give 6 stars! Everyone had a great time and the party went off without a hitch. Our croupiers were friendly, knowledgeable and made sure even the inexperienced players had a great time.', 'cite' => '&mdash; Danielle G., Cabarita NSW' ),
		array( 'quote' => 'They were great to deal with all the way. We had the casino tables package for a bucks night and the boys had a great time &mdash; the staff were amazing on the night.', 'cite' => '&mdash; Veronica P., Leumeah NSW' ),
		array( 'quote' => 'We hired OMG group for our mid-year office party and their service and quality was excellent.', 'cite' => '&mdash; Aarti Mehra' ),
	),
) );

get_template_part( 'template-parts/sections/other-services', null, array(
	'heading'     => 'Other Services',
	'description' => 'Why stop there? Take your event to the next level with our full suite of event services &mdash; from high-energy DJs and live music to booths, photography and full styling, all under one roof.',
	'cards'       => array(
		array(
			'image'       => $img . 'omg-studio-display.jpg',
			'logo'        => $img . 'oos-logo-studio.jpg',
			'title'       => 'OMG Studio',
			'description' => 'Photo booths, video booths, photography and videography &mdash; every moment of your event, captured.',
			'url'         => home_url( '/omg-studio/' ),
			'link_label'  => 'Visit OMG Studio',
		),
		array(
			'image'       => $img . 'omg-live-hero.jpg',
			'logo'        => $img . 'oos-logo-2.png',
			'title'       => 'OMG LiVE',
			'description' => 'High-energy DJs, expert lighting and professional live music for an immersive, engaging event.',
			'url'         => home_url( '/omg-live/' ),
			'link_label'  => 'Visit OMG LiVE',
		),
		array(
			'image'       => $img . 'props-custom-new.jpg',
			'logo'        => $img . 'oos-logo-3.png',
			'title'       => 'OMG Props &amp; Theming',
			'description' => 'Casino props, light-up letters and theme walls, plus table, chair and decoration hire.',
			'url'         => home_url( '/omg-props-theming/' ),
			'link_label'  => 'Visit OMG Props &amp; Theming',
		),
	),
) );

get_template_part( 'template-parts/sections/cta', null, array(
	'title'    => 'Ready To Book Your Entertainment?',
	'subtitle' => 'From casino nights to legendary tribute performances &mdash; get in touch for a free, no-obligation quote.',
) );

get_template_part( 'template-parts/sections/marquee', null, array(
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
) );
