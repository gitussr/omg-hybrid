<?php
/**
 * Home page — "Our Services" OMG Group divisions overview.
 *
 * A full-bleed row of four brand cards (Entertainment / Studio / LiVE /
 * Props & Theming). Each card carries its own .svc-* palette class so
 * var(--color-*) resolves to that division's colour theme (red / cyan /
 * purple / yellow). Rendered only on the home page via
 * front-page.php → omg-entertainment-layout → below-hero-2.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$img = OMG_HYBRID_URI . '/assets/images/';

$divisions = array(
	array(
		'svc'         => 'svc-entertainment',
		'logo'        => $img . 'oos-logo-1.png',
		'name'        => 'OMG Entertainment',
		'title'       => 'Event &amp; Entertainment',
		'description' => 'Provides 5-star Entertainment for events big and small. Specializing in Fun Casino Parties, Fun Horse Racing, Poker Tournament, Props/Themes and more.',
		'url'         => home_url( '/omg-entertainment/' ),
	),
	array(
		'svc'         => 'svc-studio',
		'logo'        => $img . 'oos-logo-studio.png',
		'name'        => 'OMG Studio',
		'title'       => 'Photobooths &amp; Photography',
		'description' => 'DSLR Camera Photo-Booths, 360 Video-Booth, Video Phone-Booth, complemented by our professional event Photography &amp; Videography services.',
		'url'         => home_url( '/omg-studio/' ),
	),
	array(
		'svc'         => 'svc-live',
		'logo'        => $img . 'oos-logo-2.png',
		'name'        => 'OMG LiVE',
		'title'       => 'DJ &ndash; Music &ndash; Lights',
		'description' => 'High-Energy DJs, DJ-Booths, Lighting, Karaoke, Live Music and PA Hire. Our dynamic setups guarantee an immersive, engaging experience for any event.',
		'url'         => home_url( '/omg-live/' ),
	),
	array(
		'svc'         => 'svc-props',
		'logo'        => $img . 'oos-logo-3.png',
		'name'        => 'OMG Props &amp; Theming',
		'title'       => 'Props &amp; Theming',
		'description' => 'Transform your Event with Casino Props, Giant Light-Up Letters, Theme Walls, Grand Entrance, Tables, Chairs, Flower Decorations and more.',
		'url'         => home_url( '/omg-props-theming/' ),
	),
);
?>
<section class="oh-service-cards oh-service-cards--divisions">
	<div class="oh-service-cards__heading">
		<h2 class="oh-section-title">Our Services</h2>
		<p>Planning a great event can feel like a gamble. You want your guests to have a winning experience, but the logistics often get in the way of the fun. OMG Entertainment Group provides the expertise and services you need to host a flawless celebration. We handle the heavy lifting so you can focus on your guests.</p>
		<p>Our centralized booking system manages every request across our various divisions. You do not have to chase different contractors because we operate as a single, efficient hub for all your event needs.</p>
	</div>

	<div class="oh-service-cards__grid">
		<?php foreach ( $divisions as $division ) : ?>
			<a class="oh-division-card <?php echo esc_attr( $division['svc'] ); ?>" href="<?php echo esc_url( $division['url'] ); ?>">
				<span class="oh-division-card__logo">
					<img src="<?php echo esc_url( $division['logo'] ); ?>" alt="<?php echo esc_attr( $division['name'] ); ?>" loading="lazy">
				</span>
				<h3><?php echo wp_kses_post( $division['title'] ); ?></h3>
				<p><?php echo wp_kses_post( $division['description'] ); ?></p>
				<span class="oh-division-card__link">Visit Us</span>
			</a>
		<?php endforeach; ?>
	</div>
</section>
