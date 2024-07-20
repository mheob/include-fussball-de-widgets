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

namespace ITSB\IFDW\Frontend;

use ITSB\IFDW\Infrastructure\ActionBase;
use ITSB\IFDW\Utils\Settings;

/**
 * The `Enqueue` class provides functions to register scripts for the Frontend.
 *
 * @since 3.0
 */
final class Enqueue extends ActionBase {
	/**
	 * Registers the fubade-api script for the frontend.
	 *
	 * This function registers the fubade-api script, which is used to interact with the
	 * Fussball.de API. The script is registered with the 'fubade-api' handle and has a dependency
	 * on the 'wp-i18n' script. The script version is set to the plugin version defined in the
	 * Settings class.
	 *
	 * @since 3.0
	 */
	public function action(): void {
		wp_register_script(
			'fubade-api',
			plugins_url( 'assets/js/fubade-api.js', Settings::getPluginName() ),
			[ 'wp-i18n' ],
			Settings::VERSION,
			true
		);
		wp_set_script_translations( 'fubade-api', 'include-fussball-de-widgets' );
	}
}
