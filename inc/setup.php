<?php
/**
 * Theme setup — supports, menus, image sizes.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'omg_hybrid_setup' );
function omg_hybrid_setup() {

	load_theme_textdomain( 'omg-hybrid', OMG_HYBRID_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'script',
		'style',
		'navigation-widgets',
	) );

	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
}

/**
 * The mega menu plugin (omg-mega-menu) filters wp_nav_menu for the
 * 'main-menu' location and replaces the output entirely. 'footer' and
 * 'footer-other' are real WordPress menus rendered in the footer.
 */
add_action( 'after_setup_theme', 'omg_hybrid_register_menus' );
function omg_hybrid_register_menus() {
	register_nav_menus( array(
		'main-menu'    => __( 'Header Menu (replaced by OMG Mega Menu plugin)', 'omg-hybrid' ),
		'footer'       => __( 'Footer — OMG Group Services', 'omg-hybrid' ),
		'footer-other' => __( 'Footer — Other', 'omg-hybrid' ),
	) );
}

/**
 * Sidebar kept for parity with the previous theme (single.php / page
 * widget area). Harmless if unused.
 */
add_action( 'widgets_init', 'omg_hybrid_widgets_init' );
function omg_hybrid_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Post Sidebar', 'omg-hybrid' ),
		'id'            => 'post_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}

/**
 * Admin login logo — points at the theme's own asset so nothing breaks
 * if the old themes are deleted.
 */
add_action( 'login_head', 'omg_hybrid_login_logo' );
function omg_hybrid_login_logo() {
	$logo = OMG_HYBRID_URI . '/assets/images/logo-2.png';
	echo '<style>h1 a{background-image:url(' . esc_url( $logo ) . ') !important;background-size:100% auto !important;width:200px !important;height:108px !important;}</style>';
}

/**
 * SVG upload support, admin only (kept from previous theme).
 */
add_filter( 'upload_mimes', 'omg_hybrid_allow_svg' );
function omg_hybrid_allow_svg( $mimes ) {
	if ( current_user_can( 'administrator' ) ) {
		$mimes['svg'] = 'image/svg+xml';
	}
	return $mimes;
}

/**
 * Body classes:
 *  - page-{slug}                (kept from previous theme; some legacy CSS relies on it)
 *  - oh-theme                   on pages rendered with the new component system
 *  - oh-legacy                  on ported pages still using the previous markup/CSS
 *  - svc-{entertainment|studio|live|props}  service colour context
 */
add_filter( 'body_class', 'omg_hybrid_body_classes' );
function omg_hybrid_body_classes( $classes ) {
	global $post;

	if ( $post instanceof WP_Post ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}

	if ( omg_hybrid_is_legacy_template() ) {
		$classes[] = 'oh-legacy';
	} else {
		$classes[] = 'oh-theme';
	}

	$svc = omg_hybrid_current_service_class();
	if ( $svc ) {
		$classes[] = $svc;
	}

	return array_values( array_unique( $classes ) );
}
