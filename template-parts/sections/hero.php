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
 *   slides      array of array{ type:'image'|'video', url:string, poster?:string }
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
?>
<section class="oh-hero oh-hero--<?php echo esc_attr($variant); ?>">

	<div class="oh-hero__slider swiper" aria-hidden="true">
		<div class="swiper-wrapper">
			<?php foreach ($slides as $slide) :
				$type = ($slide['type'] ?? 'image') === 'video' ? 'video' : 'image';
				$url  = $slide['url'] ?? '';
			?>
				<div class="swiper-slide">
					<?php if ($url && 'video' === $type) : ?>
						<video class="oh-hero__media" autoplay muted loop playsinline
							<?php if (! empty($slide['poster'])) : ?>poster="<?php echo esc_url($slide['poster']); ?>" <?php endif; ?>>
							<source src="<?php echo esc_url($url); ?>" type="video/mp4">
						</video>
					<?php elseif ($url) : ?>
						<img class="oh-hero__media" src="<?php echo esc_url($url); ?>" alt="" loading="eager" fetchpriority="high">
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<?php if ($multi) : ?>
			<div class="swiper-pagination"></div>
		<?php endif; ?>
	</div>

	<div class="oh-hero__overlay" aria-hidden="true"></div>

	<div class="oh-hero__inner oh-wrap">
		<?php if ($eyebrow) : ?>
			<span class="oh-eyebrow oh-hero__eyebrow"><?php echo esc_html($eyebrow); ?></span>
		<?php endif; ?>
		<?php if ($title) : ?>
			<h1><?php echo wp_kses_post($title); ?></h1>
		<?php endif; ?>
		<?php if ($description) : ?>
			<p><?php echo wp_kses_post($description); ?></p>
		<?php endif; ?>
		<?php if (! empty($cta['url']) && ! empty($cta['label'])) : ?>
			<a class="oh-btn oh-btn--outline" href="<?php echo esc_url($cta['url']); ?>">
				<?php echo esc_html($cta['label']); ?>
				<?php omg_hybrid_icon('fancy-right-arrow-icom'); ?>
			</a>
		<?php endif; ?>
	</div>
</section>