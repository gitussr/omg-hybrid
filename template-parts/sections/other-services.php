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
			<?php foreach ( $cards as $card ) :
				// Brand slug off the card URL — lets the CSS even out the
				// logo sizes (some wordmarks fill their canvas, some don't).
				$oc_seg  = array_filter( explode( '/', (string) wp_parse_url( $card['url'] ?? '', PHP_URL_PATH ) ) );
				$oc_slug = '';
				foreach ( array( 'omg-entertainment', 'omg-studio', 'omg-live', 'omg-props-theming' ) as $oc_b ) {
					if ( in_array( $oc_b, $oc_seg, true ) ) {
						$oc_slug = $oc_b;
						break;
					}
				}
				// Food & Beverage has no page yet (url is #) — key it off the
				// title instead, same fallback the mega menu uses.
				if ( '' === $oc_slug && false !== stripos( $card['title'] ?? '', 'food' ) ) {
					$oc_slug = 'omg-food-beverage';
				}

				/*
				 * Each card also carries its brand's .svc-* palette class
				 * (client 2026-09-21), so var(--color-primary) inside it
				 * resolves to THAT division's colour instead of the host
				 * page's. It is what lets every card take its own brand
				 * fill — the same treatment as the home page's division
				 * cards — on whichever service page the block appears.
				 */
				$oc_svc = array(
					'omg-entertainment' => 'svc-entertainment',
					'omg-studio'        => 'svc-studio',
					'omg-live'          => 'svc-live',
					'omg-props-theming' => 'svc-props',
					'omg-food-beverage' => 'svc-foodbeverage',
				)[ $oc_slug ] ?? '';

				/*
				 * Every card takes the logo it was passed, which for Food
				 * & Beverage is oos-logo-fnb-on-light.png (the black
				 * wordmark, client 2026-09-22) — set in helpers.php.
				 *
				 * Until 2026-09-22 this forced F&B to the separate
				 * oos-logo-fnb-on-colour.png, whose "Food & Beverage" is
				 * set in WHITE: correct while these cards carried solid
				 * brand fills, wrong now they are pale tints, where the
				 * white half would disappear. The two files pair with the
				 * background — swap the FILE to suit the fill, never
				 * recolour either artwork.
				 */
				$oc_logo = $card['logo'] ?? '';
				?>
				<a class="oh-other-card<?php echo $oc_slug ? ' oh-other-card--' . esc_attr( $oc_slug ) : ''; ?><?php echo $oc_svc ? ' ' . esc_attr( $oc_svc ) : ''; ?>" href="<?php echo esc_url( $card['url'] ?? '#' ); ?>">
					<span class="oh-other-card__media">
						<?php if ( ! empty( $card['image'] ) ) : ?>
							<img src="<?php echo esc_url( $card['image'] ); ?>" alt="<?php echo esc_attr( $card['title'] ?? '' ); ?>" loading="lazy">
						<?php endif; ?>
						<?php if ( $oc_logo ) : ?>
							<span class="oh-other-card__logo"><img src="<?php echo esc_url( $oc_logo ); ?>" alt=""></span>
						<?php endif; ?>
					</span>
					<span class="oh-other-card__body">
						<?php /* Title heading removed — the big brand logo above already names the service. */ ?>
						<?php if ( ! empty( $card['description'] ) ) : ?>
							<span><?php echo wp_kses_post( $card['description'] ); ?></span>
						<?php endif; ?>
						<?php
						/*
						 * Uniform "Visit Us" CTA on every card (client
						 * 2026-09-21), replacing the per-brand "Visit OMG
						 * Studio" / "Visit OMG LiVE" wording. Set here so
						 * one edit covers all six pages that render this
						 * block. NOTE: the calling templates still pass a
						 * 'link_label' in their cards arrays — it is now
						 * intentionally ignored. Restore the old
						 * behaviour by putting back:
						 *   $card['link_label'] ?? __( 'Learn more', ... )
						 */
						?>
						<span class="oh-other-card__link"><?php esc_html_e( 'Visit Us', 'omg-hybrid' ); ?></span>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
