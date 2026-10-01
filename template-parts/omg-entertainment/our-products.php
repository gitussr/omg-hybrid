<?php
/**
 * OMG Entertainment — "Our Products" framed card grid.
 *
 * Single source for the product cards. Rendered by:
 *   - below-hero-2.php (the /omg-entertainment/ landing) — all four cards
 *   - template-{casino-fun-nights,poker-tournaments,horse-racing-fun-nights}.php
 *     below "Perfect For Every Occasion" (client task-009, 2026-10-01),
 *     each one dropping its own card so three remain. Legacy-layer styles
 *     for those pages are at the end of legacy-styles.css.
 *
 * $args:
 *   exclude  string[]  card keys to leave out: 'casino' | 'horse-racing' |
 *                      'poker' | 'race-n-roll'. Keys, not URLs — Race 'n'
 *                      Roll shares the horse racing URL but is its own product.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$exclude = (array) ( $args['exclude'] ?? array() );
$icon    = OMG_HYBRID_URI . '/assets/images';

$cards = array(
	'casino'       => array(
		'icon'        => $icon . '/poker-cards-1.png',
		'title'       => 'Play-for-Fun Casino Parties',
		'description' => 'All the excitement and glamour of a real casino, with no risk or expense to your guests.',
		'url'         => home_url( '/casino-fun-nights/' ),
		'link_label'  => 'VISIT US',
	),
	'horse-racing' => array(
		'icon'        => $icon . '/horse-racing-1.png',
		'title'       => 'Horse Racing Fun Nights',
		'description' => 'Bring the Melbourne Cup to your function and celebrate in style with a night @ the races.',
		'url'         => home_url( '/horse-racing-fun-nights/' ),
		'link_label'  => 'VISIT US',
	),
	'poker'        => array(
		'icon'        => $icon . '/poker-chip-1.png',
		'title'       => 'Poker Fun Nights',
		'description' => 'Everybody loves poker &mdash; raise money for a club, or celebrate a birthday, with an OMG tournament.',
		'url'         => home_url( '/poker-tournaments/' ),
		'link_label'  => 'VISIT US',
	),
	'race-n-roll'  => array(
		'icon'        => $icon . '/dice.png',
		'title'       => 'Race &rsquo;n&rsquo; Roll Fun Nights',
		'description' => 'Roll the dice, back your horse and cheer it home &mdash; fast-paced race-day fun where every guest has a runner in the field.',
		'url'         => home_url( '/horse-racing-fun-nights/' ),
		'link_label'  => 'VISIT US',
	),
	/*
	 * DORMANT (client 2026-09-25): Showgirls, Magicians and Elvis & MJ cards
	 * hidden from the landing-page grid. Kept here intact — move them back
	 * above this comment to restore.
	 *
	'showgirls'    => array(
		'icon'        => $icon . '/pole-dancing.png',
		'title'       => 'Showgirls',
		'description' => 'Polished showtime energy for any event, from a glamorous welcome to a full choreographed floor show.',
		'url'         => home_url( '/showgirls/' ),
		'link_label'  => 'VISIT US',
	),
	'magicians'    => array(
		'icon'        => $icon . '/hat.png',
		'title'       => 'Magicians',
		'description' => 'Jaw-dropping close-up magic and a polished stage show that gets every guest talking.',
		'url'         => home_url( '/magicians/' ),
		'link_label'  => 'VISIT US',
	),
	'elvis-mj'     => array(
		'icon'        => $icon . '/videography-512.png',
		'title'       => 'Elvis &amp; MJ Impersonators',
		'description' => 'Two of the world&rsquo;s most iconic performers, brought to life for your event.',
		'url'         => home_url( '/elvis-mj-impersonators/' ),
		'link_label'  => 'VISIT US',
	),
	*/
);

get_template_part( 'template-parts/sections/service-cards', null, array(
	'heading' => 'Our Products',
	'intro'   => 'Spin the wheel, cheer home a winner, play the final hand or roll the dice in Race \'n\' Roll. Every experience is built to get guests playing. Explore below and book yours today.',
	'cards'   => array_values( array_diff_key( $cards, array_flip( $exclude ) ) ),
	'variant' => 'framed',
) );
