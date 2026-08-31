<?php 
/*
*Template Name: Photography & Videography
*/
?>
<?php get_header(); ?>


<!-- =====hero section start===== -->
<?php 
	
	$banner_section 	= get_field('banner_section');
	$banner_image 		= $banner_section['banner_image'];
	$banner_title		= $banner_section['banner_title'];
	$banner_subtitle	= $banner_section['banner_subtitle'];

?>

<section class="hero-section inner-page">
    <div class="main-block">

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="single-slide hero-gradient"
                             style="background:url('<?php echo $banner_image['url']?>') no-repeat center center / cover;">

                            <div class="container">
                                <h1><?php echo $banner_title; ?></h1>
                                <p><?php echo $banner_subtitle; ?></p>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="swiper-pagination line-bullet-style"></div>

        </div>
    </div>
</section>
<!-- =====hero section end===== -->



<?php
    $categories_section = get_field('categories_section');
    $main_title 		= $categories_section['main_title'];
    $cards 				= $categories_section['cards'];
?>
<section class="private-party-section">
    <div class="container">
        <?php if(!empty($main_title)) : ?>
        <div class="heading">
            <h2 class="title-dark-1"><?php echo $main_title; ?></h2>
        </div>
        <?php endif; ?>

        <?php
            foreach($cards as $key => $card):
        ?>
        <div class="main-block" id="main-block-<?php echo $key ?>" style="scroll-margin-top: 200px;">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-block ">
                        <div class="topx">
							<?php if(!empty($card['sub_title'])): ?>
							<div class="ribbon">
							  <?php echo $card['sub_title']; ?>
							</div>
							<?php  endif; ?>
                            <h3 class="title-dark-1"><?php echo $card['title']; ?></h3>
                            <?php echo $card['content']; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-block">
                        <div class="img-wrapper photo-frame-1">
                            <img src="<?php echo $card['image']['url']; ?>" alt="<?php echo $card['image']['alt']; ?>" class="img-fluid-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>



<?php
    $features_overview = get_field('features_overview');
?>
<section class="box-section-style-3 d-none">
    <div class="container">
        <div class="main-block">
            <div class="row justify-content-center">
                <?php
                    foreach($features_overview as $features_overviewx):
                ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="box">
                        <div class="icon"><img src="<?php echo $features_overviewx['svg_icon'] ['url']; ?>" alt="" class="img-fluid" ></div>
                        <h3><?php echo $features_overviewx['title']; ?></h3>
                        <p><?php echo $features_overviewx['description']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>


<?php
    // $features_of_booth_section = get_field('features_of_booth_section');
    // $title = $features_of_booth_section['title'];
    // $cards = $features_of_booth_section['cards'];
?>
<section class="we-got-a-plan-section d-none">
    <div class="container">
        <div class="main-block">
            <h3 class="title-dark-1"><?php echo $title; ?></h3>
            <div class="row justify-content-center">
                <?php foreach($cards as $card):?>
                <div class="col-md-6">
                    <div class="box">
                        <div class="top">
                            <h4 class="title-dark-1 size-2"><?php echo $card['title'] ?? '';?></h4>
                            <h5><?php echo $card['list_title'] ?? '';?></h5>
                            <ul>
                                <?php foreach($card['lists'] as $list):?>
                                <li><?php echo $list['list_content'] ?? '';?></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</section>

<?php
//    $photo_gallery_section = get_field('photo_gallery_section');
//    $title = $photo_gallery_section['title']; 
//    $description = $photo_gallery_section['description']; 
//    $galleries = $photo_gallery_section['galleries']; 
?>
<section class="our-photo-booths-section d-none">
    <div class="design-element-2"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/photo-both-design-element-2.png" alt="" class="img-fluid"></div>
    <div class="design-element-3"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/photo-both-design-element-3.png" alt="" class="img-fluid"></div>
    <div class="design-element-5"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/photo-both-design-element-5.png" alt="" class="img-fluid"></div>
    <div class="design-element-6"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/photo-both-design-element-6.png" alt="" class="img-fluid"></div>
    <div class="gallery-block">
        <div class="container">
            <div class="top-block">
                <h3 class="title-dark-1"><?php echo $title;?></h3>
                <p><?php echo $description; ?></p>
            </div>
            <div class="bottom-block">
                <div class="row">
                    <?php foreach($galleries as $gallerie): ?>
                    <div class="col-xl-4 col-md-6">
                        <div class="cardx">
                            <div class="img-wrapper">
                                <img src="<?php echo $gallerie['image']['url'];?>" alt="" class="img-fluid-cover">
                            </div>
                            <h4><?php echo $gallerie['hashtag'];?></h4>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php echo get_template_part('photography-and-videography-remarkable-section'); ?>

















<?php 
    $our_others_service_section = get_field('our_others_service_section', 7);
    $main_title = $our_others_service_section['main_title'];
    $description = $our_others_service_section['description'];
    $cards = $our_others_service_section['cards'];
?>
<section class="our-others-services-section our-booth">
    <div class="container">
        <div class="heading">
            <h3 class="title-dark-1 text-center"><?php echo $main_title; ?></h3>
            <?php echo $description; ?>
        </div>
        <div class="box-container">
            <div class="row justify-content-center">
                <?php 
                    foreach($cards as $key => $card):
                ?>
                <div class="col-sm-6 <?php echo $key === 2 ? 'mt-4' : ''; ?>">
                    <a href="<?php echo $card['button'] ['url']; ?>" class="box">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="img-wrapper">
                                     <img src="<?php echo $card['image'] ['url']; ?>" alt="<?php echo $card['image'] ['alt']; ?>" >
                                     <div class="logo-wrapper">
                                        <img src="<?php echo $card['logo'] ['url']; ?>" alt="<?php echo $card['logo'] ['alt']; ?>">
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


<?php get_footer(); ?>