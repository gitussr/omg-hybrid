<?php
/**
 * "Welcome to …" intro section.
 *
 * Eyebrow + heading + body copy (paragraphs and/or a labelled bullet
 * list) beside a supporting image, with a row of CTA buttons. Mirrors the
 * OMG Entertainment landing layout; used on all four service pages via
 * omg-entertainment/below-hero-1.php and template-parts/service-landing.php.
 *
 * $args:
 *   eyebrow     string    default 'Welcome'
 *   heading     string
 *   paragraphs  string[]  body paragraphs
 *   bullets     array of array{ label:string, text:string }   optional
 *   buttons     array of array{ url:string, label:string, solid?:bool }
 *   image       string
 *   image_alt   string
 *   image_style 'plain' (default, artwork/transparent PNG) | 'photo' (framed)
 *   reverse     bool      image on the left when true
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$eyebrow    = $args['eyebrow'] ?? 'Welcome';
$heading    = $args['heading'] ?? '';
$paragraphs = $args['paragraphs'] ?? array();
$bullets    = $args['bullets'] ?? array();
$buttons    = $args['buttons'] ?? array();
$image      = $args['image'] ?? '';
$image_alt  = $args['image_alt'] ?? '';
$is_photo   = ( $args['image_style'] ?? 'plain' ) === 'photo';
$reverse    = ! empty( $args['reverse'] );

if ( ! $heading && ! $paragraphs && ! $bullets ) {
	return;
}
?>
<section class="oh-section oh-section--secondary<?php echo $is_photo ? ' oh-section--welcome-photo' : ''; ?>">
	<div class="oh-wrap oh-service-row<?php echo $reverse ? ' oh-service-row--reverse' : ''; ?>">
		<div class="oh-service-row__body">
			<?php if ( $eyebrow ) : ?><span class="oh-eyebrow"><?php echo esc_html( $eyebrow ); ?></span><?php endif; ?>
			<?php if ( $heading ) : ?><h2 class="oh-section-title"><?php echo esc_html( $heading ); ?></h2><?php endif; ?>

			<?php foreach ( $paragraphs as $paragraph ) : ?>
				<p><?php echo wp_kses_post( $paragraph ); ?></p>
			<?php endforeach; ?>

			<?php if ( $bullets ) : ?>
				<ul class="oh-welcome__points">
					<?php foreach ( $bullets as $bullet ) : ?>
						<li>
							<?php if ( ! empty( $bullet['label'] ) ) : ?><strong><?php echo wp_kses_post( $bullet['label'] ); ?></strong><?php endif; ?>
							<?php echo wp_kses_post( $bullet['text'] ?? '' ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if ( $buttons ) : ?>
				<div class="oh-btn-row">
					<?php foreach ( $buttons as $button ) : ?>
						<a class="oh-btn <?php echo empty( $button['solid'] ) ? 'oh-btn--outline' : 'oh-btn--solid'; ?>" href="<?php echo esc_url( $button['url'] ?? '#' ); ?>">
							<?php echo esc_html( $button['label'] ?? '' ); ?>
							<?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( $image ) : ?>
			<div class="oh-service-row__media">
				<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="lazy">
			</div>
		<?php endif; ?>
	</div>
</section>
