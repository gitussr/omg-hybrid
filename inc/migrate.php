<?php
/**
 * One-time migration of theme mods from the previous theme.
 *
 * Theme mods (nav menu location assignments, the custom logo) are stored
 * per-theme (theme_mods_{stylesheet}). When omg-hybrid is activated it
 * starts with none, which would leave the header nav unassigned — and the
 * omg-mega-menu plugin only replaces wp_nav_menu() output when a menu IS
 * assigned to the 'main-menu' location. So on first run we copy the
 * relevant mods across from the old "OMG Not Production" theme.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

define( 'OMG_HYBRID_SOURCE_THEME', 'omg-jeff-demo' );

add_action( 'after_switch_theme', 'omg_hybrid_migrate_theme_mods' );
add_action( 'after_setup_theme', 'omg_hybrid_maybe_migrate_theme_mods', 20 );

function omg_hybrid_maybe_migrate_theme_mods() {
	if ( get_option( 'omg_hybrid_migrated' ) ) {
		return;
	}
	omg_hybrid_migrate_theme_mods();
	update_option( 'omg_hybrid_migrated', OMG_HYBRID_VERSION );
}

function omg_hybrid_migrate_theme_mods() {
	$source = get_option( 'theme_mods_' . OMG_HYBRID_SOURCE_THEME );
	if ( ! is_array( $source ) ) {
		return;
	}

	// Nav menu location assignments (main-menu, footer, footer-other).
	if ( ! empty( $source['nav_menu_locations'] ) && is_array( $source['nav_menu_locations'] ) ) {
		$current = get_theme_mod( 'nav_menu_locations', array() );
		foreach ( $source['nav_menu_locations'] as $location => $menu_id ) {
			if ( empty( $current[ $location ] ) ) {
				$current[ $location ] = $menu_id;
			}
		}
		set_theme_mod( 'nav_menu_locations', $current );
	}

	// Custom logo. Usually a no-op: WordPress stores the logo in the
	// theme-independent `site_logo` option and overrides theme_mod_custom_logo
	// from it, so the logo already carries across themes. This is a fallback
	// for installs where only the old per-theme mod was set.
	if ( ! empty( $source['custom_logo'] ) && ! get_option( 'site_logo' ) && ! get_theme_mod( 'custom_logo' ) ) {
		set_theme_mod( 'custom_logo', (int) $source['custom_logo'] );
	}
}
