<?php
/**
 * Testimonials — rotating emblem + slider + numbered pagination.
 *
 * $args:
 *   emblem_text string  text around the circular emblem
 *   items       array of array{ quote:string, cite:string }
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$emblem = $args['emblem_text'] ?? 'HAPPY CUSTOMERS • HAPPY CUSTOMERS • ';
$items  = $args['items'] ?? array();

if ( ! $items ) {
	return;
}
?>
<section class="oh-testimonials" aria-label="<?php esc_attr_e( 'Testimonials', 'omg-hybrid' ); ?>">
	<div class="oh-wrap">
		<?php // Visible section heading (client 2026-09-19; was a screen-reader-only "What our customers say"). ?>
		<h2 class="oh-testimonials__title"><?php esc_html_e( 'Testimonials', 'omg-hybrid' ); ?></h2>
		<div class="oh-emblem-wrap" aria-hidden="true">
			<div class="oh-emblem"><?php echo esc_html( $emblem ); ?></div>
			<?php omg_hybrid_icon( 'quotes-icon' ); ?>
		</div>

		<?php // Slider column: 8/12 wide and centred (Bootstrap-style .col-sm-8, styled in app.css — Bootstrap itself isn't loaded on these templates). ?>
		<div class="col-sm-8">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php foreach ( $items as $item ) : ?>
						<div class="swiper-slide">
							<blockquote class="oh-testimonials__slide">
								<p><?php echo wp_kses_post( $item['quote'] ?? '' ); ?></p>
								<?php if ( ! empty( $item['cite'] ) ) : ?>
									<cite><?php echo esc_html( $item['cite'] ); ?></cite>
								<?php endif; ?>
							</blockquote>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</div>
</section>
