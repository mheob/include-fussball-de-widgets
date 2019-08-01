<?php
/**
 * Plugin Name:    Include Fussball.de Widgets
 * Description:    Easy integration of the Fussball.de widgets (currently in the version since season 2016).
 * Version:        2.3.0
 * Author:         IT-Service Böhm -- Alexander Böhm
 * Author URI:     http://profiles.wordpress.org/mheob
 * License:        GPLv2
 * License URI:    https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:    include-fussball-de-widgets
 *
 * @package Include_Fussball_De_Widgets
 */

defined( 'ABSPATH' ) || exit;

/**
 * Constants
 */
define( 'IFDW_VERSION', '3.0.0' );
define( 'IFDW_URL', __FILE__ );

/**
 * Includes
 */
/* Gutenberg blocks */
require 'blocks/enqueue.php';

/* Common includes */
require 'includes/borlabs-cookie.php';
require 'includes/widgets.php';

/* Frontend */
require 'includes/front/enqueue.php';

/* Shortcodes */
require 'includes/shortcodes/fubade.php';

/* Widgets */
require 'includes/widgets/class-ifdw-fubade-widget.php';

/**
 * Hooks
 */
/* Admin area */
add_action( 'admin_init', 'ifdw_create_borlabs_cookie_content_blocker' );

/* Common initialize */
add_action( 'init', 'ifdw_register_fubade_api' );
add_action( 'init', 'ifdw_register_dynamic_block' );

/* Widgets */
add_action( 'widgets_init', 'ifdw_widgets_init' );

/**
 * Shortcodes
 */
add_shortcode( 'fubade', 'ifdw_fubade_shortcode' );
