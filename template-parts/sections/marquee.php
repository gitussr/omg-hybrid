<?php
/**
 * Client logos — THE shared "The Best Brands Choose the Best Brand" block.
 * Every page renders this one part; nothing hardcodes its own logo list
 * (client 2026-09-23). Modelled on omggaming.com.au's showcase.
 *
 * Since 2026-09-23 the grid is a Swiper: 6 across x 4 rows = 24 logos per
 * view, autoplaying every 3s. Each logo is one .swiper-slide and Swiper's
 * Grid module lays the rows out, so the page count follows the folder
 * contents by itself. Before Swiper boots — and if JS is off — the
 * wrapper stays a wrapped flex grid, i.e. the pre-slider layout. The
 * pagination is a sibling of .swiper, which is overflow:hidden.
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
 *   autoplay        int       slide delay in ms (default 3000, 0 = no autoplay)
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
		<div class="swiper oh-logo-grid__slider" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
			<ul class="swiper-wrapper oh-logo-grid__list">
				<?php foreach ( $logos as $logo ) : ?>
					<li class="swiper-slide oh-logo-grid__item is-loading"><img class="oh-logo-grid__logo" src="<?php echo esc_url( $logo ); ?>" alt="" loading="lazy" onload="this.parentNode.classList.remove('is-loading')" onerror="this.parentNode.classList.remove('is-loading')"></li>
				<?php endforeach; ?>
			</ul>
		</div>
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
