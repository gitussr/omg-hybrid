<?php

/**
 * Hero — a media slider (image / video slides) with a single fixed text
 * overlay. Shared by the home page and all four service landing pages.
 *
 * $args:
 *   variant     'home' | 'inner'   (default 'home')
 *   eyebrow     string
 *   title       string   rendered as the page <h1>
 *   description string
 *   cta         array{url:string,label:string}
 *   slides      array of array{ type:'image'|'video', url:string, poster?:string,
 *               title?:string, text?:bool, overlay?:bool,
 *               cta?:array{url:string,label:string,new_tab?:bool} }
 *               Per-slide extras (client task-018, 2026-10-05): 'title'
 *               replaces the hero title while that slide shows ('' = no
 *               title, button only), 'text' => false hides the title +
 *               button on it, 'overlay' => false drops the dark tint on it.
 *               'cta' (client task-021, 2026-10-06) replaces the button's
 *               link and label on that slide; 'new_tab' opens it in a new
 *               tab. theme.js swaps them on each slide change; slides
 *               without extras use the main title, button, text and tint.
 *   hide_text_on_first bool  hide the text overlay while slide 1 shows; it
 *               fades in from slide 2 (theme.js toggles .is-text-off).
 *               When empty, a single flat-colour slide is rendered.
 *
 * @package omg-hybrid
 */

defined('ABSPATH') || exit;

$variant     = ($args['variant'] ?? 'home') === 'inner' ? 'inner' : 'home';
$eyebrow     = $args['eyebrow'] ?? '';
$title       = $args['title'] ?? '';
$description = $args['description'] ?? '';
$cta         = $args['cta'] ?? array();
$slides      = ! empty($args['slides']) ? $args['slides'] : array(array('type' => 'image', 'url' => ''));
$multi       = count($slides) > 1;

$hero_class = 'oh-hero oh-hero--' . $variant;

// Any per-slide title / text / overlay setting switches on theme.js's
// per-slide sync (each slide then carries its settings as data-*).
$per_slide = false;
foreach ($slides as $slide) {
	if (isset($slide['title']) || isset($slide['text']) || isset($slide['overlay']) || isset($slide['cta'])) {
		$per_slide = true;
		break;
	}
}
if ($multi && $per_slide) {
	$hero_class .= ' oh-hero--per-slide';
	// Slide 1's state goes in the markup too, so its text / tint never
	// flash before theme.js runs.
	if (false === ($slides[0]['text'] ?? true)) {
		$hero_class .= ' is-copy-off';
	}
	if (false === ($slides[0]['overlay'] ?? true)) {
		$hero_class .= ' is-overlay-off';
	}
}

// The button (and title) as slide 1 shows them, so the markup already
// matches slide 1 before theme.js runs. Without per-slide copy these are
// just the main title and cta.
$slide_cta = static function ($slide) use ($cta) {
	$c = isset($slide['cta']) && is_array($slide['cta']) ? $slide['cta'] : $cta;
	return array(
		'url'     => $c['url'] ?? '',
		'label'   => $c['label'] ?? '',
		'new_tab' => ! empty($c['new_tab']),
	);
};
$first_cta   = ($multi && $per_slide) ? $slide_cta($slides[0]) : $slide_cta(array());
$first_title = ($multi && $per_slide) ? ($slides[0]['title'] ?? $title) : $title;

if ($multi && ! empty($args['hide_text_on_first'])) {
	// Starts hidden in the markup so there is no flash before Swiper runs.
	$hero_class .= ' oh-hero--text-off-first is-text-off';
}
?>
<section class="<?php echo esc_attr($hero_class); ?>">

	<div class="oh-hero__slider swiper" aria-hidden="true">
		<div class="swiper-wrapper">
			<?php foreach ($slides as $i => $slide) :
				$type  = ($slide['type'] ?? 'image') === 'video' ? 'video' : 'image';
				$url   = $slide['url'] ?? '';
				$first = 0 === $i;
			?>
				<div class="swiper-slide"<?php if ($multi && $per_slide) : ?>
					data-hero-title="<?php echo esc_attr(wp_kses_post($slide['title'] ?? $title)); ?>"
					data-hero-text="<?php echo false === ($slide['text'] ?? true) ? '0' : '1'; ?>"
					data-hero-overlay="<?php echo false === ($slide['overlay'] ?? true) ? '0' : '1'; ?>"<?php $s_cta = $slide_cta($slide); ?>
					data-hero-cta-url="<?php echo esc_url($s_cta['url']); ?>"
					data-hero-cta-label="<?php echo esc_attr($s_cta['label']); ?>"
					data-hero-cta-target="<?php echo $s_cta['new_tab'] ? '_blank' : ''; ?>"<?php endif; ?>>
					<?php if ($url && 'video' === $type) : ?>
						<video class="oh-hero__media" autoplay muted loop playsinline
							<?php if (! empty($slide['poster'])) : ?>poster="<?php echo esc_url($slide['poster']); ?>" <?php endif; ?>>
							<source src="<?php echo esc_url($url); ?>" type="video/mp4">
						</video>
					<?php elseif ($url) : ?>
						<img class="oh-hero__media" src="<?php echo esc_url($url); ?>" alt="" loading="eager"
							<?php if ($first) : ?>fetchpriority="high"<?php endif; ?>>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="oh-hero__overlay" aria-hidden="true"></div>

	<div class="oh-hero__inner oh-wrap">
		<?php if ($eyebrow) : ?>
			<span class="oh-eyebrow oh-hero__eyebrow"><?php echo esc_html($eyebrow); ?></span>
		<?php endif; ?>
		<?php if ($title) : ?>
			<h1<?php echo '' === $first_title ? ' style="display:none"' : ''; ?>><?php echo wp_kses_post($first_title); ?></h1>
		<?php endif; ?>
		<?php if ($description) : ?>
			<p><?php echo wp_kses_post($description); ?></p>
		<?php endif; ?>
		<?php if (! empty($cta['url']) && ! empty($cta['label'])) : ?>
			<a class="oh-btn oh-btn--solid" href="<?php echo esc_url($first_cta['url']); ?>"<?php echo $first_cta['new_tab'] ? ' target="_blank" rel="noopener"' : ''; ?>>
				<?php echo esc_html($first_cta['label']); ?>
				<?php omg_hybrid_icon('fancy-right-arrow-icom'); ?>
			</a>
		<?php endif; ?>
	</div>

	<?php if ($multi) : ?>
		<?php // Numbered pagination on desktop; prev/next arrows replace it on mobile (client 2026-10-04). ?>
		<div class="swiper-pagination oh-hero__pagination"></div>
		<button type="button" class="oh-hero__nav oh-hero__nav--prev" aria-label="Previous slide">
			<i class="bi bi-chevron-left" aria-hidden="true"></i>
		</button>
		<button type="button" class="oh-hero__nav oh-hero__nav--next" aria-label="Next slide">
			<i class="bi bi-chevron-right" aria-hidden="true"></i>
		</button>
	<?php endif; ?>
</section>