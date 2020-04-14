<?php declare( strict_types=1 );
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    IT Service Böhm -- Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 IT Service Böhm -- Alexander Böhm
 *
 * ------------------------------------------------------------------------
 *
 * @wordpress-plugin
 * Plugin Name:  Include Fussball.de Widgets
 * Plugin Uri:   https://wordpress.org/plugins/include-fussball-de-widgets/
 * Description:  Easy integration of the Fussball.de widgets.
 * Version:      3.2.0
 * Requires PHP: 7.2
 * Author:       IT Service Böhm -- Alexander Böhm <ab@its-boehm.de>
 * Author URI:   http://profiles.wordpress.org/mheob
 * Text Domain:  include-fussball-de-widgets
 * Domain Path:  /languages
 * License:      GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace ITSB\IFDW;

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

// Call the autoloader.
require_once __DIR__ . '/Infrastructure/Autoloader.php';
( new Infrastructure\Autoloader() )->addNamespace( __NAMESPACE__, __DIR__ )->register();

define( 'IFDW_FILE', __FILE__ );

// Create the plugin instance.
$plugin = PluginFactory::create();
