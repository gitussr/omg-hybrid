<?php
/**
 * "Other Services" — up to 3 cards.
 *
 * $args:
 *   heading     string
 *   description string
 *   cards       array of array{ image:string, logo?:string, title:string,
 *                 description:string, url:string, link_label?:string }
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$heading     = $args['heading'] ?? '';
$description = $args['description'] ?? '';
$cards       = $args['cards'] ?? array();

if ( ! $cards ) {
	return;
}
?>
<section class="oh-other-services">
	<div class="oh-wrap">
		<?php if ( $heading || $description ) : ?>
			<div class="oh-other-services__heading">
				<?php if ( $heading ) : ?><h2 class="oh-section-title"><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
				<?php if ( $description ) : ?><p><?php echo wp_kses_post( $description ); ?></p><?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="oh-other-grid">
			<?php foreach ( $cards as $card ) : ?>
				<a class="oh-other-card" href="<?php echo esc_url( $card['url'] ?? '#' ); ?>">
					<span class="oh-other-card__media">
						<?php if ( ! empty( $card['image'] ) ) : ?>
							<img src="<?php echo esc_url( $card['image'] ); ?>" alt="<?php echo esc_attr( $card['title'] ?? '' ); ?>" loading="lazy">
						<?php endif; ?>
						<?php if ( ! empty( $card['logo'] ) ) : ?>
							<span class="oh-other-card__logo"><img src="<?php echo esc_url( $card['logo'] ); ?>" alt=""></span>
						<?php endif; ?>
					</span>
					<span class="oh-other-card__body">
						<h4><?php echo esc_html( $card['title'] ?? '' ); ?></h4>
						<?php if ( ! empty( $card['description'] ) ) : ?>
							<span><?php echo wp_kses_post( $card['description'] ); ?></span>
						<?php endif; ?>
						<span class="oh-other-card__link"><?php echo esc_html( $card['link_label'] ?? __( 'Learn more', 'omg-hybrid' ) ); ?></span>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
