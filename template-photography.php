<?php 
/*
*Template Name: Photography Page
*/
?>
<?php get_header(); ?>




<!-- =====hero section start===== -->
<?php
$hero_sliders = get_field('hero_sliders');
?>

<section class="hero-section inner-page">
    <div class="main-block">

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                <?php if($hero_sliders): ?>
                    <?php foreach($hero_sliders as $hero_slider): 

                        $title = $hero_slider['title'];
                        $description = $hero_slider['description'];
                        $image = $hero_slider['image'];

                    ?>

                    <div class="swiper-slide">
                        <div class="single-slide hero-gradient"
                             style="background:url('<?php echo $image['url']; ?>') no-repeat center center / cover;">

                            <div class="container">
                                <h1><?php echo $title; ?></h1>
                                <p><?php echo $description; ?></p>
                            </div>

                        </div>
                    </div>

                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

            <div class="swiper-pagination line-bullet-style"></div>

        </div>
    </div>
</section>
<!-- =====hero section end===== -->


<section class="photography-page-main-section">
    <div class="container">
        <div class="main-block">
            <?php
                $main_section_heading = get_field('main_section_heading');
                $main_title = $main_section_heading['main_title'];
                $description = $main_section_heading['description'];
            ?>
            <div class="heading">
                <h3 class="title-dark-2"><?php echo $main_title; ?></h3>
                <?php echo $description; ?>
            </div>
            <?php
                $main_section_content = get_field('main_section_content');
                $image = $main_section_content['image'];
                $title = $main_section_content['title'];
                $lists = $main_section_content['lists'];
                $button = $main_section_content['button'];
            ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-block photo-frame-1">
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="img-fluid-cover">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-block">
                        <h4 class="title-dark-2 size-2"><?php echo $title; ?></h4>
                        <div class="strip-list">
                            <ul>
                                <?php
                                    foreach($lists as $list):
                                ?>
                                <li><?php echo $list['list_content']; ?></li>
                                <?php
                                    endforeach;
                                ?>
                            </ul>
                        </div>
						<?php
							if(!empty($button)):
						?>
                        <a href="<?php echo $button['url']; ?>" class="primary-btn-2">
                            <?php echo $button['title']; ?>
                            <svg class="srdev-icon">
                                <use href="<?php echo get_template_directory_uri(); ?>/assets/icons.svg#fancy-right-arrow-icom"></use>
                            </svg>
                        </a>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php 
    $our_others_service_section = get_field('our_others_service_section', 7);
    $main_title                 = $our_others_service_section['main_title'];
    $description                = $our_others_service_section['description'];
    $cards                      = $our_others_service_section['cards'];
?>
<section class="our-others-services-section">
    <div class="container">
        <div class="heading">
            <h3 class="title-dark-1 text-center"><?php echo $main_title; ?></h3>
            <?php echo $description; ?>
        </div>
        <div class="box-container">
            <div class="row justify-content-center">
                <?php 
                    foreach($cards as $card):
                ?>
                <div class="col-sm-6">
                    <a href="<?php echo $card['button'] ['url']; ?>" class="box">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="img-wrapper">
                                     <img src="<?php echo $card['image']['url'] ?? ''; ?>" alt="<?php echo $card['image']['alt'] ?? ''; ?>" >
                                     <div class="logo-wrapper">
                                        <img src="<?php echo $card['logo']['url'] ?? ''; ?>" alt="<?php echo $card['logo']['alt'] ?? ''; ?>">
                                     </div>   
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="content-wrapper">
                                    <h4><?php echo $card['title']; ?></h4>
                                    <p><?php echo $card['description']; ?></p>
                                    <div class="skeleton-btn"><?php echo $card['button'] ['title']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                    endforeach;
                ?>
            </div>
        </div>
    </div>
</section>


<!-- =====logo marque section start===== -->
<section class="logoMarqueeSection">
    <?php 
       $logo_slider_section=get_field('logo_slider_section', 7);
       $sec_title = $logo_slider_section['sec_title'];
    ?>
    <div class="container" id="logoMarqueeSection">
        <h3 class="title-dark-2 text-center"><?php echo $sec_title; ?></h3>
        <div class="default-content-container flex items-center">
        <div class="default-content-container-inner marquee-wrapper marque-1">

            <div class="marquee">

                <?php if ( ! have_rows( 'logo_slider_section', 7 ) ) {
                  return false;
                    }
                    if ( have_rows( 'logo_slider_section', 7 ) ) : ?>
                  <?php while ( have_rows( 'logo_slider_section', 7 ) ) : the_row();
                      if ( have_rows( 'logo_items', 7 ) ) : ?>

                             <?php
                             while ( have_rows( 'logo_items', 7 ) ) : the_row();

                                 $logo_image = get_sub_field( 'logo_image' );
								 $link = get_sub_field( 'link' );
                             ?>
                             
                            <a ><img src="<?php echo $logo_image['url']; ?>" class="marqueelogo"></a>
                             <?php endwhile; ?> 
                      <?php endif; ?>
                  <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
        </div>
    </div>
</section><!-- =====logo marque section end===== -->


<!-- =====Cta section start===== -->
  <section class="cta-section pt-0 d-none">
    <div class="container">
        <div class="main-block">
            <h3 class="title-dark-2">Let’s Capture Your Event Perfectly</h3>
            <p>Ready to book professional photography that delivers stunning results?</p>
            <div class="btn-group">
                <?php
                    $cta_buttons = get_field('cta_buttons', 'option');
    
                    if ($cta_buttons):
                        foreach ($cta_buttons as $index => $cta_button):
    
                            $button = $cta_button['button'];
                            if (!$button) continue;
    
                            $url   = $button['url'];
                            $title = $button['title'];
    
                            // odd / even class
                            $btn_class = ($index % 2 === 0) ? 'primary-btn-2' : 'primary-btn';
                    ?>
                        <a <?php echo srDev_link_validation($url); ?> class="<?php echo esc_attr($btn_class); ?>">
                            <?php echo esc_html($title); ?>
                            <svg class="srdev-icon">
                                <use href="<?php echo get_template_directory_uri(); ?>/assets/icons.svg#fancy-right-arrow-icom"></use>
                            </svg>
                        </a>
                    <?php
                        endforeach;
                    endif;
                    ?>
            
            </div>
        </div>
    </div>
  </section><!-- =====Cta section end===== -->





<?php get_footer(); ?>