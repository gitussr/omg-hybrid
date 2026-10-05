<?php
/**
 * Client logos — THE shared "The Best Brands Choose the Best Brand" block.
 * Every page renders this one part; nothing hardcodes its own logo list
 * (client 2026-09-23). Modelled on omggaming.com.au's showcase.
 *
 * The grid is 4 rows deep and 6 columns across (4 at <=991px, 2 at
 * <=767px) and glides continuously (client task-016, 2026-10-05). The
 * logo list is cut into columns of 4 (the last column topped up from the
 * start so every column is full), the set of columns is rendered TWICE
 * in one track, and a single linear CSS animation slides the track by
 * -50% (exactly one set) and repeats, so the loop is seamless. Pure CSS
 * on the compositor: no Swiper, no JS timing. (A first version that day
 * used Swiper loop + zero-delay autoplay; it hitched at every column
 * boundary, so the client found it jerky.) The pagination dots are
 * DORMANT: markup kept, hidden in CSS.
 *
 * The original pure-CSS infinite-scroll marquee is kept DORMANT below: pass
 * 'layout' => 'marquee' to bring it back (its .oh-marquee CSS is untouched).
 * In marquee mode the track is rendered twice so the animation can loop
 * seamlessly by translating -50%.
 *
 * $args:
 *   title           string
 *   logos           string[]  image URLs
 *   layout          'grid' | 'marquee'   (default 'grid')
 *   autoplay        int       0 = no movement; anything else = continuous
 *                             (default 3000; the old per-page delay)
 *   speed           int       ms for one column to pass (default 2000)
 *   hide_on_mobile  bool      grid only: on phones (<=767px) hide the grid and
 *                             show sections/logo-strip.php's single-line
 *                             slider instead, rendered right after it.
 *                             Default: on for every page except the home
 *                             page (client 2026-10-01), so new inner pages
 *                             get it without any template change. Pass
 *                             false to keep the 4-row grid on phones.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$title       = $args['title'] ?? '';
$layout      = ( $args['layout'] ?? 'grid' ) === 'marquee' ? 'marquee' : 'grid';
$autoplay    = isset( $args['autoplay'] ) ? max( 0, (int) $args['autoplay'] ) : 3000;
$speed       = isset( $args['speed'] ) ? max( 500, (int) $args['speed'] ) : 2000;
$hide_mobile = (bool) ( $args['hide_on_mobile'] ?? ! is_front_page() );

// Client logo set shared by every page (client 2026-09-19): every PNG in
// assets/images/client-logos/, in filename order. Overrides the per-page
// 'logos' lists; those remain the fallback if the folder is ever emptied.
$logos = omg_hybrid_client_logos( $args['logos'] ?? array() );

if ( ! $logos ) {
	return;
}

if ( 'grid' === $layout ) :
	?>
<section class="oh-logo-grid<?php echo $hide_mobile ? ' oh-logo-grid--hide-mobile' : ''; ?>">
	<?php // Skeleton cells (is-loading) are cleared by each img's onload; with JS off nothing would clear them. ?>
	<noscript><style>.oh-logo-grid__item.is-loading::before{content:none}.oh-logo-grid__item.is-loading .oh-logo-grid__logo{opacity:1}</style></noscript>
	<div class="oh-wrap">
		<?php if ( $title ) : ?>
			<h2><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>
		<?php
		// Columns of 4. Top the last column up from the start of the list
		// so the loop never shows a half-empty column.
		$cells = array_values( $logos );
		$short = ( 4 - count( $cells ) % 4 ) % 4;
		for ( $i = 0; $i < $short; $i++ ) {
			$cells[] = $cells[ $i % count( $logos ) ];
		}
		$columns = array_chunk( $cells, 4 );
		// One full pass of the track = every column once.
		$duration = count( $columns ) * $speed / 1000;
		?>
		<div class="oh-logo-grid__slider<?php echo $autoplay ? ' is-moving' : ''; ?>" style="--oh-logo-dur: <?php echo esc_attr( $duration ); ?>s">
			<div class="oh-logo-grid__track">
				<?php for ( $copy = 0; $copy < 2; $copy++ ) : ?>
					<?php // The second copy is only there for the seamless loop. ?>
					<ul class="oh-logo-grid__list"<?php echo $copy ? ' aria-hidden="true"' : ''; ?>>
						<?php foreach ( $columns as $column ) : ?>
							<li class="oh-logo-grid__col">
								<?php foreach ( $column as $logo ) : ?>
									<div class="oh-logo-grid__item is-loading"><img class="oh-logo-grid__logo" src="<?php echo esc_url( $logo ); ?>" alt="" loading="lazy" onload="this.parentNode.classList.remove('is-loading')" onerror="this.parentNode.classList.remove('is-loading')"></div>
								<?php endforeach; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endfor; ?>
			</div>
		</div>
		<?php // Dormant (client task-016): hidden in CSS. ?>
		<div class="swiper-pagination oh-logo-grid__pagination"></div>
	</div>
</section>
	<?php
	// The phone stand-in for the grid hidden above (shown at <=767px only).
	if ( $hide_mobile ) {
		get_template_part( 'template-parts/sections/logo-strip', null, array(
			'title' => $title,
			'logos' => $args['logos'] ?? array(),
		) );
	}
	return;
endif;

/* ---- Dormant: original marquee (layout => 'marquee') ---- */
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
