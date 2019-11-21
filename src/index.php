<?php
/**
 * Plugin Name:  Include Fussball.de Widgets
 * Description:  Easy integration of the Fussball.de widgets (currently in the version since season 2016).
 * Version:      3.1.0
 * Requires PHP: 7.2
 * Author:       IT-Service Böhm -- Alexander Böhm
 * Author URI:   http://profiles.wordpress.org/mheob
 * License:      GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  include-fussball-de-widgets
 * Domain Path:  /languages
 *
 * @package Include_Fussball_De_Widgets
 */

declare( strict_types=1 );
namespace IFDW;

use Exception;
use IFDW\Backend\BorlabsCookie;
use IFDW\Blocks\Enqueue as EnqueueBlocks;
use IFDW\Frontend\Enqueue as EnqueueFrontend;
use IFDW\Shortcodes\Fubade;
use IFDW\Utils\{Host, Logging\ConsoleLogger, PluginActions, Textdomain};
use IFDW\Widgets\Widgets;

defined( 'ABSPATH' ) || exit;

/**
 * Constants
 */

define( 'IFDW_VERSION', '3.1.0' );
define( 'IFDW_URL', __FILE__ );

/**
 * Autoloader for all classes in the plugin.
 *
 * @since 3.0
 *
 * @param callable $className The class to include.
 *
 * @return void
 */
function autoloader( $className ): void {
	if ( false === strpos( $className, __NAMESPACE__ ) ) {
		return;
	}

	$classPath = str_replace( 'IFDW\\', '', $className );
	$path      = __DIR__ . DIRECTORY_SEPARATOR . str_replace( '\\', DIRECTORY_SEPARATOR, $classPath ) . '.php';

	if ( ! class_exists( $className ) && file_exists( $path ) ) {
		require_once $path;
	}
}

try {
	spl_autoload_register( __NAMESPACE__ . '\autoloader' );
} catch ( Exception $e ) {
	ConsoleLogger::getInstance()->errorLog( $e->getMessage() );
}

/*
 * Additional constants after autoloading the classes
 */
// phpcs:disable WordPress.Security.ValidatedSanitizedInput
define( 'IFDW_HOST', Host::cleanHost( wp_unslash( $_SERVER['SERVER_NAME'] ?? null ) ) );
// phpcs:enable

/*
 * Initialize the hooks.
 */

// Backend tools.
BorlabsCookie::getInstance()->addAdminInitAction();

// Block scripts.
EnqueueBlocks::getInstance()->addInitAction();

// Frontend scripts.
EnqueueFrontend::getInstance()->addInitAction();

// Shortcodes.
Fubade::getInstance()->addShortcode();

// Utils.
PluginActions::getInstance()->addPluginRowMetaFilter();
Textdomain::getInstance()->addPluginsLoadedAction();

// Widgets.
Widgets::getInstance()->addWidgetInitAction();

// TODO: [general] Add an admin area for setting up default settings for new entries.
