<?php
/**
 * OMG Entertainment — MODULAR SECTION 1 (directly below the hero).
 *
 * The home page and the inner "Our Services → OMG Entertainment" landing
 * page will eventually differ here. For now BOTH render this identically.
 * Do not branch on $args['context'] until the user provides the
 * divergence instructions.
 *
 * $args: context ('home' | 'landing')
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$img = OMG_HYBRID_URI . '/assets/images/';
?>
<section class="oh-section oh-section--secondary">
	<div class="oh-wrap oh-service-row">
		<div class="oh-service-row__body">
			<span class="oh-eyebrow">Who We Are</span>
			<h2 class="oh-section-title">Australia’s Full-Service Events &amp; Entertainment Team</h2>
			<p>OMG Entertainment brings casino nights, race days, performers and full event styling under one roof. One team, one point of contact, one unforgettable event — whatever the occasion.</p>
			<div class="oh-btn-row">
				<a class="oh-btn oh-btn--solid" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a Quote <?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?></a>
			</div>
		</div>
		<div class="oh-service-row__media">
			<img src="<?php echo esc_url( $img . 'big-fun-img-1.jpg' ); ?>" alt="" loading="lazy">
		</div>
	</div>
</section>
