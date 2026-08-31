<?php
/**
 * "Why Choose Us".
 *
 * $args:
 *   heading  string
 *   bullets  string[]   full list; split into two columns automatically
 *   body     string     paragraph under the lists
 *   buttons  array of array{ url:string, label:string }   up to 3 outline CTAs
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$heading = $args['heading'] ?? '';
$bullets = $args['bullets'] ?? array();
$body    = $args['body'] ?? '';
$buttons = $args['buttons'] ?? array();

if ( ! $heading && ! $bullets && ! $body ) {
	return;
}

$half  = (int) ceil( count( $bullets ) / 2 );
$col_a = array_slice( $bullets, 0, $half );
$col_b = array_slice( $bullets, $half );
?>
<section class="oh-why">
	<div class="oh-wrap">
		<?php if ( $heading ) : ?><h2><?php echo esc_html( $heading ); ?></h2><?php endif; ?>

		<?php if ( $bullets ) : ?>
			<div class="oh-why__lists">
				<ul>
					<?php foreach ( $col_a as $b ) : ?><li><?php echo wp_kses_post( $b ); ?></li><?php endforeach; ?>
				</ul>
				<?php if ( $col_b ) : ?>
					<ul>
						<?php foreach ( $col_b as $b ) : ?><li><?php echo wp_kses_post( $b ); ?></li><?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $body ) : ?><div class="oh-why__body"><?php echo wp_kses_post( wpautop( $body ) ); ?></div><?php endif; ?>

		<?php if ( $buttons ) : ?>
			<div class="oh-btn-row">
				<?php foreach ( array_slice( $buttons, 0, 3 ) as $btn ) : ?>
					<a class="oh-btn oh-btn--outline" href="<?php echo esc_url( $btn['url'] ?? '#' ); ?>">
						<?php echo esc_html( $btn['label'] ?? '' ); ?>
						<?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
