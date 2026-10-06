<?php
/**
 * Template Name: OMG Food & Beverage Page
 *
 * /omg-food-beverage/ (client task-019, 2026-10-06). Replaces the redirect
 * of every Food & Beverage link to /coming-soon/. Keeps the Coming Soon
 * page's own sections (hero + intro + logo grid) and adds the common
 * sections from /omg-entertainment/: Other Services, Why Choose, the logo
 * grid, Testimonials and the oh-cta band, in that order.
 *
 * Orange palette (#F28C1E, light shades for the page body) via the
 * svc-foodbeverage body class (inc/services.php).
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$img = OMG_HYBRID_URI . '/assets/images/';

get_header();

get_template_part( 'template-parts/sections/hero', null, array(
	'variant'     => 'home',
	'eyebrow'     => 'OMG Food & Beverage',
	'title'       => 'Coming Soon',
	'description' => 'Something new is on its way from the OMG family. Stay tuned.',
	'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Free Quote' ),
	'slides'      => array(
		array( 'type' => 'image', 'url' => $img . 'omg-entertainment-new-banner-01.jpg' ),
	),
) );

get_template_part( 'template-parts/sections/coming-soon' );

get_template_part( 'template-parts/sections/other-services', null, array(
	'heading'     => 'Other Services',
	'description' => 'Complete the night with the full OMG experience: casino tables, race nights and poker tournaments, photo booths and photography, DJs and live music, plus props and theming. It&rsquo;s everything your event needs, all under one roof.',
	'cards'       => array(
		array( 'image' => $img . 'omg-entertainment-banner1.jpg', 'logo' => $img . 'oos-logo-entertainment-lg.png', 'title' => 'OMG Entertainment', 'description' => 'Casino nights, race days, poker &amp; showstopping performers.', 'url' => home_url( '/omg-entertainment/' ) ),
		array( 'image' => $img . 'omg-studio-display.jpg', 'logo' => $img . 'oos-logo-studio-lg.png', 'title' => 'OMG Studio', 'description' => 'Photo booths, video booths, photography &amp; videography.', 'url' => home_url( '/omg-studio/' ) ),
		array( 'image' => $img . 'omg-live-hero.jpg', 'logo' => $img . 'oos-logo-live-lg.png', 'title' => 'OMG LiVE', 'description' => 'High-energy DJs, expert lighting and professional live music for an immersive, engaging event.', 'url' => home_url( '/omg-live/' ) ),
		array( 'image' => $img . 'props-custom-new.jpg', 'logo' => $img . 'oos-logo-props-lg.png', 'title' => 'OMG Props &amp; Theming', 'description' => 'Casino props, light-up letters and theme walls, plus table, chair and decoration hire.', 'url' => home_url( '/omg-props-theming/' ) ),
	),
) );

get_template_part( 'template-parts/sections/why-choose', null, array(
	'heading' => 'Why Choose OMG Food & Beverage?',
	'bullets' => array(
		'Catering shaped around your guests',
		'Fully equipped mobile bars',
		'Experienced bartenders &amp; mixologists',
		'Professional, presentable event staff',
		'Transparent pricing, no hidden costs',
		'Bundle with entertainment, booths, DJs &amp; theming',
	),
	'buttons' => array(
		array( 'url' => 'tel:1300300664', 'label' => 'Call Us' ),
		array( 'url' => home_url( '/contact/' ), 'label' => 'Book an Event' ),
		array( 'url' => 'mailto:info@OMGent.com.au', 'label' => 'Email Us' ),
	),
) );

get_template_part( 'template-parts/sections/marquee', null, array(
	'title'          => 'THE BEST BRANDS CHOOSE THE BEST BRAND',
	// 4-row logo slider on phones too, as on /coming-soon/ (task-016).
	'hide_on_mobile' => false,
) );

// Quotes live in inc/brand-services.php ('foodbeverage').
get_template_part( 'template-parts/sections/testimonials', null, omg_hybrid_brand_testimonials( 'foodbeverage' ) );

// CTA band — last section before the footer, as on /omg-entertainment/.
// The footer's own Call / Book / Email buttons are dormant on this page
// (footer.php).
get_template_part( 'template-parts/sections/cta', null, array(
	'title'    => 'Ready To Raise A Glass?',
	'subtitle' => 'Catering, mobile bars, bartenders and event staff.<br>Get a free, no-obligation quote today and be the first to hear when we launch.',
) );

get_footer();
