<?php
/**
 * Navigation helpers.
 *
 * The header navigation is fully rendered by the omg-mega-menu plugin,
 * which hooks wp_nav_menu() for the 'main-menu' location. This file only
 * provides a safe fallback for the (unlikely) case that the plugin is
 * deactivated, so the header still shows a usable menu instead of nothing.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

/**
 * Render the header menu. If the mega menu plugin is active it takes over
 * via its wp_nav_menu filter; otherwise this outputs a plain menu.
 */
function omg_hybrid_header_nav() {
	wp_nav_menu( array(
		'theme_location' => 'main-menu',
		'container'      => false,
		'menu_class'     => 'oh-nav__list',
		'fallback_cb'    => 'omg_hybrid_header_nav_fallback',
		'depth'          => 2,
	) );
}

/**
 * Fallback when no menu is assigned to 'main-menu' and the mega menu
 * plugin is not intercepting: list top-level pages.
 */
function omg_hybrid_header_nav_fallback() {
	wp_list_pages( array(
		'title_li' => '',
		'depth'    => 2,
		'walker'   => new Walker_Page(),
	) );
}

/**
 * Footer menu (OMG Group Services). Safe no-op when unassigned.
 */
function omg_hybrid_footer_menu( $location ) {
	if ( ! has_nav_menu( $location ) ) {
		return;
	}
	wp_nav_menu( array(
		'theme_location' => $location,
		'container'      => false,
		'menu_class'     => 'oh-footer__menu',
		'depth'          => 1,
		'fallback_cb'    => false,
	) );
}
