<?php
/**
 * Legacy template registry.
 *
 * These page templates were ported VERBATIM from the previous "OMG Not
 * Production" theme (omg-jeff-demo) so the site keeps working with zero
 * changes while the new component system is built out. They still use the
 * previous markup, the previous CSS (assets/css/legacy-*.css) and Secure
 * Custom Fields data.
 *
 * Do not refactor these in Phase 1. Each will be rebuilt on the new
 * component system in its own later phase, at which point it drops off
 * this list.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

/**
 * Template filenames (relative to the theme root) that render with the
 * legacy markup + legacy asset bundle.
 *
 * @return string[]
 */
function omg_hybrid_legacy_templates() {
	return array(
		// Inner pages — out of Phase 1 scope, kept exactly as they were.
		'template-contact.php',
		'template-our-booths.php',
		'template-photography.php',
		'template-videography.php',
		'template-photography-and-videography.php',
		'template-print-templates.php',
		'template-join-our-team.php',
		'template-partner-with-us.php',
		// Standalone service pages — layout instructions come later.
		'template-casino-fun-nights.php',
		'template-horse-racing-fun-nights.php',
		'template-poker-tournaments.php',
		'template-showgirls.php',
		'template-magicians.php',
		'template-elvis-mj-impersonators.php',
	);
}

/**
 * Is the current request rendering through one of the legacy templates?
 */
function omg_hybrid_is_legacy_template() {
	if ( ! is_page() ) {
		return false;
	}
	$slug = get_page_template_slug( get_queried_object_id() );
	return $slug && in_array( $slug, omg_hybrid_legacy_templates(), true );
}
