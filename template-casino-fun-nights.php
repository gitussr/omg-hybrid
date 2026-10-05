<?php
/*
*Template Name: Casino Fun Nights Page
*/
?>
<?php get_header(); ?>


<!-- =====hero section start===== -->
<section class="hero-section inner-page">
    <div class="main-block">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="single-slide hero-scrim" style="background: url('<?php echo esc_url( OMG_HYBRID_URI . '/assets/images/banner-casino-fun-nights.jpg' ); ?>') no-repeat; background-size: cover; background-position: center 25%;">
                        <div class="container">
                            <h1>Casino Fun Nights</h1>
                            <p>Bring the glitz of Monte Carlo to your own venue &mdash; professional casino tables, expert croupiers and a night of play-for-fun glamour your guests will be talking about for weeks.</p>
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
<section class="inner-top-section-style-1">
    <div class="container">
        <div class="main-block">
            <div class="row">
                <div class="col-lg-7">
                    <div class="left-block">
                        <h3 class="title-dark-1">Let&rsquo;s Get This Casino Party Started</h3>
                        <p>OMG Entertainment brings full-sized, professional casino tables and entertainment-skilled croupiers straight to your venue. From Blackjack and Roulette to Poker, Craps and the Money Wheel, every table runs on premium Australian-made equipment for a genuinely premium casino night &mdash; with a transparent, what-you-see-is-what-you-get approach to pricing and setup.</p>
                        <div class="img-wrapper">
                            <img src="<?php echo esc_url( OMG_HYBRID_URI . '/assets/images/casino-roulette-table.jpg' ); ?>" alt="OMG Entertainment roulette wheel and chip stacks on a branded casino table" class="img-fluid-cover" width="1600" height="1200" loading="lazy"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="right-block">
                        <ul>
                            <li>
                                <h4>Full-Sized Professional Tables</h4>
                                <p>Blackjack, Roulette, Poker, Baccarat, Craps, Sic Bo and the Money Wheel &mdash; all on premium Australian-made equipment.</p>
                            </li>
                            <li>
                                <h4>Entertainment-Skilled Croupiers</h4>
                                <p>Our dealers bring over 100 years of combined experience and are chosen for personality as much as skill.</p>
                            </li>
                            <li>
                                <h4>Play-For-Fun Format</h4>
                                <p>Guests play with &ldquo;funny money&rdquo; or unlimited chips, so everyone enjoys the tables with zero real-money risk.</p>
                            </li>
                            <li>
                                <h4>Optional Awards Ceremony</h4>
                                <p>Finish the night crowning your top players across a few cheeky award categories.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =====intro section end===== -->


<!-- =====event types section start===== -->
<section class="who-we-are-section event-types-section">
    <div class="container">
        <div class="heading">
            <h3 class="title-dark-1 text-center">Perfect For Every Occasion</h3>
            <p>From boardrooms to backyards, our casino nights are built around your event.</p>
        </div>
        <div class="box-container">
            <div class="row justify-content-center">
                <div class="col-sm-6 col-lg-3">
                    <div class="box">
                        <div class="icon-wrapper"><i class="fa-solid fa-briefcase fa-2x" style="color: var(--primary-solid-color);"></i></div>
                        <h3>Corporate Events</h3>
                        <p>A high-energy way to reward staff, entertain clients or break the ice at conferences and product launches.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="box">
                        <div class="icon-wrapper"><i class="fa-solid fa-hand-holding-heart fa-2x" style="color: var(--primary-solid-color);"></i></div>
                        <h3>Fundraisers &amp; Charity Nights</h3>
                        <p>A proven way to raise funds for clubs, schools and charities, with full event-planning support included.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="box">
                        <div class="icon-wrapper"><i class="fa-solid fa-champagne-glasses fa-2x" style="color: var(--primary-solid-color);"></i></div>
                        <h3>Weddings &amp; Birthdays</h3>
                        <p>Add a playful, unforgettable twist to your reception or milestone celebration.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="box">
                        <div class="icon-wrapper"><i class="fa-solid fa-dice fa-2x" style="color: var(--primary-solid-color);"></i></div>
                        <h3>Bucks &amp; Hens Nights</h3>
                        <p>Customisable tables and cheeky extras to make the guest of honour&rsquo;s night one to remember.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =====event types section end===== -->

<!-- =====our products section start===== -->
<?php
// "Our Products" from the /omg-entertainment/ landing, minus this page's
// own card (client task-009, 2026-10-01), titled "Other Products" here
// (client task-014). Legacy-layer styles: end of legacy-styles.css.
get_template_part( 'template-parts/omg-entertainment/our-products', null, array(
	'exclude' => array( 'casino' ),
	'heading' => 'Other Products',
) );
?>
<!-- =====our products section end===== -->


<!-- =====why choose section start===== -->
<?php
// "Why Choose" band copied verbatim from the OMG Entertainment landing
// (PAGE 1.0 — template-parts/omg-entertainment-layout.php): same heading,
// bullets and CTA buttons, plus this page's own closing line above the
// buttons (client 2026-09-17). Legacy-layer styles: end of legacy-styles.css.
get_template_part( 'template-parts/sections/why-choose', null, array(
	'heading' => 'Why Choose OMG Entertainment?',
	'bullets' => array(
		'Full-sized, Australian-made casino equipment',
		'Entertainment-skilled, experienced croupiers',
		'Transparent, what-you-see-is-what-you-get pricing',
		'Fully customisable game &amp; performer selection',
		'Add-on props, DJ, photo booth &amp; performers',
		'Fully insured with $20 million public liability cover',
	),
	'body'    => 'Let OMG Entertainment turn your next event into an unforgettable casino night.',
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
// "Other Services" — full 5-division grid, same component/content as the
// home page (client 2026-09-29 — was a 4-card subset excluding this brand).
get_template_part( 'template-parts/omg-entertainment/home-divisions', null, array(
	'heading'     => 'Other Services',
	'description' => 'Why stop there? Take your event to the next level with our full suite of event services &mdash; from high-energy DJs and live music to booths, photography and full styling, all under one roof.',
) );
?>
<!-- =====other services section end===== -->


<?php
// Logo grid before the footer — matches the OMG Entertainment landing
// (PAGE 1.0) "Best Brands" block (client 2026-09-17). Styles for the
// legacy layer live at the end of legacy-styles.css.
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

<?php
// Testimonials below the logo grid, as on /omg-entertainment/ (client
// task-009, 2026-10-01).
get_template_part( 'template-parts/omg-entertainment/testimonials' );
?>

<!-- CTA moved below the logo grid (client task-008, 2026-09-30). -->
<!-- =====Cta section start===== -->
<section class="cta-section">
    <div class="container">
        <div class="main-block">
            <h3 class="title-dark-2">Ready To Deal You In?</h3>
            <p>Casino fun nights start from $999 &mdash; get in touch for a free, no-obligation quote.</p>
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
