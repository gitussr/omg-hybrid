<?php
/**
 * Security / hygiene — additive hardening ported from the previous theme.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

/* -------------------------------------------------------------------------
 *  Never render PHP notices/warnings into the front-end for visitors.
 *
 *  Matches production php.ini behaviour (display_errors = Off). Some of
 *  the ported legacy templates reference a few undefined vars in hidden
 *  (`d-none`) dead sections; this keeps that from leaking onto the page
 *  in environments where display_errors is On (e.g. local Laragon).
 *  Admins/logged-in users and WP_DEBUG are unaffected.
 * ---------------------------------------------------------------------- */
if ( ! ( defined( 'WP_DEBUG' ) && WP_DEBUG ) && ! is_admin() ) {
	add_action( 'wp', 'omg_hybrid_hide_frontend_errors' );
}
function omg_hybrid_hide_frontend_errors() {
	if ( ! is_user_logged_in() ) {
		@ini_set( 'display_errors', '0' ); // phpcs:ignore
	}
}

/* -------------------------------------------------------------------------
 *  Trim wp_head
 * ---------------------------------------------------------------------- */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );

/* -------------------------------------------------------------------------
 *  Baseline response headers (purely additive; no render impact)
 * ---------------------------------------------------------------------- */
add_action( 'send_headers', 'omg_hybrid_security_headers' );
function omg_hybrid_security_headers() {
	if ( is_admin() || headers_sent() ) {
		return;
	}
	header( 'X-Content-Type-Options: nosniff' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
}

/*
 * The previous theme's header.php emitted ~18 Cloudflare / proxy
 * cache-bypass headers on every front-end request (Cache-Control:
 * no-store, Vary: *, a randomised ETag, etc.). It was ported here and
 * quarantined during the rebuild, then removed in Phase 7 — it defeated
 * page caching site-wide with no clear reason. Caching is handled by
 * LiteSpeed Cache. If specific pages ever need to bypass cache, do it
 * surgically there rather than globally.
 */

/* -------------------------------------------------------------------------
 *  Disable the emoji detection payload
 * ---------------------------------------------------------------------- */
add_action( 'init', 'omg_hybrid_disable_emojis' );
function omg_hybrid_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', function ( $plugins ) {
		return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
	} );
	add_filter( 'wp_resource_hints', function ( $urls, $relation_type ) {
		if ( 'dns-prefetch' === $relation_type ) {
			$svg  = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/15.1.0/svg/' );
			$urls = array_diff( $urls, array( $svg ) );
		}
		return $urls;
	}, 10, 2 );
}

/* -------------------------------------------------------------------------
 *  Gravity Forms — allow <h3>/<br> typed into a field Label to render as
 *  real markup (GF escapes labels). Ported verbatim; the Contact form
 *  relies on it.
 * ---------------------------------------------------------------------- */
add_filter( 'gform_field_content', 'omg_hybrid_gform_render_label_heading', 10, 2 );
function omg_hybrid_gform_render_label_heading( $content, $field ) {
	if ( false === strpos( $content, '&lt;h3&gt;' ) && false === strpos( $content, '&lt;br&gt;' ) ) {
		return $content;
	}
	return preg_replace_callback(
		'/(<(?:legend|label)\b[^>]*>)(.*?)(<\/(?:legend|label)>)/is',
		function ( $m ) {
			$inner = preg_replace( '/&lt;h3&gt;(.*?)&lt;\/h3&gt;/is', '<h3 class="gfield-legend-heading">$1</h3>', $m[2] );
			$inner = str_ireplace( '&lt;br&gt;', '<br>', $inner );
			return $m[1] . $inner . $m[3];
		},
		$content
	);
}

/* -------------------------------------------------------------------------
 *  Reject SVG uploads that carry executable content (admin-only uploads
 *  are already gated in setup.php). Pattern-based safety net.
 * ---------------------------------------------------------------------- */
add_filter( 'wp_handle_upload_prefilter', 'omg_hybrid_block_unsafe_svg' );
function omg_hybrid_block_unsafe_svg( $file ) {
	if ( empty( $file['type'] ) || 'image/svg+xml' !== $file['type'] ) {
		return $file;
	}
	if ( empty( $file['tmp_name'] ) || ! file_exists( $file['tmp_name'] ) ) {
		return $file;
	}
	$contents = file_get_contents( $file['tmp_name'] ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	if ( false !== $contents && preg_match( '/<\s*script|on\w+\s*=|javascript\s*:|<!ENTITY/i', $contents ) ) {
		$file['error'] = __( 'This SVG contains potentially unsafe content and cannot be uploaded.', 'omg-hybrid' );
	}
	return $file;
}
