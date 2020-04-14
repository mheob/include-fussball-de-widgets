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
	 * Set the activation hook for a plugin.
	 *
	 * @since 3.2
	 * @return void
	 */
	public function addActivationHook(): void {
		register_activation_hook( IFDW_FILE, [ $this, 'activate' ] );
	}

	/**
	 * Load the function hooked to the 'activate_PLUGIN' action.
	 *
	 * @since 3.2
	 * @return void
	 */
	public function activate(): void {
		if ( CheckHelper::versionsAreInvalid( Settings::MIN_WP, Settings::MIN_PHP ) ) {
			die(
				sprintf(
					/* phpcs:disable Generic.Files.LineLength */
					/* translators: %1$s: The required WP version - %2$s: The required PHP version */
					esc_html__( 'Include Fussball.de Widgets requires WordPress %1$s and PHP %2$s or higher.', 'include-fussball-de-widgets' ),
					esc_html( Settings::MIN_WP ),
					esc_html( Settings::MIN_PHP )
					/* phpcs:enable */
				)
			);
		}
	}
}
