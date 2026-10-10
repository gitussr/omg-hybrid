<?php
/**
 * Small shared helpers used by templates and components.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

/**
 * Inline an icon from the theme sprite (assets/icons.svg).
 *
 * @param string $id    Symbol id inside the sprite, without the leading #.
 * @param string $class Extra class(es) for the <svg> element.
 */
function omg_hybrid_icon( $id, $class = '' ) {
	$class = trim( 'srdev-icon ' . $class );
	printf(
		'<svg class="%s" aria-hidden="true" focusable="false"><use href="%s#%s"></use></svg>',
		esc_attr( $class ),
		esc_url( OMG_HYBRID_URI . '/assets/icons.svg' ),
		esc_attr( $id )
	);
}

/**
 * Build a safe href for a phone number, email address or URL, or an empty
 * string for '#' / blank. Ported from the previous theme; the legacy CTA
 * templates call this by name.
 *
 * @return string e.g. href="tel:0400000000"
 */
function srDev_link_validation( $url ) {
	$url = trim( (string) $url );

	if ( '' === $url || '#' === $url ) {
		return '';
	}

	if ( 0 === stripos( $url, 'mailto:' ) ) {
		$email = substr( $url, 7 );
		if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			return 'href="mailto:' . esc_attr( $email ) . '"';
		}
	}

	if ( 0 === stripos( $url, 'tel:' ) ) {
		$clean_tel = preg_replace( '/[^\d\+]/', '', substr( $url, 4 ) );
		if ( preg_match( '/^\+?\d{5,}$/', $clean_tel ) ) {
			return 'href="tel:' . esc_attr( $clean_tel ) . '"';
		}
	}

	$no_scheme     = preg_replace( '#^https?://#i', '', $url );
	$first_segment = explode( '/', $no_scheme, 2 )[0];

	if ( false !== strpos( $first_segment, '@' ) && filter_var( $first_segment, FILTER_VALIDATE_EMAIL ) ) {
		return 'href="mailto:' . esc_attr( $first_segment ) . '"';
	}

	$clean = preg_replace( '/[^\d\+]/', '', $no_scheme );
	if ( preg_match( '/^\+?\d{5,}$/', $clean ) ) {
		return 'href="tel:' . esc_attr( $clean ) . '"';
	}

	return 'href="' . esc_url( $url ) . '"';
}

/**
 * Returns a valid href value for an email or phone string. Ported from the
 * previous theme.
 */
function mytheme_contact_href( $value ) {
	if ( is_email( $value ) ) {
		return 'mailto:' . antispambot( $value );
	}
	$digits = preg_replace( '/[^\d+]/', '', (string) $value );
	return $digits ? 'tel:' . $digits : '';
}

/**
 * Normalise a media reference (ACF image/file array or a bare URL) into
 * { url, type: image|video }. Made global here — in the previous theme it
 * was trapped inside template-home.php. Used by the hero component.
 */
if ( ! function_exists( 'detect_media' ) ) {
	function detect_media( $raw ) {
		if ( empty( $raw ) ) {
			return array( 'url' => '', 'type' => '' );
		}

		if ( is_array( $raw ) ) {
			$url  = $raw['url'] ?? '';
			$mime = $raw['mime_type'] ?? '';
		} else {
			$url  = $raw;
			$mime = '';
		}

		if ( $mime ) {
			$type = false !== strpos( $mime, 'video' ) ? 'video' : 'image';
		} else {
			$ext  = strtolower( pathinfo( wp_parse_url( $url, PHP_URL_PATH ), PATHINFO_EXTENSION ) );
			$type = in_array( $ext, array( 'mp4', 'webm', 'ogg', 'mov' ), true ) ? 'video' : 'image';
		}

		return array( 'url' => $url, 'type' => $type );
	}
}

/**
 * Numbered pagination for custom queries. Ported from the previous theme.
 */
function pagination_bar( $custom_query ) {
	$total_pages = $custom_query->max_num_pages;
	if ( $total_pages <= 1 ) {
		return;
	}
	$big = 999999999;
	echo paginate_links( array( // phpcs:ignore WordPress.Security.EscapeOutput
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $total_pages,
		'prev_text' => '<i class="fa-regular fa-chevron-left"></i>',
		'next_text' => '<i class="fa-regular fa-chevron-right"></i>',
	) );
}

/**
 * Read a field from the Secure Custom Fields "Theme Settings" options page,
 * with a graceful fallback when SCF is not active so the shell never fatals.
 *
 * @param string $key Group/field key on the options page.
 * @return mixed|null
 */
function omg_hybrid_option( $key ) {
	if ( function_exists( 'get_field' ) ) {
		return get_field( $key, 'option' );
	}
	return null;
}

/**
 * The "Other Services" heading stored on the home page (post 7) as the SCF
 * group `our_others_service_section`. Shared by the OMG Studio inner pages
 * (template-our-booths.php, template-photography-and-videography.php),
 * which now render the full 5-division grid (sections/... via
 * template-parts/omg-entertainment/home-divisions.php) instead of a custom
 * card subset, so only the heading is still read from the CMS group.
 *
 * @return array{heading:string,description:string}
 */
function omg_hybrid_page7_other_services() {
	$group = function_exists( 'get_field' ) ? get_field( 'our_others_service_section', 7 ) : array();
	$group = is_array( $group ) ? $group : array();

	return array(
		'heading'     => $group['main_title'] ?? '',
		'description' => '',
	);
}

/**
 * The shared client-logo set: every PNG in assets/images/client-logos/,
 * in filename order (client 2026-09-19). The folder is the logo list for
 * every logo component (sections/marquee.php grid, sections/logo-strip.php);
 * $fallback is only used if the folder is ever emptied.
 *
 * @param string[] $fallback Image URLs to use when the folder has no PNGs.
 * @return string[] Image URLs.
 */
function omg_hybrid_client_logos( $fallback = array() ) {
	$files = glob( OMG_HYBRID_DIR . '/assets/images/client-logos/*.png' );
	if ( ! $files ) {
		return (array) $fallback;
	}
	sort( $files );
	return array_map(
		static function ( $file ) {
			return OMG_HYBRID_URI . '/assets/images/client-logos/' . rawurlencode( basename( $file ) );
		},
		$files
	);
}

/**
 * The logo-marquee bundle stored on the home page (post 7) as the SCF
 * group `logo_slider_section`. Shared by the OMG Studio inner pages.
 * Shaped for template-parts/sections/marquee.php.
 *
 * @return array{title:string,logos:string[]}
 */
function omg_hybrid_page7_marquee() {
	$group = function_exists( 'get_field' ) ? get_field( 'logo_slider_section', 7 ) : array();
	$group = is_array( $group ) ? $group : array();

	$logos = array();
	foreach ( (array) ( $group['logo_items'] ?? array() ) as $item ) {
		if ( ! empty( $item['logo_image']['url'] ) ) {
			$logos[] = $item['logo_image']['url'];
		}
	}

	return array(
		'title' => $group['sec_title'] ?? '',
		'logos' => $logos,
	);
}

/**
 * The three standard call-to-action buttons used across the site
 * (Welcome sections, "Why Choose" blocks): Call Us / Book an Event /
 * Email Us. The first is the primary (solid) action.
 *
 * @return array<int,array{url:string,label:string,solid?:bool}>
 */
function omg_hybrid_cta_buttons() {
	return array(
		array( 'url' => 'tel:1300300664',             'label' => 'Call Us', 'solid' => true ),
		array( 'url' => home_url( '/contact/' ),       'label' => 'Book an Event' ),
		array( 'url' => 'mailto:info@OMGent.com.au', 'label' => 'Email Us' ),
	);
}

/**
 * Short description of each OMG division, as shown on the home page
 * "Our Services" cards. Single source for those cards and for the "Other
 * Services" cards on the brand landing pages (client task-020, 2026-10-06).
 *
 * @param string $division entertainment | studio | live | props | foodbeverage
 * @return string
 */
function omg_hybrid_division_blurb( $division ) {
	$blurbs = array(
		'entertainment' => 'Provides 5-star Entertainment for events big and small. Specializing in Fun Casino Parties, Fun Horse Racing, Poker Tournament, Props/Themes and more.',
		'studio'        => 'DSLR Camera Photo-Booths, 360 Video-Booth, Video Phone-Booth, complemented by our professional event Photography &amp; Videography services.',
		'live'          => 'High-Energy DJs, DJ-Booths, Lighting, Karaoke, Live Music and PA Hire. Our dynamic setups guarantee an immersive, engaging experience for any event.',
		'props'         => 'Transform your Event with Casino Props, Giant Light-Up Letters, Theme Walls, Grand Entrance, Tables, Chairs, Flower Decorations and more.',
		'foodbeverage'  => 'Catering, mobile bars, bartenders and mixologists, plus professional staff hire &mdash; everything to keep your event fed and flowing.',
	);

	return $blurbs[ $division ] ?? '';
}

/**
 * The client's "5 Star Entertainment" banner, first slide on every inner
 * service and sub-service page banner (client 2026-10-10). It carries its
 * own text, so the page title / button and the dark tint stay off it; the
 * page's own slides follow with their usual copy.
 *
 * @return array Slide for template-parts/sections/hero.php.
 */
function omg_hybrid_lead_banner_slide() {
	return array(
		'type'    => 'image',
		'url'     => OMG_HYBRID_URI . '/assets/images/omg-entertainment-new-banner-01.jpg',
		'text'    => false,
		'overlay' => false,
	);
}

/**
 * The same lead banner as a slide for the legacy inner hero
 * (.hero-section .mySwiper). No heading over it, and .hero-lead-banner
 * drops the dark ::after layer (end of shell.css).
 */
function omg_hybrid_legacy_lead_slide() {
	$slide = omg_hybrid_lead_banner_slide();
	?>
	<div class="swiper-slide">
		<div class="single-slide hero-lead-banner" style="background: url('<?php echo esc_url( $slide['url'] ); ?>') no-repeat center center / cover;" role="img" aria-label="OMG 5 Star Entertainment"></div>
	</div>
	<?php
}
