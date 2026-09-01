<?php
/**
 * Icon + title + description card grid (e.g. the OMG Entertainment
 * "Our Services" overview block).
 *
 * $args:
 *   heading      string
 *   intro        string
 *   cards        array of array{ icon?:string, title:string, description:string, url?:string, link_label?:string }
 *   variant      string  '' (default) | 'framed' — the centred, primary-bordered,
 *                circular-badge treatment used on the service landing pages.
 *                In 'framed' mode a card with no icon gets a numbered badge.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$heading = $args['heading'] ?? '';
$intro   = $args['intro'] ?? '';
$cards   = $args['cards'] ?? array();
$variant = $args['variant'] ?? '';

if ( ! $cards ) {
	return;
}

$section_class = 'oh-service-cards';
if ( 'framed' === $variant ) {
	$section_class .= ' oh-service-cards--framed';
}
?>
<section class="<?php echo esc_attr( $section_class ); ?>">
	<div class="oh-wrap">
		<?php if ( $heading || $intro ) : ?>
			<div class="oh-service-cards__heading">
				<?php if ( $heading ) : ?><h2 class="oh-section-title"><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
				<?php if ( $intro ) : ?><p><?php echo wp_kses_post( $intro ); ?></p><?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="oh-service-cards__grid">
			<?php $card_index = 0; foreach ( $cards as $card ) :
				$card_index++;
				$url = $card['url'] ?? '';
				$tag = $url ? 'a' : 'div';
				?>
				<<?php echo $tag; ?> class="oh-service-card"<?php if ( $url ) : ?> href="<?php echo esc_url( $url ); ?>"<?php endif; ?>>
					<?php if ( ! empty( $card['icon'] ) ) : ?>
						<span class="oh-service-card__icon"><img src="<?php echo esc_url( $card['icon'] ); ?>" alt="" loading="lazy"></span>
					<?php elseif ( 'framed' === $variant ) : ?>
						<span class="oh-service-card__icon oh-service-card__icon--num" aria-hidden="true"><?php echo esc_html( $card_index ); ?></span>
					<?php endif; ?>
					<h3><?php echo esc_html( $card['title'] ?? '' ); ?></h3>
					<?php if ( ! empty( $card['description'] ) ) : ?>
						<p><?php echo wp_kses_post( $card['description'] ); ?></p>
					<?php endif; ?>
					<?php if ( $url ) : ?>
						<span class="oh-service-card__link"><?php echo esc_html( $card['link_label'] ?? __( 'Learn more', 'omg-hybrid' ) ); ?></span>
					<?php endif; ?>
				</<?php echo $tag; ?>>
			<?php endforeach; ?>
		</div>
	</div>
</section>
