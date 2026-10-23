<?php
/**
 * Photo gallery grid + lightbox (client 2026-10-15).
 *
 * Modelled on the Essential Grid on omggaming.com.au/casino-party/
 * (#esg-grid-1-1-wrap): 4:3 tiles five across, a dark overlay with a
 * magnifier on hover, and a click opens the full photo in a lightbox
 * (assets/js/gallery.js, enqueued from here so only pages with a gallery
 * load it). Styles: "Photo gallery" block at the end of shell.css.
 * Used under the event-types cards on the casino / poker / horse-racing
 * templates, with the photos from the matching omggaming.com.au page.
 *
 * Folder-driven: every NN.jpg in assets/images/gallery/<folder>/ that has
 * an NN-thumb.jpg (640x480 crop) beside it is shown, in file-name order.
 * Add or remove a photo by adding / removing that pair.
 *
 * $args:
 *   folder  string  sub-folder of assets/images/gallery/, e.g. 'casino'
 *   label   string  accessible name, e.g. 'Casino night photos'
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$folder = sanitize_file_name( $args['folder'] ?? '' );
$label  = $args['label'] ?? 'Photo gallery';

if ( '' === $folder ) {
	return;
}

$dir    = OMG_HYBRID_DIR . '/assets/images/gallery/' . $folder;
$url    = OMG_HYBRID_URI . '/assets/images/gallery/' . $folder;
$photos = array();

foreach ( (array) glob( $dir . '/*.jpg' ) as $file ) {
	$name = basename( $file, '.jpg' );
	if ( '-thumb' === substr( $name, -6 ) ||! is_file( $dir . '/' . $name . '-thumb.jpg' ) ) {
		continue;
	}
	$photos[] = $name;
}
sort( $photos, SORT_NATURAL );

if ( ! $photos ) {
	return;
}

wp_enqueue_script( 'omg-hybrid-gallery', OMG_HYBRID_URI . '/assets/js/gallery.js', array(), (string) filemtime( OMG_HYBRID_DIR . '/assets/js/gallery.js' ), true );

$total = count( $photos );
?>
<section class="oh-gallery-section" aria-label="<?php echo esc_attr( $label ); ?>">
	<div class="container">
		<ul class="oh-gallery">
			<?php foreach ( $photos as $i => $name ) : ?>
				<li class="oh-gallery__cell">
					<a class="oh-gallery__item" href="<?php echo esc_url( $url . '/' . $name . '.jpg' ); ?>" data-oh-gallery aria-label="<?php echo esc_attr( sprintf( 'Open photo %d of %d', $i + 1, $total ) ); ?>">
						<img src="<?php echo esc_url( $url . '/' . $name . '-thumb.jpg' ); ?>" alt="" width="640" height="480" loading="lazy" decoding="async">
						<span class="oh-gallery__zoom" aria-hidden="true"><i class="bi bi-search"></i></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
