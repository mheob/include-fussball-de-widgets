<?php declare( strict_types=1 );
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    IT Service Böhm -- Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2020 IT Service Böhm -- Alexander Böhm
 */

namespace ITSB\IFDW\Utils;

use ITSB\IFDW\Utils\CheckHelper;

/**
 * The `Activation` class checks if the plugin could activated.
 *
 * @since 3.2
 */
final class Activation {
	/**
	 * The name of the plugin.
	 *
	 * @since 3.2
	 * @var string
	 */
	private $pluginName;

	/**
	 * Set the activation hook for a plugin.
	 *
	 * When a plugin is activated, the action ‘activate_include_fussball_de_widgets’ hook is
	 * called.
	 *
	 * @since 3.2
	 * @param string $file The filename of the plugin including the path.
	 * @return void
	 */
	public function addActivationHook( string $file ): void {
		$this->pluginName = $file;
		register_activation_hook( $this->pluginName, [ $this, 'activate' ] );
	}

	/**
	 * Load the function hooked to the 'activate_PLUGIN' action.
	 *
	 * @since 3.2
	 * @return void
	 */
	public function activate(): void {
		if ( CheckHelper::versionsInvalid( Settings::MIN_WP, Settings::MIN_PHP ) ) {
			add_action( 'admin_notices', 'CheckHelper::createNotice' );
			deactivate_plugins( basename( $this->pluginName ) );
		}
	}
}
