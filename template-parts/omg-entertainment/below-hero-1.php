<?php
/**
 * OMG Entertainment — MODULAR SECTION 1 (directly below the hero).
 *
 * "Welcome to OMG Entertainment" intro, rendered through the shared
 * template-parts/sections/welcome.php component.
 *
 * DORMANT ON THE HOME PAGE (instruction 2026-09-01): this section renders
 * only on the inner /omg-entertainment/ landing page. The home page
 * ($args['context'] === 'home') skips it.
 *
 * $args: context ('home' | 'landing')
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

if ( ( $args['context'] ?? 'home' ) !== 'landing' ) {
	return;
}

get_template_part( 'template-parts/sections/welcome', null, array(
	'heading'    => 'Welcome to OMG EVENTS & ENTERTAINMENT',
	'heading_logo' => array( 'url' => OMG_HYBRID_URI . '/assets/images/oos-logo-entertainment-lg.png', 'alt' => 'OMG Entertainment' ),
	'paragraphs' => array(
		'Planning an event should be exciting, not overwhelming. <strong>OMG Entertainment</strong> delivers five-star entertainment that turns any function into the night of the year. We run the show from the first
call to the final pack-down, so you can enjoy it with your guests.',
		'Spin the wheel at a <strong>Play-For-Fun Casino Party</strong>, cheer home a winner at a <strong>Horse Racing Night</strong>, go all in at a <strong>Poker Tournament</strong> or chase the finish line at a <strong>Race \'n\' Roll Fun Night</strong>. We bring the tables, the crew and the buzz to corporate functions, charity fundraisers and private parties.',
		'One team. One point of contact. One unforgettable five-star event.',
	),
	'buttons'    => omg_hybrid_cta_buttons(),
	'image'      => OMG_HYBRID_URI . '/assets/images/floating-cards-chips.png',
	'image_alt'  => 'Casino chips and playing cards',
	// Spinning "OMG ENTERTAINMENT" circular-text badge on the image's
	// bottom-right corner (client 2026-09-14) — DORMANT since 2026-09-17.
	// `decor => true` keeps the oversized break-out figure; restore the
	// badge by swapping the line below back for the array form:
	// 'decor'      => array(
	// 	'badge' => OMG_HYBRID_URI . '/assets/images/circular-text-entertainment.png',
	// ),
	'decor'      => true,
) );
