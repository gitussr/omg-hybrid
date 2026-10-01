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
 *   - landing → "Our Products": template-parts/omg-entertainment/our-products.php
 *               (shared service-cards component, "framed" variant).
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

// The product cards live in their own part so the casino / poker / horse
// racing pages can reuse them minus their own card (client task-009).
get_template_part( 'template-parts/omg-entertainment/our-products' );
