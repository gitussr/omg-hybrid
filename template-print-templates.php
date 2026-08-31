<?php 
/*
*Template Name: Print Templates Page
*/
?>
<?php get_header(); ?>




<!-- =====hero section start===== -->
 <?php
    $hero_section = get_field('hero_section');
    $page_title = $hero_section['page_title'];
    $page_thumbnail = $hero_section['page_thumbnail'];
 ?>
<section class="hero-section inner-page">
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

<?php
$group = get_field('photo_booth_templates');
$title = $group['title'];
$lists = $group['lists'];
$short_description = $group['short_description'];
?>
<section class="print-template-inner-main-section">
    <div class="container">
        <div class="head">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <h3 class="title-dark-1"><?php echo $title;?></h3>
                </div>
                <div class="col-lg-6">
                    <div class="number-list">
                        <ul>
                            <?php
                                $index = 1;
                                foreach($lists as $list):
                            ?>
                            <li><div class="num"><?php echo $index;?></div><span><?php echo $list['list_content'];?></span></li>
                            <?php $index++; endforeach;?>
                        </ul>
                    </div>
                    <p><?php echo $short_description;?></p>
                </div>
            </div>
        </div>


<?php 
if( $group && !empty($group['templates']) ):

    $rows = $group['templates'];

    $booths = [];
    $themes = [];

    foreach( $rows as $row ) {

        if( !empty($row['booth']) ) {
            foreach( $row['booth'] as $booth ) {
                if( !isset($booths[$booth['value']]) ) {
                    $booths[$booth['value']] = $booth['label'];
                }
            }
        }

        if( !empty($row['theme']) ) {
            foreach( $row['theme'] as $theme ) {
                if( !isset($themes[$theme['value']]) ) {
                    $themes[$theme['value']] = $theme['label'];
                }
            }
        }
    }

    // Get first booth and theme values for default active state
    reset($booths);
    $first_booth = key($booths);

    reset($themes);
    $first_theme = key($themes);
?>

<!-- ================= TABS ================= -->

<div class="tab-pill-wrapper">
    <div class="tab-child-pill-wrapper">

        <!-- BOOTH -->
        <div class="booth-pill-wrapper both-pill-wrapper">
            <h4>Choose Booth:</h4>
            <ul class="nav nav-pills booth-tabs">
                <?php $i = 0; foreach($booths as $value => $label): ?>
                    <li class="nav-item">
                        <button class="nav-link <?php echo $i === 0 ? 'active' : ''; ?>"
                                data-filter-type="booth"
                                data-value="<?php echo esc_attr($value); ?>">
                            <?php echo esc_html($label); ?>
                        </button>
                    </li>
                <?php $i++; endforeach; ?>
            </ul>
        </div>

        <!-- THEME -->
        <div class="theme-pill-wrapper both-pill-wrapper">
            <h4>Choose Theme:</h4>
            <ul class="nav nav-pills theme-tabs">
                <?php $i = 0; foreach($themes as $value => $label): ?>
                    <li class="nav-item">
                        <button class="nav-link <?php echo $i === 0 ? 'active' : ''; ?>"
                                data-filter-type="theme"
                                data-value="<?php echo esc_attr($value); ?>">
                            <?php echo esc_html($label); ?>
                        </button>
                    </li>
                <?php $i++; endforeach; ?>
            </ul>
        </div>

    </div>
</div>


<!-- ================= PRODUCTS ================= -->

<div class="row product-parent-wrapper">
    <div class="col-lg-4 col-md-8">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/print-template-product-left-img.jpg" class="img-fluid-cover photo-frame-1">
    </div>

    <div class="col-lg-8 justy-content-center d-flex">
        <div class="row" id="filter-grid">

            <?php foreach( $rows as $row ):

                $booth_values = [];
                $theme_values = [];

                if( !empty($row['booth']) ) {
                    foreach($row['booth'] as $booth) {
                        $booth_values[] = $booth['value'];
                    }
                }

                if( !empty($row['theme']) ) {
                    foreach($row['theme'] as $theme) {
                        $theme_values[] = $theme['value'];
                    }
                }

                // Pre-check if this item matches default filters
                $booth_match = in_array($first_booth, $booth_values);
                $theme_match = in_array($first_theme, $theme_values);
                $default_display = ($booth_match && $theme_match) ? '' : 'none';

            ?>
                <div class="col-lg-3 col-sm-4 col-6 filter-item"
                    data-booth="<?php echo esc_attr( implode(' ', $booth_values) ); ?>"
                    data-theme="<?php echo esc_attr( implode(' ', $theme_values) ); ?>"
                    style="display: <?php echo $default_display; ?>">

                    <div class="productx">

                        <?php if( !empty($row['image']) ): ?>
                            <div class="img-wrapper">
                                <img src="<?php echo esc_url($row['image']); ?>" alt="" class="img-fluid">
                            </div>
                        <?php endif; ?>

                        <?php if( !empty($row['title']) ): ?>
                            <h5><?php echo esc_html($row['title']); ?></h5>
                        <?php endif; ?>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>

<?php endif; ?>
    </div>
</section>

<?php 
    $our_others_service_section = get_field('our_others_service_section', 7);
    $main_title = $our_others_service_section['main_title'];
    $description = $our_others_service_section['description'];
    $cards = $our_others_service_section['cards'];
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

<script>
document.addEventListener("DOMContentLoaded", function () {

    const buttons = document.querySelectorAll(".nav-pills .nav-link");
    const items   = document.querySelectorAll(".filter-item");

    // Read initial active filters from whichever buttons are marked active
    let activeFilters = {
        booth: document.querySelector('[data-filter-type="booth"].active')?.dataset.value || null,
        theme: document.querySelector('[data-filter-type="theme"].active')?.dataset.value || null
    };

    function filterItems() {
        items.forEach(item => {
            const boothData = item.dataset.booth ? item.dataset.booth.trim().split(/\s+/) : [];
            const themeData = item.dataset.theme ? item.dataset.theme.trim().split(/\s+/) : [];

            const boothMatch = !activeFilters.booth || boothData.includes(activeFilters.booth);
            const themeMatch = !activeFilters.theme || themeData.includes(activeFilters.theme);

            item.style.display = (boothMatch && themeMatch) ? '' : 'none';
        });
    }

    buttons.forEach(btn => {
        btn.addEventListener("click", function () {
            const type  = this.dataset.filterType;
            const value = this.dataset.value;

            // Remove active from same group only
            document.querySelectorAll(`[data-filter-type="${type}"]`)
                .forEach(b => b.classList.remove("active"));

            this.classList.add("active");
            activeFilters[type] = value;

            filterItems();
        });
    });

    // No need to call filterItems() here since PHP already sets correct display
    // But call it as safety net in case JS loads before styles apply
    filterItems();
});
</script>



<?php get_footer(); ?>