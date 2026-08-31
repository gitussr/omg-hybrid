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
<section class="oh-testimonials">
	<div class="oh-wrap">
		<div class="oh-emblem-wrap">
			<div class="oh-emblem"><?php echo esc_html( $emblem ); ?></div>
			<?php omg_hybrid_icon( 'quotes-icon' ); ?>
		</div>

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
</section>
