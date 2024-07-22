<?php
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2020 Alexander Böhm
 */

declare( strict_types=1 );

namespace ITSB\IFDW\Utils;

use ITSB\IFDW\Utils\CheckHelper;

/**
 * The `Activation` class checks if the plugin could activated.
 *
 * @since 3.2
 */
final class Activation {
	/**
	 * Registers the activation hook for the plugin.
	 *
	 * This method is responsible for registering the activation hook for the plugin,
	 * which will call the `activate()` method when the plugin is activated.
	 *
	 * @since 3.2
	 */
	public function addActivationHook(): void {
		register_activation_hook( IFDW_FILE, [ $this, 'activate' ] );
	}

	/**
	 * Activate the plugin and checks if the minimum required versions of WordPress and PHP are met.
	 *
	 * If the minimum required versions are not met, this method will display an error message
	 * and stop the plugin activation process.
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
