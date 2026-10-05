<?php
/**
 * Template Name: Coming Soon
 *
 * Holding page for divisions / services that don't have their own page yet
 * (client 2026-09-24) — first used by the OMG Food & Beverage card in the
 * "Our Services" / "Other Services" sections. Built from the home page's
 * own components so it carries the same look: the shared hero, the gold +
 * cream svc-group palette (the `coming-soon` slug is listed in
 * omg_hybrid_group_page_slugs()) and the shared client logo grid.
 *
 * Copy is deliberately generic so the page can front any upcoming service.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

$img = OMG_HYBRID_URI . '/assets/images/';

get_header();

get_template_part( 'template-parts/sections/hero', null, array(
	'variant'     => 'home',
	'title'       => 'Coming Soon',
	'description' => 'Something new is on its way from the OMG family. Stay tuned.',
	'cta'         => array( 'url' => home_url( '/contact/' ), 'label' => 'Get a Free Quote' ),
	'slides'      => array(
		array( 'type' => 'image', 'url' => $img . 'omg-entertainment-new-banner-01.jpg' ),
	),
) );

$points = array(
	array(
		'title' => 'The OMG Standard',
		'text'  => 'The same professional, fully managed service our clients already trust across every OMG division.',
	),
	array(
		'title' => 'One Point of Contact',
		'text'  => 'Bundle it with entertainment, photo booths, live production or theming &mdash; one team looks after it all.',
	),
	array(
		'title' => 'Tailored to Your Event',
		'text'  => 'From intimate celebrations to large corporate functions, every package is shaped around your guests.',
	),
);
?>
<section class="oh-section oh-coming-soon">
	<div class="oh-wrap oh-coming-soon__inner">
		<span class="oh-eyebrow oh-coming-soon__eyebrow">We&rsquo;re working on it</span>
		<h2 class="oh-section-title">Putting the Finishing Touches On Something Special</h2>
		<div class="oh-coming-soon__copy">
			<p>This part of OMG is still being prepared behind the scenes. We&rsquo;re busy shaping the details, lining up the right people and making sure it meets the standard our clients expect before we open the doors.</p>
			<p>In the meantime, our team is ready to help you plan your next event. Get in touch and we&rsquo;ll let you know what&rsquo;s available now &mdash; and be the first to hear when this launches.</p>
		</div>

		<ul class="oh-coming-soon__points">
			<?php foreach ( $points as $point ) : ?>
				<li class="oh-coming-soon__point">
					<h3><?php echo esc_html( $point['title'] ); ?></h3>
					<p><?php echo wp_kses_post( $point['text'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>

		<div class="oh-btn-row oh-coming-soon__actions">
			<a class="oh-btn oh-btn--solid" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
				Enquire Now
				<?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?>
			</a>
			<a class="oh-btn oh-btn--outline" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				Back to Home
				<?php omg_hybrid_icon( 'fancy-right-arrow-icom' ); ?>
			</a>
		</div>
	</div>
</section>
<?php
get_template_part( 'template-parts/sections/marquee', null, array(
	'title'          => 'THE BEST BRANDS CHOOSE THE BEST BRAND',
	// Keep the 4-row logo slider on phones too, not the one-row strip
	// (client task-016, 2026-10-05).
	'hide_on_mobile' => false,
) );

get_footer();
