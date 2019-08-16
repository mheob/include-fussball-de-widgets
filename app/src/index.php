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

namespace IFDW;

use Exception;
use IFDW\Backend\BorlabsCookie;
use IFDW\Blocks\Enqueue as EnqueueBlocks;
use IFDW\Frontend\Enqueue as EnqueueFrontend;
use IFDW\Shortcodes\Fubade;
use IFDW\Utils\{PluginActions, Textdomain};
use IFDW\Widgets\Widgets;

defined( 'ABSPATH' ) || exit;

/**
 * Autoloader for all classes in the plugin.
 *
 * @param callable $class The class to include.
 *
 * @since 3.0
 */
/** @noinspection PhpUnused */
function autoloader( $class ) {
  /* Only autoload classes from this namespace */
  if ( false === strpos( $class, __NAMESPACE__ ) ) {
    return;
  }

  $classPath = str_replace( 'IFDW\\', '', $class );
  $path      = __DIR__ . '/' . str_replace( '\\', '/', $classPath ) . '.php';

  if ( ! class_exists( $class ) && file_exists( $path ) ) {
    /** @noinspection PhpIncludeInspection */
    require $path;
  }
}

try {
  spl_autoload_register( __NAMESPACE__ . '\autoloader' );
} catch ( Exception $e ) {
  // TODO: Log the error to a file or other storage.
  echo $e->getMessage();
}

/**
 * Constants
 */
define( 'IFDW_VERSION', '3.0.0' );
define( 'IFDW_URL', __FILE__ );
define( 'IFDW_HOST', isset( $_SERVER['SERVER_NAME'] ) ? wp_unslash( $_SERVER['SERVER_NAME'] ) : '' );

/**
 * Initialize.
 */

// Utils.
PluginActions::getInstance()->addPluginRowMetaFilter();
Textdomain::getInstance()->addPluginsLoadedAction();

// Backend tools.
BorlabsCookie::getInstance()->addAdminInitAction();

// Block scripts.
EnqueueBlocks::getInstance()->addInitAction();

// Frontend scripts.
EnqueueFrontend::getInstance()->addInitAction();

// Shortcodes.
Fubade::getInstance()->addShortcode();

// Widgets.
Widgets::getInstance()->addWidgetInitAction();
