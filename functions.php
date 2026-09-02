<?php
/**
 * OMG Hybrid — theme bootstrap.
 *
 * This file only wires up the pieces. Real logic lives in inc/.
 *
 * @package omg-hybrid
 */

defined( 'ABSPATH' ) || exit;

define( 'OMG_HYBRID_VERSION', '1.0.0' );
define( 'OMG_HYBRID_DIR', get_template_directory() );
define( 'OMG_HYBRID_URI', get_template_directory_uri() );

require_once OMG_HYBRID_DIR . '/inc/helpers.php';
require_once OMG_HYBRID_DIR . '/inc/migrate.php';
require_once OMG_HYBRID_DIR . '/inc/setup.php';
require_once OMG_HYBRID_DIR . '/inc/services.php';
require_once OMG_HYBRID_DIR . '/inc/brand-services.php';
require_once OMG_HYBRID_DIR . '/inc/template-legacy.php';
require_once OMG_HYBRID_DIR . '/inc/enqueue.php';
require_once OMG_HYBRID_DIR . '/inc/nav-menus.php';
require_once OMG_HYBRID_DIR . '/inc/theme-options.php';
require_once OMG_HYBRID_DIR . '/inc/security.php';
