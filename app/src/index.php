<?php
/**
 * Plugin Name: Include Fussball.de Widgets
 * Description: Easy integration of the Fussball.de widgets (currently in the version since season 2016).
 * Version:     3.0.0
 * Author:      IT-Service Böhm -- Alexander Böhm
 * Author URI:  http://profiles.wordpress.org/mheob
 * License:     GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: include-fussball-de-widgets
 * Domain Path: /languages
 *
 * @package Include_Fussball_De_Widgets
 */

defined( 'ABSPATH' ) || exit;

/**
 * Constants
 */
define( 'IFDW_VERSION', '3.0.0' );
define( 'IFDW_URL', __FILE__ );
// phpcs:disable
define( 'IFDW_HOST', isset( $_SERVER['SERVER_NAME'] ) ? wp_unslash( $_SERVER['SERVER_NAME'] ) : '' );
// phpcs:enable

/**
 * Includes
 */
require_once 'blocks/enqueue.php';
require_once dirname( IFDW_URL ) . '/includes/widgets.php'; // Has to be loaded as early as possible.
require_once 'includes/textdomain.php';
require_once 'includes/backend/borlabs-cookie.php';
require_once 'includes/backend/plugin-utilities.php';
require_once 'includes/frontend/enqueue.php';
require_once 'includes/frontend/fubade.php';
require_once 'includes/frontend/logging.php';
require_once 'includes/shortcodes/fubade.php';
require_once 'includes/widgets/class-ifdw-fubade-widget.php';

/**
 * Hooks
 */
add_action( 'admin_init', 'ifdw_create_borlabs_cookie_content_blocker' );
add_action( 'plugins_loaded', 'ifdw_load_textdomain' );
add_action( 'init', 'ifdw_register_fubade_api' );
add_action( 'init', 'ifdw_register_dynamic_block' );
add_action( 'widgets_init', 'ifdw_widgets_init' );
add_filter( 'plugin_row_meta', 'ifdw_plugin_action_links', 10, 2 );

/**
 * Shortcodes
 */
add_shortcode( 'fubade', 'ifdw_fubade_shortcode' );
