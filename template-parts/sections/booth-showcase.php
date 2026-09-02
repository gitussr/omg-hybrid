<?php
/**
 * OMG Studio — booth showcase band.
 *
 * The "Unforgettable Moments. Made Effortless." feature block: intro +
 * three format call-outs (PhotoBooth / 360 Video-Booth / Video Guest-Book)
 * + CTA row + trust list + product image, followed by the dark event-type
 * bar.
 *
 * Ported from the legacy omg-jeff-demo/booth-gallery-section.php (a
 * malformed standalone HTML fragment) — rebuilt here as a real section
 * part on the component layer. Content is fixed for this page; colour
 * comes from the svc-studio tokens.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

// Collage on a teal ground that blends into this section's cyan band
// (bundled in the theme; the source lived only on the staging site).
$image = OMG_HYBRID_URI . '/assets/images/booth-showcase-collage.jpg';

$features = array(
	array(
		'icon'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 8.5h2.6l1.1-1.8h8.6l1.1 1.8H20a1 1 0 0 1 1 1V18a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a1 1 0 0 1 1-1Z"/><circle cx="12" cy="13" r="3.4"/></svg>',
		'title'       => 'PhotoBooth',
		'description' => 'Capture stunning photos with custom overlays.',
	),
	array(
		'icon'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3c3.6 1.8 3.6 16.2 0 18M12 3c-3.6 1.8-3.6 16.2 0 18M3.2 9h17.6M3.2 15h17.6"/></svg>',
		'title'       => '360 Video&#8209;Booth',
		'description' => 'Create shareable 360&deg; videos that wow.',
	),
	array(
		'icon'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="6" width="13" height="12" rx="2"/><path d="M16 10.4 21 7.5v9L16 13.6"/></svg>',
		'title'       => 'Video Guest&#8209;Book',
		'description' => 'Collect heartfelt messages your way.',
	),
);

$meta = array(
	array(
		'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="2.6"/><path d="M3.6 18c.5-2.8 2.6-4.4 5.4-4.4S14.3 15.2 14.8 18"/><circle cx="17" cy="9" r="2"/><path d="M15.8 13.4c2 .2 3.4 1.6 3.8 3.9"/></svg>',
		'text' => 'Corporate &amp; Private Events',
	),
	array(
		'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3.5l2.4 5 5.4.6-4 3.8.9 5.4L12 15.8l-4.7 2.5.9-5.4-4-3.8 5.4-.6Z"/></svg>',
		'text' => 'Premium Experience',
	),
	array(
		'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="12" r="2.2"/><circle cx="17.5" cy="6" r="2.2"/><circle cx="17.5" cy="18" r="2.2"/><path d="M7.9 10.8 15.7 7M7.9 13.2l7.8 3.8"/></svg>',
		'text' => 'Instant Share &amp; Prints',
	),
);

$categories = array(
	array(
		'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3.5" y="5" width="17" height="15" rx="2"/><path d="M3.5 9.5h17M8 3v3.4M16 3v3.4"/></svg>',
		'label' => 'Weddings',
	),
	array(
		'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3.5" y="7.5" width="17" height="12" rx="2"/><path d="M8.5 7.5V6a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v1.5M3.5 13h17"/></svg>',
		'label' => 'Corporate Events',
	),
	array(
		'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20 14 4M4 20 9 5M4 20l11-7"/><circle cx="17" cy="5" r="1.2" fill="currentColor" stroke="none"/><circle cx="20" cy="9" r="1" fill="currentColor" stroke="none"/><circle cx="13" cy="3" r="0.9" fill="currentColor" stroke="none"/></svg>',
		'label' => 'Parties &amp; Celebrations',
	),
	array(
		'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8.5" r="4.5"/><path d="M9 12.4 7.4 21l4.6-2.4 4.6 2.4-1.6-8.6"/></svg>',
		'label' => 'Product Launches',
	),
	array(
		'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="9" r="2.6"/><path d="M3 18c.4-2.6 2.3-4 5-4s4.6 1.4 5 4"/><circle cx="17" cy="9.5" r="2"/><path d="M15.6 14.2c1.9.3 3.2 1.6 3.5 3.8"/></svg>',
		'label' => 'And More',
	),
);
?>
<section class="oh-booth-showcase">
	<div class="oh-booth-showcase__dots" aria-hidden="true"></div>

	<div class="oh-wrap oh-booth-showcase__inner">

		<div class="oh-booth-showcase__copy">
			<h2 class="oh-booth-showcase__title">
				<span class="is-ink">Unforgettable Moments.</span>
				<span class="is-white">Made Effortless.</span>
			</h2>

			<p class="oh-booth-showcase__sub">
				Premium PhotoBooths, 360 Video&#8209;Booths &amp; Video Guest&#8209;Books for <strong>Corporate</strong> and <strong>Private</strong> Events.
			</p>

			<div class="oh-booth-showcase__features">
				<?php foreach ( $features as $feature ) : ?>
					<div class="oh-booth-showcase__feature">
						<span class="oh-booth-showcase__feature-icon"><?php echo $feature['icon']; ?></span>
						<h3><?php echo wp_kses_post( $feature['title'] ); ?></h3>
						<p><?php echo wp_kses_post( $feature['description'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="oh-booth-showcase__cta">
				<div class="oh-booth-showcase__btns">
					<?php foreach ( omg_hybrid_cta_buttons() as $button ) : ?>
						<a href="<?php echo esc_url( $button['url'] ); ?>" class="oh-btn oh-btn--dark">
							<?php echo esc_html( $button['label'] ); ?>
							<?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?>
						</a>
					<?php endforeach; ?>
				</div>

				<ul class="oh-booth-showcase__meta">
					<?php foreach ( $meta as $item ) : ?>
						<li><?php echo $item['icon']; ?><span><?php echo wp_kses_post( $item['text'] ); ?></span></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<div class="oh-booth-showcase__visual">
			<img src="<?php echo esc_url( $image ); ?>" alt="OMG photo booth device beside a collage of guests posing at weddings and events" loading="lazy">
		</div>
	</div>

	<nav class="oh-booth-showcase__categories" aria-label="Event categories">
		<div class="oh-wrap">
			<?php foreach ( $categories as $cat ) : ?>
				<span class="oh-booth-showcase__category"><?php echo $cat['icon']; ?><?php echo wp_kses_post( $cat['label'] ); ?></span>
			<?php endforeach; ?>
		</div>
	</nav>
</section>
