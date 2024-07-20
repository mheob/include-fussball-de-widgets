<?php
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 Alexander Böhm
 */

declare( strict_types=1 );

namespace ITSB\IFDW;

use ITSB\IFDW\Blocks\Enqueue as BlockEnqueue;
use ITSB\IFDW\Frontend\Enqueue as FrontendEnqueue;
use ITSB\IFDW\Shortcodes\Fubade;
use ITSB\IFDW\Utils\{Activation, PluginActions, Settings, Textdomain};
use ITSB\IFDW\Widgets\Widgets;

/**
 * The `Plugin` class is the composition root of the plugin.
 *
 * In here we assemble our infrastructure, configure it for the specific use
 * case the plugin is meant to solve and then kick off the services so that
 * they can hook themselves into the WordPress lifecycle.
 *
 * @since 3.1
 */
final class Plugin {
	/**
	 * Constructs the Plugin class and configures the plugin's settings, actions, filters
	 * and shortcodes.
	 *
	 * This method is responsible for:
	 * - Activating the plugin if the current context is the admin area.
	 * - Configuring the plugin's one-time settings.
	 * - Adding the plugin's actions, filters, and shortcodes.
	 *
	 * @since 3.1
	 */
	public function __construct() {
		// Activate the plugin.
		if ( is_admin() ) {
			( new Activation() )->addActivationHook();
		}

		// Configure the one time set settings.
		$this->configureSettings();

		// Add the hooks.
		$this->addActions();
		$this->addFilter();
		$this->addShortcode();
	}

	/**
	 * Configures the plugin's one-time settings.
	 *
	 * This method sets the host and plugin name for the plugin.
	 *
	 * @since 3.1
	 */
	private function configureSettings(): void {
		Settings::setHost();
		Settings::setPluginName( plugin_basename( __DIR__ . '/index.php' ) );
	}

	/**
	 * Adds all necessary actions for the plugin.
	 *
	 * This method adds the following actions:
	 * - Initializes the block enqueue functionality
	 * - Initializes the frontend enqueue functionality
	 * - Loads the plugin's text domain
	 * - Registers the plugin's widgets
	 *
	 * @since 3.1
	 */
	private function addActions(): void {
		( new BlockEnqueue() )->addAction( 'init' );
		( new FrontendEnqueue() )->addAction( 'init' );
		( new Textdomain() )->addAction( 'plugins_loaded' );
		( new Widgets() )->addAction( 'widgets_init' );
	}

	/**
	 * Adds a filter to the plugin's row meta.
	 *
	 * This method adds a filter to the 'plugin_row_meta' filter hook, which allows the plugin
	 * to add additional metadata to its row in the WordPress plugins list.
	 *
	 * @since 3.1
	 */
	private function addFilter(): void {
		( new PluginActions() )->addFilter( 'plugin_row_meta', 2 );
	}

	/**
	 * Adds a shortcode to the plugin.
	 *
	 * This method adds the 'fubade' shortcode to the plugin, which is handled by the
	 * `Fubade` class.
	 *
	 * @since 3.1
	 */
	private function addShortcode(): void {
		( new Fubade() )->addShortcode( 'fubade' );
	}
}
