<?php
/*
*Template Name: Poker Tournaments Page
*/
?>
<?php get_header(); ?>


<!-- =====hero section start===== -->
<section class="hero-section inner-page">
    <div class="main-block">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="single-slide" style="background: url('<?php echo esc_url( home_url( '/wp-content/uploads/2026/08/omg-entertainment-banner1.jpg' ) ); ?>') no-repeat; background-size: cover; background-position: center;">
                        <div class="container">
                            <h1>Poker Tournaments</h1>
                            <p>Check, raise or fold &mdash; it&rsquo;s your call. From casual social tournaments to full-scale professional events, we bring the tables, the cards and the atmosphere.</p>
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
                        <h3 class="title-dark-1">Check, Raise Or Fold &mdash; It&rsquo;s Your Call</h3>
                        <p>Whether you&rsquo;re after a casual social tournament or a large-scale professional event, our poker nights flex to fit your crowd. Texas Hold&rsquo;Em is our signature game, with Omaha, High/Low, 7 Card Stud and HORSE available on request &mdash; with no limits on time or player numbers.</p>
                        <div class="img-wrapper">
                            <img src="<?php echo esc_url( OMG_HYBRID_URI . '/assets/images/poker-sicbo-table.jpg' ); ?>" alt="OMG Entertainment Sic Bo dice table with casino chips" class="img-fluid-cover" width="1200" height="600" loading="lazy"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="right-block">
                        <ul>
                            <li>
                                <h4>Texas Hold&rsquo;Em &amp; More</h4>
                                <p>Our signature game, plus Omaha, High/Low, 7 Card Stud and HORSE on request.</p>
                            </li>
                            <li>
                                <h4>No Limits</h4>
                                <p>Flexible on time and player numbers, from a handful of guests to a full-scale tournament.</p>
                            </li>
                            <li>
                                <h4>Professional Dealers</h4>
                                <p>Experienced dealers keep every table running smoothly, with extras available for bucks and hens nights on request.</p>
                            </li>
                            <li>
                                <h4>Fully Customisable</h4>
                                <p>From casual cash tables to a structured knockout tournament, we build the format around you.</p>
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
            <p>From a casual social game to a fully structured tournament, we build the night around you.</p>
        </div>
        <div class="box-container">
            <div class="row justify-content-center">
                <div class="col-sm-6 col-lg-3">
                    <div class="box">
                        <div class="icon-wrapper"><i class="fa-solid fa-briefcase fa-2x" style="color: var(--primary-solid-color);"></i></div>
                        <h3>Corporate Events</h3>
                        <p>After-work tournaments, team building and friendly competitor challenges.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="box">
                        <div class="icon-wrapper"><i class="fa-solid fa-hand-holding-heart fa-2x" style="color: var(--primary-solid-color);"></i></div>
                        <h3>Fundraisers &amp; Charity Nights</h3>
                        <p>A unique, money-raising alternative to traditional fundraising formats.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="box">
                        <div class="icon-wrapper"><i class="fa-solid fa-dice fa-2x" style="color: var(--primary-solid-color);"></i></div>
                        <h3>Bucks &amp; Hens Nights</h3>
                        <p>Customisable entertainment packages tailored to the guest of honour.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="box">
                        <div class="icon-wrapper"><i class="fa-solid fa-champagne-glasses fa-2x" style="color: var(--primary-solid-color);"></i></div>
                        <h3>Weddings &amp; Parties</h3>
                        <p>Run a full tournament or set up casual tables guests can drop in and out of.</p>
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
// own card (client task-009, 2026-10-01). Legacy-layer styles: end of
// legacy-styles.css.
get_template_part( 'template-parts/omg-entertainment/our-products', null, array( 'exclude' => array( 'poker' ) ) );
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
	'body'    => 'Let OMG Entertainment deal you into your next event.',
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
            <h3 class="title-dark-2">Ready To Ante Up?</h3>
            <p>Poker packages start from $999 &mdash; get in touch for a free, no-obligation quote.</p>
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
        </div>
    </div>
</section>
<!-- =====Cta section end===== -->

<?php get_footer(); ?>
