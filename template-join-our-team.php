<?php 
/*
*Template Name: Join Our Team Page
*/
?>
<?php get_header(); ?>




<!-- =====hero section start===== -->
<section class="hero-section inner-page">
    <?php 
       $banner_section=get_field('banner_section');
       $banner_image=$banner_section['banner_image'];
       $banner_title=$banner_section['banner_title'];
       $banner_content=$banner_section['banner_content'];
    ?>
    <div class="main-block">
        <!-- Swiper slider -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="single-slide" style="background: url('<?php echo $banner_image['url']; ?>') no-repeat; background-size: cover; background-position: center;">
                        <div class="container">
                            <h1><?php echo $banner_title; ?></h1>
                            <p><?php echo $banner_content; ?></p>
                            <!-- <div class="d-flex justify-content-center">
                                <a href="#" class="primary-btn">Apply Today<svg class="srdev-icon"><use href="<?php // echo get_template_directory_uri(); ?>/assets/icons.svg#fancy-right-arrow-icom"></use></svg></a>
                            </div> -->
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
<section class="inner-top-section-style-1">
    <div class="container">
        <?php 
           $after_banner_section=get_field('after_banner_section');
           $left_block_title=$after_banner_section['left_block_title'];
           $left_block_content=$after_banner_section['left_block_content'];
           $left_block_image=$after_banner_section['left_block_image'];
        ?>
        <div class="main-block">
            <div class="row">
                <div class="col-lg-7">
                    <div class="left-block">
                        <h3 class="title-dark-1"><?php echo $left_block_title; ?></h3>
                        <?php if ($left_block_content): ?>
                            <?php echo $left_block_content; ?>
                        <?php endif; ?>
                        <div class="img-wrapper">
                            <img src="<?php echo $left_block_image['url']; ?>" alt="<?php echo $left_block_image['alt']; ?>" class="img-fluid-cover"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="right-block">
                        <ul>
                            <?php if ( ! have_rows( 'after_banner_section' ) ) {
                              return false;
                                }
                                if ( have_rows( 'after_banner_section' ) ) : ?>
                              <?php while ( have_rows( 'after_banner_section' ) ) : the_row();
                                  if ( have_rows( 'right_block_items' ) ) : ?>

                                         <?php
                                         while ( have_rows( 'right_block_items' ) ) : the_row();

                                             $item_title = get_sub_field( 'item_title' );
                                             $item_text = get_sub_field( 'item_text' );
                                         ?>
                                         
                                        <li>
                                            <h4><?php echo $item_title; ?></h4>
                                            <p><?php echo $item_text; ?></p>
                                        </li>

                                         <?php endwhile; ?> 
                                  <?php endif; ?>
                              <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- =====inner top section style 1 end===== -->

<!-- =====form widget start===== -->
<section class="form-section-widget">
    <div class="container">
        <div class="main-block">
            <h3 class="title-dark-1"><?php the_field("form_title") ?></h3>

            <div class="team-page-forms">
				<?php // echo do_shortcode('[contact-form-7 id="7ee705d" title="Join Our Team"]'); ?>
				<?php echo do_shortcode('[gravityform id="2" title="false" ajax="true"]'); ?>
            </div>

        </div>
    </div>
</section><!-- =====form widget end===== -->





<!-- =====logo marque section start===== -->
<section class="logoMarqueeSection">
    <?php 
       $logo_slider_section=get_field('logo_slider_section', '7');
       $sec_title=$logo_slider_section['sec_title'];
    ?>
    <div class="container" id="logoMarqueeSection">
        <h3 class="sub-title-dark text-center"><?php echo $sec_title; ?></h3>
        <div class="default-content-container flex items-center">
        <div class="default-content-container-inner marquee-wrapper marque-1">

            <div class="marquee">

                <?php if ( ! have_rows( 'logo_slider_section', '7' ) ) {
                  return false;
                    }
                    if ( have_rows( 'logo_slider_section', '7' ) ) : ?>
                  <?php while ( have_rows( 'logo_slider_section', '7' ) ) : the_row();
                      if ( have_rows( 'logo_items' ) ) : ?>

                             <?php
                             while ( have_rows( 'logo_items' ) ) : the_row();

                                 $logo_image = get_sub_field( 'logo_image' );
                             ?>
                             
                            <a><img src="<?php echo $logo_image['url']; ?>" class="marqueelogo"></a>
                             <?php endwhile; ?> 
                      <?php endif; ?>
                  <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
        </div>
    </div>
</section>
<!-- =====logo marque section end===== -->




<?php get_footer(); ?>