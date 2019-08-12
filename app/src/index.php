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

use IFDW\Backend\BorlabsCookie;
use IFDW\Frontend\Enqueue;
use IFDW\Shortcodes\Fubade;
use IFDW\Utils\PluginActions;
use IFDW\Utils\Textdomain;
use IFDW\Widgets\Widgets;

defined( 'ABSPATH' ) || exit;

/**
 * Constants
 */
define( 'IFDW_VERSION', '3.0.0' );
define( 'IFDW_URL', __FILE__ );
define( 'IFDW_HOST', isset( $_SERVER['SERVER_NAME'] ) ? wp_unslash( $_SERVER['SERVER_NAME'] ) : '' );


/**
 * Autoloader for all classes in the plugin.
 *
 * @param callable $class The class to include.
 *
 * @since 3.0.0
 */
/** @noinspection PhpUnused */
function autolader( $class ) {
  $class = str_replace( 'IFDW\\', '', $class );
  $path  = str_replace( '\\', '/', $class ) . '.php';

  if ( ! class_exists( $class ) && file_exists( $path ) ) {
    /** @noinspection PhpIncludeInspection */
    require $path;
  }
}

try {
  spl_autoload_register( 'autoloader' );
} catch ( Exception $e ) {
  echo $e->getMessage();
}


/**
 * Initialize.
 */

// Utils.
new PluginActions();
new Textdomain();

// Backend tools.
new BorlabsCookie();

// Frontend scripts.
new Enqueue();

// Shortcodes.
new Fubade();

// Widgets.
new Widgets();
