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
	'heading'    => 'Welcome to OMG Entertainment',
	'paragraphs' => array(
		'Planning an event should be exciting, not overwhelming. At OMG Entertainment, we provide professionally managed entertainment experiences designed to engage guests, encourage interaction and create memorable moments.',
		'Casino nights, race days, poker tables, showgirls, magicians and legendary tribute acts &mdash; one team, one point of contact, one unforgettable event.',
	),
	'buttons'    => omg_hybrid_cta_buttons(),
	'image'      => OMG_HYBRID_URI . '/assets/images/floating-cards-chips.png',
	'image_alt'  => 'Casino chips and playing cards',
) );
