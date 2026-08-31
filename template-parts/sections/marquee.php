<?php
/**
 * Logo marquee — pure-CSS infinite scroll (no JS).
 *
 * The track is rendered twice so the animation can loop seamlessly by
 * translating -50%.
 *
 * $args:
 *   title string
 *   logos string[]  image URLs
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$title = $args['title'] ?? '';
$logos = $args['logos'] ?? array();

if ( ! $logos ) {
	return;
}

$render_track = static function () use ( $logos ) {
	echo '<ul class="oh-marquee__track" aria-hidden="false">';
	foreach ( $logos as $logo ) {
		printf(
			'<li><img class="oh-marquee__logo" src="%s" alt="" loading="lazy"></li>',
			esc_url( $logo )
		);
	}
	echo '</ul>';
};
?>
<section class="oh-marquee">
	<?php if ( $title ) : ?>
		<div class="oh-wrap"><h2><?php echo esc_html( $title ); ?></h2></div>
	<?php endif; ?>
	<div class="oh-marquee__viewport">
		<div class="oh-marquee__row">
			<?php $render_track(); ?>
			<?php
			// Duplicate track for the seamless loop; hidden from AT.
			echo '<ul class="oh-marquee__track" aria-hidden="true">';
			foreach ( $logos as $logo ) {
				printf( '<li><img class="oh-marquee__logo" src="%s" alt="" loading="lazy"></li>', esc_url( $logo ) );
			}
			echo '</ul>';
			?>
		</div>
	</div>
</section>
