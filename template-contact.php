<?php 
/*
*Template Name: Contact Page
*/
?>
<?php get_header(); ?>




<!-- =====hero section start===== -->
 <?php
    $hero_section = get_field('hero_section');
    $page_title = $hero_section['page_title'];
    $page_thumbnail = $hero_section['page_thumbnail'];
 ?>
<section class="hero-section inner-page ">
    <div class="main-block">
        <!-- Swiper slider -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="single-slide hero-gradient" style="background: url('<?php echo $page_thumbnail['url']; ?>') no-repeat; background-size: cover; background-position: center;">
                        <div class="container">
                            <h1><?php echo $page_title; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- pagination element -->
            <div class="swiper-pagination line-bullet-style" ></div>
        </div>
    </div>
</section><!-- =====hero section end===== -->

<!-- =====inner top section style 1 start===== -->
<!-- <section class="inner-top-section-style-2">
    <div class="container">
        <div class="main-block">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="title-dark-2 size-2"><?php echo get_field('main_title'); ?></h3>
                </div>
                <div class="col-lg-6">
                    <div class="right-block">
                        <h4><?php echo get_field('note'); ?></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box">
                                    <h5>
                                        <svg class="srdev-icon"><use href="/<?php echo get_template_directory_uri(); ?>/assets/icons.svg#chat-icon"></use></svg>
                                        <span>Contact Us (24<i>X</i>7)</span>
                                    </h5>
                                    <?php 
                                       $contact_details=get_field('contact_details', 'option');
                                       $phone_number=$contact_details['phone_number'];
                                       $email_address=$contact_details['email_address'];
                                    ?>
                                    <ul>
                                        <li><a href="tel:<?php echo $phone_number; ?>"><strong><?php echo $phone_number; ?></strong></a></li>
                                        <li><a href="mailto:<?php echo $email_address; ?>"><?php echo $email_address; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box">
                                    <h5>
                                        <svg class="srdev-icon"><use href="/<?php echo get_template_directory_uri(); ?>/assets/icons.svg#time-icon"></use></svg>
                                        <span>Contact Us (24<i>X</i>7)</span>
                                    </h5>
                                    <ul>
                                        <?php
                                            foreach(get_field('contact_dates') as $contact_date):
                                                $title = $contact_date['title'];
                                                $description = $contact_date['description'];
                                        ?>
                                        <li><strong><?php echo $title; ?></strong>: <?php echo $description; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="desc">
                <?php echo get_field('notice'); ?>
            </div>
        </div>
    </div>
</section> -->
<!-- =====inner top section style 1 end===== -->

<!-- =====inner top section style 1 start===== -->
<section class="inner-top-section-style-2">
    <div class="container">
        <div class="main-block">
            <p class="text-center"><?php echo get_field('notice'); ?></p>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="right-block">
                        <h4 class="text-center"><?php echo get_field('note'); ?></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box">
                                    <h5>
                                        <svg class="srdev-icon d-none"><use href="<?php //echo get_template_directory_uri(); ?>/assets/icons.svg#chat-icon"></use></svg>
                                        <span>Contact Us (24<i>X</i>7)</span>
                                    </h5>
                                    <?php 
                                       $contact_details	=	get_field('contact_details', 'option');
                                       $phone_number	=	$contact_details['phone_number'];
                                       $email_address	=	$contact_details['email_address'];
									   $whatsapp_link	= 	$contact_details['whatsapp_link'];
									   $whatsapp_number	= 	$contact_details['whatsapp_number'];									
                                    ?>
                                    <ul>
                                        <li><a href="tel:<?php echo $phone_number; ?>"><strong><?php echo $phone_number; ?></strong></a></li>
                                        <li><a href="mailto:<?php echo $email_address; ?>"><?php echo $email_address; ?></a></li>
										<li>
											<a href="<?php echo $whatsapp_number; ?>" target="_blank" style="display: inline-flex; align-items: center; gap: 5px;">
												<svg class="srdev-icon" style="fill: #222;">
													<use href="<?php echo get_template_directory_uri(); ?>/assets/icons.svg#whatsapp-omg"></use>
												</svg>
												<?php echo $whatsapp_number; ?>
											</a>
										</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box">
                                    <h5>
                                        <svg class="srdev-icon d-none"><use href="/<?php echo get_template_directory_uri(); ?>/assets/icons.svg#time-icon"></use></svg>
                                        <span>Contact Us (24<i>X</i>7)</span>
                                    </h5>
                                    <ul>
                                        <?php
                                            foreach(get_field('contact_dates') as $contact_date):
                                                $title = $contact_date['title'];
                                                $description = $contact_date['description'];
                                        ?>
                                        <li><strong><?php echo $title; ?></strong>: <?php echo $description; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- =====inner top section style 1 end===== -->

<!-- =====form widgets start===== -->
<section class="form-section-widget">
    <div class="container">
        <div class="main-block">
            <h3 class="title-dark-2">Leave us a message</h3>
            <div class="contact-page-forms">
				<?php echo do_shortcode('[gravityform id="1" title="false" ajax="true"]'); ?>
            </div>
            

        </div>
    </div>
</section>

<!-- =====form widget end===== -->







<?php get_footer(); ?>