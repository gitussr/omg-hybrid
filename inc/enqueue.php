<?php
/**
 * Asset registration.
 *
 * Two layers:
 *   - SHELL + THEME  — the new component system, loaded on new templates.
 *   - LEGACY         — verbatim copies of the previous theme's CSS/JS,
 *                      loaded ONLY on the ported (legacy) templates so they
 *                      render exactly as before.
 *
 * The shared header, footer and Quick Quote panel use `oh-` prefixed
 * classes and are styled by shell.css, which loads on every page, so the
 * chrome is identical on both layers without the two CSS sets colliding.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', 'omg_hybrid_enqueue_assets' );
function omg_hybrid_enqueue_assets() {

	$uri = OMG_HYBRID_URI;
	$dir = OMG_HYBRID_DIR;

	$v = function ( $rel ) use ( $dir ) {
		$path = $dir . $rel;
		return file_exists( $path ) ? (string) filemtime( $path ) : OMG_HYBRID_VERSION;
	};

	$is_legacy = omg_hybrid_is_legacy_template();

	/* --------------------------------------------------------------- */
	/*  Shared — every page                                            */
	/* --------------------------------------------------------------- */
	wp_enqueue_style( 'omg-hybrid-fonts', $uri . '/assets/fonts/style.css', [], $v( '/assets/fonts/style.css' ) );
	// Swiper's own stylesheet — required wherever a .swiper is initialised
	// (new hero/testimonials components and the legacy inner-page hero).
	wp_enqueue_style( 'omg-hybrid-swiper', $uri . '/assets/css/swiper.css', [], $v( '/assets/css/swiper.css' ) );
	wp_enqueue_style( 'omg-hybrid-shell', $uri . '/assets/css/shell.css', [ 'omg-hybrid-fonts' ], $v( '/assets/css/shell.css' ) );

	// Slider library — used by the new hero/testimonials components and by
	// the legacy inner-page hero. Vanilla, no jQuery dependency.
	wp_enqueue_script( 'omg-hybrid-swiper', $uri . '/assets/js/swiper.js', [], $v( '/assets/js/swiper.js' ), true );

	// Shared 6-step Quick Quote wizard controller. The omg-mega-menu plugin
	// enqueues its own script with this exact handle as a dependency —
	// do not rename it.
	wp_enqueue_script( 'book-wizard', $uri . '/assets/js/book-wizard.js', [], $v( '/assets/js/book-wizard.js' ), true );

	wp_enqueue_script(
		'omg-hybrid',
		$uri . '/assets/js/theme.js',
		array( 'book-wizard', 'omg-hybrid-swiper' ),
		$v( '/assets/js/theme.js' ),
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/* --------------------------------------------------------------- */
	/*  New component system — non-legacy templates only               */
	/* --------------------------------------------------------------- */
	if ( ! $is_legacy ) {
		wp_enqueue_style( 'omg-hybrid-app', $uri . '/assets/css/app.css', array( 'omg-hybrid-shell' ), $v( '/assets/css/app.css' ) );
		return;
	}

	/* --------------------------------------------------------------- */
	/*  Legacy layer — ported inner / standalone service pages only    */
	/* --------------------------------------------------------------- */
	// Verbatim copies of the previous theme's stylesheets. Kept at
	// assets/css/ (not a sub-folder) so their `url('../images/…')` refs
	// resolve to assets/images/ exactly as they did in the old theme.
	// Order matters: vendor Bootstrap must load BEFORE legacy-base.css, which
	// is the old theme's reset/base and was authored to sit on top of it
	// (e.g. base's `a { text-decoration: none }` and `*/h/p/ul { margin: 0 }`
	// have to win over Bootstrap 5 Reboot). Deps below enforce that print
	// order.
	$legacy_css = array(
		'omg-legacy-bootstrap'  => array( '/assets/css/legacy-bootstrap.min.css', array( 'omg-hybrid-shell' ) ),
		'omg-legacy-base'       => array( '/assets/css/legacy-base.css', array( 'omg-legacy-bootstrap' ) ),
		'omg-legacy-stellarnav' => array( '/assets/css/legacy-stellarnav.min.css', array() ),
		'omg-legacy-fa'         => array( '/assets/fontawesome-6/css/all.css', array() ),
		'omg-legacy-styles'     => array( '/assets/css/legacy-styles.css', array( 'omg-legacy-base' ) ),
		'omg-legacy-responsive' => array( '/assets/css/legacy-responsive.css', array( 'omg-legacy-styles' ) ),
	);
	foreach ( $legacy_css as $handle => $conf ) {
		wp_enqueue_style( $handle, $uri . $conf[0], $conf[1], $v( $conf[0] ) );
	}

	wp_enqueue_script( 'omg-legacy-bootstrap-js', $uri . '/assets/js/legacy/bootstrap.min.js', array(), $v( '/assets/js/legacy/bootstrap.min.js' ), true );
	wp_enqueue_script( 'omg-legacy-stellarnav-js', $uri . '/assets/js/legacy/stellarnav.min.js', array( 'jquery' ), $v( '/assets/js/legacy/stellarnav.min.js' ), true );
	// LogoMarquee helper (window.LogoMarquee) — legacy inner-page marquees only.
	wp_enqueue_script( 'omg-legacy-marquee', $uri . '/assets/js/legacy/srdev-marque.js', array(), $v( '/assets/js/legacy/srdev-marque.js' ), true );
	wp_enqueue_script(
		'omg-legacy-custom',
		$uri . '/assets/js/legacy/custom.js',
		array( 'jquery', 'omg-hybrid-swiper', 'omg-legacy-stellarnav-js', 'omg-legacy-marquee' ),
		$v( '/assets/js/legacy/custom.js' ),
		true
	);
}

/**
 * The previous theme deregistered core jQuery and shipped its own copy,
 * which caused a double-load with the CDN copy in its footer. Here we just
 * use WordPress core jQuery (3.7.x) everywhere — Gravity Forms, the mega
 * menu plugin and the legacy scripts all expect the `jquery` handle.
 */
add_action( 'wp_enqueue_scripts', 'omg_hybrid_ensure_jquery', 1 );
function omg_hybrid_ensure_jquery() {
	if ( ! is_admin() ) {
		wp_enqueue_script( 'jquery' );
	}
}
