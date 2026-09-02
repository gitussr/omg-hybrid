<?php
/**
 * OMG Entertainment — MODULAR SECTION 2 (directly below the hero).
 *
 * The "Our Services" overview. The home and inner-landing contexts now
 * diverge here (instruction 2026-09-01):
 *
 *   - home    → template-parts/omg-entertainment/home-divisions.php
 *               A full-bleed row of the four OMG Group divisions, each
 *               card themed in its own service palette.
 *   - landing → the six OMG Entertainment services, rendered through the
 *               shared service-cards component in its "framed" variant
 *               with "VISIT US" links that jump to each service row.
 *
 * $args: context ('home' | 'landing')
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

if ( ( $args['context'] ?? 'home' ) !== 'landing' ) {
	get_template_part( 'template-parts/omg-entertainment/home-divisions' );
	return;
}

$icon = OMG_HYBRID_URI . '/assets/images';

$cards = array(
	array(
		'icon'        => $icon . '/poker-cards-1.png',
		'title'       => 'Play-for-Fun Casino Parties',
		'description' => 'All the excitement and glamour of a real casino, with no risk or expense to your guests.',
		'url'         => home_url( '/omg-entertainment/our-services/#casino-fun-nights' ),
		'link_label'  => 'VISIT US',
	),
	array(
		'icon'        => $icon . '/horse-racing-1.png',
		'title'       => 'Horse Racing Fun Nights',
		'description' => 'Bring the Melbourne Cup to your function and celebrate in style with a night @ the races.',
		'url'         => home_url( '/omg-entertainment/our-services/#horse-racing-fun-nights' ),
		'link_label'  => 'VISIT US',
	),
	array(
		'icon'        => $icon . '/poker-chip-1.png',
		'title'       => 'Poker Fun Nights',
		'description' => 'Everybody loves poker &mdash; raise money for a club, or celebrate a birthday, with an OMG tournament.',
		'url'         => home_url( '/omg-entertainment/our-services/#poker-tournaments' ),
		'link_label'  => 'VISIT US',
	),
	array(
		'icon'        => $icon . '/pole-dancing.png',
		'title'       => 'Showgirls',
		'description' => 'Polished showtime energy for any event, from a glamorous welcome to a full choreographed floor show.',
		'url'         => home_url( '/omg-entertainment/our-services/#showgirls' ),
		'link_label'  => 'VISIT US',
	),
	array(
		'icon'        => $icon . '/hat.png',
		'title'       => 'Magicians',
		'description' => 'Jaw-dropping close-up magic and a polished stage show that gets every guest talking.',
		'url'         => home_url( '/omg-entertainment/our-services/#magicians' ),
		'link_label'  => 'VISIT US',
	),
	array(
		'icon'        => $icon . '/videography-512.png',
		'title'       => 'Elvis &amp; MJ Impersonators',
		'description' => 'Two of the world&rsquo;s most iconic performers, brought to life for your event.',
		'url'         => home_url( '/omg-entertainment/our-services/#elvis-mj-impersonators' ),
		'link_label'  => 'VISIT US',
	),
);

get_template_part( 'template-parts/sections/service-cards', null, array(
	'heading' => 'Our Services',
	'intro'   => 'Six ways to bring the entertainment &mdash; mix and match to build the night your guests will still be talking about.',
	'cards'   => $cards,
	'variant' => 'framed',
) );
