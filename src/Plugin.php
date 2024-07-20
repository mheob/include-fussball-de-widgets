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

use ITSB\IFDW\Backend\BorlabsCookie;
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
	 * Generate the plugin instance.
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
		$this->addAdminActions();
		$this->addActions();
		$this->addFilter();
		$this->addShortcode();
	}

	/**
	 * Configure the one time set settings.
	 *
	 * @since 3.1
	 * @return void
	 */
	private function configureSettings(): void {
		Settings::setHost();
		Settings::setPluginName( plugin_basename( __DIR__ . '/index.php' ) );
	}

	/**
	 * Adds all admin action hooks.
	 *
	 * @since 3.1
	 * @return void
	 */
	private function addAdminActions(): void {
		( new BorlabsCookie() )->addAction( 'admin_init' );
	}

	/**
	 * Adds all action hooks.
	 *
	 * @since 3.1
	 * @return void
	 */
	private function addActions(): void {
		( new BlockEnqueue() )->addAction( 'init' );
		( new FrontendEnqueue() )->addAction( 'init' );
		( new Textdomain() )->addAction( 'plugins_loaded' );
		( new Widgets() )->addAction( 'widgets_init' );
	}

	/**
	 * Adds all filter hooks.
	 *
	 * @since 3.1
	 * @return void
	 */
	private function addFilter(): void {
		( new PluginActions() )->addFilter( 'plugin_row_meta', 2 );
	}

	/**
	 * Adds all shortcode hooks.
	 *
	 * @since 3.1
	 * @return void
	 */
	private function addShortcode(): void {
		( new Fubade() )->addShortcode( 'fubade' );
	}
}
