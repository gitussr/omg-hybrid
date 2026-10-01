<?php

/**
 * Site header.
 *
 * @package omg-hybrid
 */

defined('ABSPATH') || exit;

$contact  = omg_hybrid_contact_details();
$phone    = $contact['phone_number'] ?? '';
$whatsapp = $contact['whatsapp_link'] ?? '';
$stars    = omg_hybrid_option('header_stars');
$favicon  = get_option('omg_favicon');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<?php if ($favicon) : ?>
		<link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<a class="oh-skip-link oh-sr-only" href="#main-content"><?php esc_html_e('Skip to content', 'omg-hybrid'); ?></a>

	<div id="loader">
		<div class="spinner"></div>
	</div>

	<header id="siteHeader" class="oh-header">

		<div class="oh-header__top">
			<div class="oh-wrap">
				<?php if ($stars) :
					$count      = isset($stars['stars']) ? (int) $stars['stars'] : 5;
					$stars_text = $stars['stars_text'] ?? '';
					$link_url   = $stars['link_url'] ?? '';
					$link_text  = $stars['link_text'] ?? '';
				?>
					<div class="oh-header__rating">
						<span class="oh-stars">
							<?php for ($i = 0; $i < $count; $i++) : ?>
								<?php omg_hybrid_icon('start-icon'); ?>
							<?php endfor; ?>
						</span>
						<?php // "X out of 5" text dropped per client (2026-09-08) — just the stars + the RATE US link. ?>
						<?php if ($link_url && $link_text) : ?>
							<span class="oh-rating-text">
								<a href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_text); ?></a>
							</span>
						<?php endif; ?>
					</div>
				<?php else : ?>
					<span></span>
				<?php endif; ?>

				<div class="oh-header__top-actions">
					<?php // Bootstrap Icons font (enqueued in inc/enqueue.php). Text copy is visible >991px and visually hidden below (shell.css), so it still names the links for screen readers. ?>
					<?php if ($whatsapp) : ?>
						<a href="<?php echo esc_url($whatsapp); ?>" target="_blank" rel="noopener" class="oh-whatsapp">
							<i class="bi bi-whatsapp" aria-hidden="true"></i><span>WhatsApp</span>
						</a>
					<?php endif; ?>
					<?php if ($phone) : ?>
						<a href="tel:<?php echo esc_attr(preg_replace('/[^\d+]/', '', $phone)); ?>" class="oh-call">
							<i class="bi bi-telephone" aria-hidden="true"></i><span>Call: <?php echo esc_html($phone); ?></span>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="oh-header__bar">
			<div class="oh-wrap">
				<div class="oh-header__brand">
					<?php
					// Header bar is dark (damask) on svc-group pages — home, contact,
					// print-templates, coming-soon — and light on every other inner
					// page, so the logo flips to match (client 2026-09-25): the gold
					// logo's white "Entertainment" reads on dark; the client-supplied
					// OMG_ENTERTAINMENT_BLACK artwork (black "Entertainment", only the
					// transparent margin trimmed) reads on light. Replaces the
					// customizer logo, which can't carry two variants for one slot.
					$logo_file = ( 'svc-group' === omg_hybrid_current_service_class() )
						? 'logo-omg-gold.png'
						: 'logo-omg-entertainment-black.png';
					printf(
						'<a href="%s"><img src="%s" alt="%s"></a>',
						esc_url(home_url('/')),
						esc_url(OMG_HYBRID_URI . '/assets/images/' . $logo_file),
						esc_attr(get_bloginfo('name'))
					);
					?>
				</div>

				<button class="book-now-header-btn" aria-label="Open the Quick Quote form" aria-expanded="false" aria-controls="book-now-panel">
					Start Planning
				</button>

				<nav class="oh-header__nav menu-block" aria-label="<?php esc_attr_e('Primary', 'omg-hybrid'); ?>">
					<?php
					// The omg-mega-menu plugin replaces wp_nav_menu('main-menu')
					// output entirely and expects its markup inside a .stellarnav
					// container (it forces that element position:relative for its
					// absolutely-positioned hamburger).
					?>
					<div class="stellarnav">
						<?php omg_hybrid_header_nav(); ?>
					</div>
				</nav>
			</div>
		</div>

	</header>

	<main id="main-content">