<?php
/*
*Template Name: Horse Racing Fun Nights Page
*/
?>
<?php get_header(); ?>


<!-- =====hero section start===== -->
<section class="hero-section inner-page">
    <div class="main-block">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php // Client 2026-10-10: "5 Star Entertainment" banner leads every inner service banner. ?>
                <?php omg_hybrid_legacy_lead_slide(); ?>
                <?php // Slide 2 image replaced by the client's new banner (2026-10-10; was uploads/2026/09/horse-racing-fun-night-page-banner.jpg). ?>
                <div class="swiper-slide">
                    <div class="single-slide hero-scrim" style="background: url('<?php echo esc_url( OMG_HYBRID_URI . '/assets/images/horse-racing-fun-night-page-banner-new.jpg' ); ?>') no-repeat; background-size: cover; background-position: center;">
                        <div class="container">
                            <h1>Horse Racing Fun Nights</h1>
                            <p>Bring the thrill of the track to your venue &mdash; live race simulations, a professional MC and your very own bookies, with zero need for an actual racecourse.</p>
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
                        <h3 class="title-dark-1">HORSE RACING FUN NIGHTS</h3>
                        <?php /* Animated racehorse + "Giddy Up" under the heading (client 2026-09-25). */ ?>
                        <div class="giddy-up">
                            <img src="<?php echo esc_url( OMG_HYBRID_URI . '/assets/images/animated-horse-race-jockey.gif' ); ?>" width="116" height="57" alt="" loading="lazy">
                            <span class="giddy-up__text">Giddy Up</span>
                        </div>
                        <p>Skip the racecourse and bring the atmosphere of a big race day straight to your event. Our Horse Racing Fun Nights combine live race simulations, professional entertainment and a fully customisable, dress-up-friendly experience for guests of every age.</p>
                        <?php /* Vimeo embed replaces the still image in this slot (client 2026-09-23). */ ?>
                        <div class="img-wrapper img-wrapper--video">
                            <iframe title="vimeo-player" src="https://player.vimeo.com/video/120264675?h=72c78321f8" width="640" height="360" frameborder="0" referrerpolicy="strict-origin-when-cross-origin" allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="right-block">
                        <ul>
                            <li>
                                <h4>Live Race Simulations</h4>
                                <p>Every race is high-energy, hilarious and 100% no racecourse required.</p>
                            </li>
                            <li>
                                <h4>Professional MC</h4>
                                <p>Our resident race caller keeps the energy and laughs running between every race.</p>
                            </li>
                            <li>
                                <h4>Your Own Bookies</h4>
                                <p>Guests place bets with funny money through our professional &ldquo;bookies,&rdquo; with betting slips and payouts included.</p>
                            </li>
                            <li>
                                <h4>Optional Best-Dressed Prizes</h4>
                                <p>Add a King or Queen of the Track award, or a best-hat competition, for extra race-day flair.</p>
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
            <p>A racing theme guests genuinely look forward to, whatever the event.</p>
        </div>
        <div class="box-container">
            <div class="row justify-content-center">
                <div class="col-sm-6 col-lg-3">
                    <div class="box">
                        <div class="icon-wrapper"><i class="fa-solid fa-people-group fa-2x" style="color: var(--primary-solid-color);"></i></div>
                        <h3>Corporate Events</h3>
                        <p>Team building, product launches and networking, all wrapped up in a hilarious shared experience between races.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="box">
                        <div class="icon-wrapper"><i class="fa-solid fa-hand-holding-heart fa-2x" style="color: var(--primary-solid-color);"></i></div>
                        <h3>Fundraisers &amp; Charity Nights</h3>
                        <p>A professional, money-raising alternative for clubs, schools and charities.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="box">
                        <div class="icon-wrapper"><i class="fa-solid fa-martini-glass-citrus fa-2x" style="color: var(--primary-solid-color);"></i></div>
                        <h3>Bucks &amp; Hens Nights</h3>
                        <p>Personalised surprises for the guest of honour, including custom horse naming.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="box">
                        <div class="icon-wrapper"><i class="fa-solid fa-champagne-glasses fa-2x" style="color: var(--primary-solid-color);"></i></div>
                        <h3>Weddings &amp; Parties</h3>
                        <p>Encourage race-day dress codes and add a fresh, festive energy to your celebration.</p>
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
	'exclude' => array( 'horse-racing' ),
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
	'body'    => 'Let OMG Entertainment bring race day to your next event &mdash; no track required.',
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
            <h3 class="title-dark-2">Ready To Hit The Track?</h3>
            <p>Get in touch for a free, no-obligation quote.</p>
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
