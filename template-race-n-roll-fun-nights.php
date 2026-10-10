<?php
/*
*Template Name: Race 'n' Roll Fun Nights Page
*/

/*
 * /race-n-roll-fun-nights/ (client task001, 2026-10-07). Replaces the menu's
 * "Race 'n' Roll Fun Nights" link to the shared /coming-soon/ page. Built on
 * the Casino Fun Nights layout (legacy layer, Entertainment red) and carries
 * the Coming Soon page's own copy (hero line, intro, three points) until the
 * product launches. Page-scoped styles: every body.page-casino-fun-nights
 * group in shell.css / legacy-styles.css also lists this page's slug.
 */
?>
<?php get_header(); ?>


<!-- =====hero section start===== -->
<section class="hero-section inner-page">
    <div class="main-block">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="single-slide hero-scrim" style="background: url('<?php echo esc_url( OMG_HYBRID_URI . '/assets/images/omg-entertainment-new-banner-01.jpg' ); ?>') no-repeat; background-size: cover; background-position: center;">
                        <div class="container">
                            <h1>Race &rsquo;n&rsquo; Roll Fun Nights</h1>
                            <p><strong>Coming Soon.</strong> Something new is on its way from the OMG family. Stay tuned.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination line-bullet-style"></div>
        </div>
    </div>
</section>
<!-- =====hero section end===== -->


<!-- =====intro section start===== -->
<?php // Copy and points from template-parts/sections/coming-soon.php. ?>
<section class="inner-top-section-style-1">
    <div class="container">
        <div class="main-block">
            <div class="row">
                <div class="col-lg-7">
                    <div class="left-block">
                        <span class="rnr-eyebrow">We&rsquo;re working on it</span>
                        <h3 class="title-dark-1">Putting the Finishing Touches On Something Special</h3>
                        <p>This part of OMG is still being prepared behind the scenes. We&rsquo;re busy shaping the details, lining up the right people and making sure it meets the standard our clients expect before we open the doors.</p>
                        <p>In the meantime, our team is ready to help you plan your next event. Get in touch and we&rsquo;ll let you know what&rsquo;s available now &mdash; and be the first to hear when this launches.</p>
                        <div class="img-wrapper">
                            <img src="<?php echo esc_url( OMG_HYBRID_URI . '/assets/images/footer-entertainment-race-day-bookies.jpg' ); ?>" alt="OMG Entertainment bookies in race-day costume at a race night" class="img-fluid-cover" width="2000" height="1328" loading="lazy"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="right-block">
                        <ul>
                            <li>
                                <h4>The OMG Standard</h4>
                                <p>The same professional, fully managed service our clients already trust across every OMG division.</p>
                            </li>
                            <li>
                                <h4>One Point of Contact</h4>
                                <p>Bundle it with entertainment, photo booths, live production or theming &mdash; one team looks after it all.</p>
                            </li>
                            <li>
                                <h4>Tailored to Your Event</h4>
                                <p>From intimate celebrations to large corporate functions, every package is shaped around your guests.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =====intro section end===== -->


<!-- =====our products section start===== -->
<?php
// "Other Products", as on the casino page, minus this page's own card.
get_template_part( 'template-parts/omg-entertainment/our-products', null, array(
	'exclude' => array( 'race-n-roll' ),
	'heading' => 'Other Products',
) );
?>
<!-- =====our products section end===== -->


<!-- =====why choose section start===== -->
<?php
// Same heading, bullets and buttons as the OMG Entertainment landing
// (template-parts/omg-entertainment-layout.php).
get_template_part( 'template-parts/sections/why-choose', null, array(
	'heading' => 'Why Choose OMG Entertainment?',
	'bullets' => array(
		'Full-sized, Australian-made casino equipment',
		'Entertainment-skilled, experienced croupiers',
		'Transparent pricing, no hidden costs',
		'Fully customisable game &amp; performer selection',
		'Add-on props, DJ, photo booth &amp; performers',
		'Fully insured $20 million public liability cover',
	),
	'body'    => 'Let OMG Entertainment plan your next event &mdash; and be the first to hear when Race &rsquo;n&rsquo; Roll launches.',
	'buttons' => array(
		array( 'url' => 'tel:1300300664', 'label' => 'Call Us' ),
		array( 'url' => home_url( '/contact/' ), 'label' => 'Book an Event' ),
		array( 'url' => 'mailto:info@OMGent.com.au', 'label' => 'Email Us' ),
	),
) );
?>
<!-- =====why choose section end===== -->


<!-- =====other services section start===== -->
<?php
get_template_part( 'template-parts/omg-entertainment/home-divisions', null, array(
	'heading'     => 'Other Services',
	'description' => 'Why stop there? Take your event to the next level with our full suite of event services &mdash; from high-energy DJs and live music to booths, photography and full styling, all under one roof.',
) );
?>
<!-- =====other services section end===== -->


<?php
// Logo grid, same title and logos as the casino page.
$uploads = home_url( '/wp-content/uploads' );
get_template_part( 'template-parts/sections/marquee', null, array(
	'title' => 'The Best BRANDS CHOOSE THE BEST BRAND',
	'logos' => array(
		$uploads . '/2026/04/logo-1.jpg',  $uploads . '/2026/04/logo-2.jpg',  $uploads . '/2026/04/logo-3.jpg',
		$uploads . '/2026/04/logo-4.jpg',  $uploads . '/2026/04/logo-5.jpg',  $uploads . '/2026/04/logo-6.jpg',
		$uploads . '/2026/04/logo-7.jpg',  $uploads . '/2026/04/logo-8.jpg',  $uploads . '/2026/04/logo-9.jpg',
		$uploads . '/2026/04/logo-10.jpg', $uploads . '/2026/04/logo-11.jpg', $uploads . '/2026/04/logo-12.jpg',
		$uploads . '/2026/04/logo-13.jpg', $uploads . '/2026/04/logo-14.jpg', $uploads . '/2026/04/logo-15.jpg',
		$uploads . '/2026/04/logo-16.jpg', $uploads . '/2026/04/logo-17.jpg', $uploads . '/2026/04/logo-18.jpg',
		$uploads . '/2026/04/logo-19.jpg', $uploads . '/2026/04/logo-20.jpg', $uploads . '/2026/04/logo-21.jpg',
		$uploads . '/2026/04/logo-22.jpg',
	),
) );
?>

<?php get_template_part( 'template-parts/omg-entertainment/testimonials' ); ?>

<!-- =====Cta section start===== -->
<section class="cta-section">
    <div class="container">
        <div class="main-block">
            <h3 class="title-dark-2">Ready To Roll The Dice?</h3>
            <p>Get in touch for a free, no-obligation quote &mdash; and be the first to hear when Race &rsquo;n&rsquo; Roll launches.</p>
            <div class="btn-group">
                <a href="tel:1300300664" class="primary-btn-outline">
                    Call Us
                    <svg class="srdev-icon">
                        <use href="<?php echo get_template_directory_uri(); ?>/assets/icons.svg#fancy-right-arrow-icom"></use>
                    </svg>
                </a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="primary-btn-outline">
                    Book an Event
                    <svg class="srdev-icon">
                        <use href="<?php echo get_template_directory_uri(); ?>/assets/icons.svg#fancy-right-arrow-icom"></use>
                    </svg>
                </a>
                <a href="mailto:info@OMGent.com.au" class="primary-btn-outline">
                    Email Us
                    <svg class="srdev-icon">
                        <use href="<?php echo get_template_directory_uri(); ?>/assets/icons.svg#fancy-right-arrow-icom"></use>
                    </svg>
                </a>
            </div>
            <?php get_template_part( 'template-parts/sections/mobile-cta', null, array( 'buttons' => omg_hybrid_cta_buttons(), 'row_class' => 'btn-group', 'btn_class' => 'primary-btn-outline' ) ); ?>
        </div>
    </div>
</section>
<!-- =====Cta section end===== -->

<?php get_footer(); ?>
