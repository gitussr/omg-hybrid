<?php
/**
 * OMG Entertainment — MODULAR SECTION 2 (directly below the hero).
 *
 * The "Our Services" overview card grid. Content mirrors the existing
 * home page's service cards, kept static per the approved plan.
 *
 * The home page and the inner "Our Services → OMG Entertainment" landing
 * page will eventually differ here. For now BOTH render this identically.
 * Do not branch on $args['context'] until the divergence instructions
 * are provided.
 *
 * $args: context ('home' | 'landing')
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$icon = OMG_HYBRID_URI . '/assets/images';

get_template_part( 'template-parts/sections/service-cards', null, array(
	'heading' => 'Our Services',
	'intro'   => 'Six ways to bring the entertainment &mdash; mix and match to build the night your guests will still be talking about.',
	'cards'   => array(
		array(
			'icon'        => $icon . '/poker-cards-1.png',
			'title'       => 'Play-for-Fun Casino Parties',
			'description' => 'All the excitement and glamour of a real casino, with no risk or expense to your guests.',
			'url'         => '#casino-fun-nights',
			'link_label'  => 'View',
		),
		array(
			'icon'        => $icon . '/horse-racing-1.png',
			'title'       => 'Horse Racing Fun Nights',
			'description' => 'Bring the Melbourne Cup to your function and celebrate in style with a night @ the races.',
			'url'         => '#horse-racing-fun-nights',
			'link_label'  => 'View',
		),
		array(
			'icon'        => $icon . '/poker-chip-1.png',
			'title'       => 'Poker Fun Nights',
			'description' => 'Everybody loves poker &mdash; raise money for a club, or celebrate a birthday, with an OMG tournament.',
			'url'         => '#poker-tournaments',
			'link_label'  => 'View',
		),
		array(
			'icon'        => $icon . '/pole-dancing.png',
			'title'       => 'Showgirls',
			'description' => 'Polished showtime energy for any event, from a glamorous welcome to a full choreographed floor show.',
			'url'         => '#showgirls',
			'link_label'  => 'View',
		),
		array(
			'icon'        => $icon . '/hat.png',
			'title'       => 'Magicians',
			'description' => 'Jaw-dropping close-up magic and a polished stage show that gets every guest talking.',
			'url'         => '#magicians',
			'link_label'  => 'View',
		),
		array(
			'icon'        => $icon . '/videography-512.png',
			'title'       => 'Elvis &amp; MJ Impersonators',
			'description' => 'Two of the world&rsquo;s most iconic performers, brought to life for your event.',
			'url'         => '#elvis-mj-impersonators',
			'link_label'  => 'View',
		),
	),
) );
