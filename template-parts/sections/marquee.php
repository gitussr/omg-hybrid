<?php
/**
 * Logo marquee.
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
?>
<section class="oh-marquee">
	<?php if ( $title ) : ?>
		<div class="oh-wrap"><h2><?php echo esc_html( $title ); ?></h2></div>
	<?php endif; ?>
	<div class="marquee-wrapper marque-1">
		<div class="marquee">
			<?php foreach ( $logos as $logo ) : ?>
				<span><img class="marqueelogo" src="<?php echo esc_url( $logo ); ?>" alt="" loading="lazy"></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>
