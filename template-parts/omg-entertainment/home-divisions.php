<?php
/**
 * Home page — "Our Services" OMG Group divisions overview.
 *
 * A full-bleed row of four brand cards (Entertainment / Studio / LiVE /
 * Props & Theming). Each card carries its own .svc-* palette class so
 * var(--color-*) resolves to that division's colour theme (red / cyan /
 * purple / yellow). Rendered only on the home page via
 * front-page.php → omg-entertainment-layout → below-hero-2.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$img = OMG_HYBRID_URI . '/assets/images/';

$heading     = $args['heading'] ?? 'Our Services';
$is_other = isset( $args['heading'] );
// Home-page default only (not the "Other Services" reuse on the 7 inner
// pages): an extra "Welcome to..." heading + paragraph above "Our
// Services" (client 2026-10-07).
$welcome_heading = 'WELCOME TO <strong>OMG</strong><br class="oh-section-title__mobile-break"> EVENT &amp; ENTERTAINMENT';
$welcome_para    = 'Planning a great event can feel like a gamble. You want your guests to have a winning experience, but the logistics often get in the way of the fun. OMG Event &amp; Entertainment provides the expertise and services you need to host a flawless celebration. We handle the heavy lifting so you can focus on your guests.';
$description = $args['description'] ?? array(
	'Our centralized booking system manages every request across our various divisions. You do not have to chase different contractors because we operate as a single, efficient hub for all your event needs.',
);
$description = (array) $description;

$divisions = array(
	array(
		'svc'         => 'svc-entertainment',
		'logo'        => $img . 'oos-logo-entertainment-lg.png',
		'name'        => 'OMG Entertainment',
		'title'       => 'Event &amp; Entertainment',
		'description' => omg_hybrid_division_blurb( 'entertainment' ),
		'url'         => home_url( '/omg-entertainment/' ),
	),
	array(
		'svc'         => 'svc-studio',
		'logo'        => $img . 'oos-logo-studio-lg.png',
		'name'        => 'OMG Studio',
		'title'       => 'Photobooths &amp; Photography',
		'description' => omg_hybrid_division_blurb( 'studio' ),
		'url'         => home_url( '/omg-studio/' ),
	),
	array(
		'svc'         => 'svc-live',
		'logo'        => $img . 'oos-logo-live-lg.png',
		'name'        => 'OMG LiVE',
		'title'       => 'DJ &ndash; Music &ndash; Lights',
		'description' => omg_hybrid_division_blurb( 'live' ),
		'url'         => home_url( '/omg-live/' ),
	),
	array(
		'svc'         => 'svc-props',
		'logo'        => $img . 'oos-logo-props-lg.png',
		'name'        => 'OMG Props &amp; Theming',
		'title'       => 'Props &amp; Theming',
		'description' => omg_hybrid_division_blurb( 'props' ),
		'url'         => home_url( '/omg-props-theming/' ),
	),
	array(
		'svc'         => 'svc-foodbeverage',
		/*
		 * Six client-supplied F&B wordmarks exist; the right one
		 * depends entirely on what it sits on:
		 *
		 *   oos-logo-fnb-2026c.png — BLACK OMG over a title-case
		 *     "Food & Beverage" (client 2026-09-25, third supply).
		 *     Current choice on every F&B card.
		 *   oos-logo-fnb-2026b.png — same OMG over an all-caps
		 *     "FOOD & BEVERAGE" (2026-09-24); superseded.
		 *   oos-logo-fnb-2026.png — same artwork, lighter subline;
		 *     superseded the same day.
		 *   oos-logo-fnb-on-light.png — earlier solid BLACK wordmark
		 *     (client 2026-09-22), superseded by the one above.
		 *   oos-logo-fnb-lg.png — gold/cream artwork. Reads softly on a
		 *     near-white tint (~2:1), so it lost this slot.
		 *   oos-logo-fnb-on-colour.png — "Food & Beverage" set in WHITE
		 *     under a black OMG. Reads only on a solid coloured fill.
		 *
		 * Swap the FILE to suit the background, never recolour any of
		 * the artwork.
		 */
		'logo'        => $img . 'oos-logo-fnb-2026c.png',
		'name'        => 'OMG Food &amp; Beverage',
		'title'       => 'Food &amp; Beverage',
		'description' => omg_hybrid_division_blurb( 'foodbeverage' ),
		'url'         => home_url( '/omg-food-beverage/' ),
	),
);
?>
<section class="oh-service-cards oh-service-cards--divisions">
	<div class="oh-service-cards__heading">
		<?php if ( ! $is_other ) : ?>
			<h2 class="oh-section-title oh-section-title--welcome"><?php echo wp_kses_post( $welcome_heading ); ?></h2>
			<p><?php echo wp_kses_post( $welcome_para ); ?></p>
		<?php endif; ?>
		<h2 class="oh-section-title<?php echo $is_other ? ' oh-section-title--other' : ''; ?>"><?php echo esc_html( $heading ); ?></h2>
		<?php foreach ( $description as $para ) : ?>
			<p><?php echo wp_kses_post( $para ); ?></p>
		<?php endforeach; ?>
	</div>

	<div class="oh-service-cards__grid">
		<?php foreach ( $divisions as $division ) : ?>
			<a class="oh-division-card <?php echo esc_attr( $division['svc'] ); ?>" href="<?php echo esc_url( $division['url'] ); ?>">
				<span class="oh-division-card__logo">
					<img src="<?php echo esc_url( $division['logo'] ); ?>" alt="<?php echo esc_attr( $division['name'] ); ?>" loading="lazy">
				</span>
				<h3><?php echo wp_kses_post( $division['title'] ); ?></h3>
				<p><?php echo wp_kses_post( $division['description'] ); ?></p>
				<span class="oh-division-card__link">Visit Us</span>
			</a>
		<?php endforeach; ?>
	</div>
</section>
