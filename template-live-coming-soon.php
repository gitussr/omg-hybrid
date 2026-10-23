<?php
/**
 * Template Name: OMG LiVE — Coming Soon
 *
 * Coming-soon pages for the OMG LiVE sub-services that have no page yet
 * (client 2026-10-15): /omg-live/karaoke-jukebox/ and
 * /omg-live/entertainers-performers/ (the mega-menu items were "#").
 * Follows /omg-live/our-services/ (template-live-services.php): the same
 * LiVE banner slides, Other Services, logo grid, testimonials and CTA
 * band, with the shared Coming Soon intro in place of the service rows.
 *
 * Purple palette via omg_hybrid_brand_inner_templates() (inc/services.php).
 * The /our-services/ page's own button and banner colours (page-id-955
 * rules in shell.css / app.css) also list this template's body class,
 * page-template-template-live-coming-soon. Copy per page is keyed by slug
 * below; an unknown slug gets the generic Coming Soon copy.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$slug = get_post_field( 'post_name', get_queried_object_id() );

$cs_pages = array(
	'karaoke-jukebox'         => array(
		'title'       => 'Karaoke &amp; Jukebox',
		'description' => 'Grab the mic or pick the next track &mdash; karaoke and jukebox hire from OMG LiVE. Coming soon.',
		'heading'     => 'Welcome to <strong>OMG</strong> Karaoke &amp; Jukebox',
		'copy'        => array(
			'We&rsquo;re putting together karaoke and jukebox hire so your guests can take the stage or choose what plays next. Song libraries, equipment and packages are being finalised now.',
			'Get in touch to register your interest and we&rsquo;ll let you know as soon as it launches. In the meantime, our DJs, event lighting and live bands are ready to book for your next event.',
		),
		'points'      => array(
			array( 'title' => 'Sing-Along Ready', 'text' => 'Lyrics on screen and microphones in hand, so any guest can step up and own the room.' ),
			array( 'title' => 'Guests Pick the Music', 'text' => 'A jukebox that lets the crowd choose the next track and keeps the dance floor full.' ),
			array( 'title' => 'Pairs With Our DJs', 'text' => 'Add it to a DJ, lighting or live band booking and one team looks after the lot.' ),
		),
	),
	'entertainers-performers' => array(
		'title'       => 'Entertainers &amp; Performers',
		'description' => 'Showstopping entertainers and performers for every kind of event, from OMG LiVE. Coming soon.',
		'heading'     => 'Welcome to <strong>OMG</strong> Entertainers &amp; Performers',
		'copy'        => array(
			'We&rsquo;re lining up entertainers and performers to bring something extra to your event, from roving acts that work the crowd to feature performances that stop the room. Acts and packages are being finalised now.',
			'Get in touch to register your interest and we&rsquo;ll let you know as soon as it launches. In the meantime, our DJs, event lighting and live bands are ready to book for your next event.',
		),
		'points'      => array(
			array( 'title' => 'Showstopping Acts', 'text' => 'Performers who turn a good night into the moment your guests keep talking about.' ),
			array( 'title' => 'Matched to Your Crowd', 'text' => 'From corporate functions to private parties, we&rsquo;ll suggest acts that suit your guests and venue.' ),
			array( 'title' => 'One Point of Contact', 'text' => 'Book your performers alongside DJs, lighting and live bands with one team.' ),
		),
	),
);

$cs_page = $cs_pages[ $slug ] ?? array();
$live = omg_hybrid_brand_services( 'live' );

// Banner: the /omg-live/our-services/ slides with this page's own copy.
$hero = $live['hero'];
if ( $cs_page ) {
	$hero['title']       = $cs_page['title'];
	$hero['description'] = $cs_page['description'];
}
$hero['cta'] = array( 'url' => home_url( '/contact/' ), 'label' => 'Register Your Interest' );

get_header();

get_template_part( 'template-parts/sections/hero', null, $hero );

$intro = array(
	'eyebrow' => 'Coming soon',
	'back'    => array( 'url' => home_url( '/omg-live/' ), 'label' => 'Back to OMG LiVE' ),
);
if ( $cs_page ) {
	$intro['heading'] = $cs_page['heading'];
	$intro['copy']    = $cs_page['copy'];
	$intro['points']  = $cs_page['points'];
}
get_template_part( 'template-parts/sections/coming-soon', null, $intro );

// Common sections, in the /omg-live/our-services/ order.
get_template_part( 'template-parts/omg-entertainment/home-divisions', null, array(
	'heading'     => 'Other Services',
	'description' => 'Why stop there? Take your event to the next level with our full suite of event services &mdash; from high-energy DJs and live music to booths, photography and full styling, all under one roof.',
) );

$uploads = home_url( '/wp-content/uploads' );
$logos   = array();
for ( $i = 1; $i <= 22; $i++ ) {
	$logos[] = $uploads . '/2026/04/logo-' . $i . '.jpg';
}
get_template_part( 'template-parts/sections/marquee', null, array(
	'title' => 'The Best BRANDS CHOOSE THE BEST BRAND',
	'logos' => $logos,
) );

get_template_part( 'template-parts/sections/testimonials', null, omg_hybrid_brand_testimonials( 'live' ) );

if ( ! empty( $live['cta'] ) ) {
	get_template_part( 'template-parts/sections/cta', null, $live['cta'] );
}

get_footer();
