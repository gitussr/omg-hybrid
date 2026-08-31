<?php
/**
 * OMG Entertainment — MODULAR SECTION 1 (directly below the hero).
 *
 * "Welcome to OMG Entertainment" intro. Content mirrors the existing
 * home page's who-we-are block, kept static per the approved plan.
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

$img = OMG_HYBRID_URI . '/assets/images';
?>
<section class="oh-section oh-section--secondary">
	<div class="oh-wrap oh-service-row">
		<div class="oh-service-row__body">
			<span class="oh-eyebrow">Welcome</span>
			<h2 class="oh-section-title">Welcome to OMG Entertainment</h2>
			<p>Planning an event should be exciting, not overwhelming. At OMG Entertainment, we provide professionally managed entertainment experiences designed to engage guests, encourage interaction and create memorable moments.</p>
			<p>Casino nights, race days, poker tables, showgirls, magicians and legendary tribute acts &mdash; one team, one point of contact, one unforgettable event.</p>
			<div class="oh-btn-row">
				<a class="oh-btn oh-btn--solid" href="tel:1300300664">Call Us <?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?></a>
				<a class="oh-btn oh-btn--outline" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a Quote <?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?></a>
			</div>
		</div>
		<div class="oh-service-row__media">
			<img src="<?php echo esc_url( $img . '/floating-cards-chips.png' ); ?>" alt="Casino chips and playing cards" loading="lazy">
		</div>
	</div>
</section>
