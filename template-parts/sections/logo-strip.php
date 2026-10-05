<?php
/**
 * Client logos as a single-line slider (client 2026-10-01).
 *
 * The compact companion to sections/marquee.php's 4-row grid, for phones:
 * one row of logos, three across (four from 576px), on an endless loop.
 * Since 2026-10-05 it glides continuously like the grid (client task-016):
 * the logos are rendered twice in one track and a linear CSS animation
 * slides it by -50% and repeats. Built because the inner service pages had
 * grown tall, and the 4-row grid alone was ~550px of scrolling on a phone.
 *
 * Usage: pages normally don't call this directly. sections/marquee.php
 * renders it right after the grid whenever the grid's 'hide_on_mobile' is
 * on, which is the default on every page except the home page, so any
 * page that renders the logo grid gets this strip on phones with no
 * template change (client 2026-10-01). To keep the 4-row grid on phones
 * instead, pass 'hide_on_mobile' => false to the marquee call. To show the
 * strip on its own (no grid), call it directly with 'visibility' => 'all':
 *
 *   get_template_part( 'template-parts/sections/logo-strip', null, array(
 *       'title'      => $title,
 *       'visibility' => 'all',
 *   ) );
 *
 * Logos come from the same folder as the grid (omg_hybrid_client_logos()),
 * so the two never drift apart. The section also carries .oh-logo-grid, so
 * its padding and heading come from whichever grid styles the page loads
 * (app.css on new templates, legacy-styles.css on legacy ones) and always
 * match the grid it replaces. Its own slider and cells use .oh-logo-strip__*
 * classes, so none of the grid's 4-row rules or JS reach it.
 *
 * Styles + animation: shell.css ("Client-logo strip"), loaded on every
 * template. No Swiper and no JS timing; theme.js only switches the logos
 * to eager loading while the strip is visible.
 *
 * $args:
 *   title     string
 *   logos     string[]  fallback image URLs, used only if the folder is empty
 *   autoplay  int       0 = no movement; anything else = continuous
 *                       (default 2500; the old step delay)
 *   speed     int       ms for one logo to pass (default 1600)
 *   visibility 'mobile' | 'all'  (default 'mobile': shown at <=767px only)
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$title      = $args['title'] ?? '';
$autoplay   = isset( $args['autoplay'] ) ? max( 0, (int) $args['autoplay'] ) : 2500;
$speed      = isset( $args['speed'] ) ? max( 500, (int) $args['speed'] ) : 1600;
$visibility = ( $args['visibility'] ?? 'mobile' ) === 'all' ? 'all' : 'mobile';
$logos      = omg_hybrid_client_logos( $args['logos'] ?? array() );

if ( ! $logos ) {
	return;
}

// One full pass of the track = every logo once.
$duration = count( $logos ) * $speed / 1000;
?>
<section class="oh-logo-grid oh-logo-strip<?php echo 'mobile' === $visibility ? ' oh-logo-strip--mobile' : ''; ?>">
	<?php // Skeleton cells (is-loading) are cleared by each img's onload; with JS off nothing would clear them. ?>
	<noscript><style>.oh-logo-strip__item.is-loading::before{content:none}.oh-logo-strip__item.is-loading .oh-logo-strip__logo{opacity:1}</style></noscript>
	<div class="oh-wrap">
		<?php if ( $title ) : ?>
			<h2><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>
		<div class="oh-logo-strip__slider<?php echo $autoplay ? ' is-moving' : ''; ?>" style="--oh-logo-dur: <?php echo esc_attr( $duration ); ?>s">
			<div class="oh-logo-strip__track">
				<?php for ( $copy = 0; $copy < 2; $copy++ ) : ?>
					<?php // The second copy is only there for the seamless loop. ?>
					<ul class="oh-logo-strip__list"<?php echo $copy ? ' aria-hidden="true"' : ''; ?>>
						<?php foreach ( $logos as $logo ) : ?>
							<li class="oh-logo-strip__item is-loading"><img class="oh-logo-strip__logo" src="<?php echo esc_url( $logo ); ?>" alt="" loading="lazy" onload="this.parentNode.classList.remove('is-loading')" onerror="this.parentNode.classList.remove('is-loading')"></li>
						<?php endforeach; ?>
					</ul>
				<?php endfor; ?>
			</div>
		</div>
	</div>
</section>
