<?php declare( strict_types=1 );
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 Alexander Böhm
 */

namespace ITSB\IFDW\Frontend;

use ITSB\IFDW\Infrastructure\ActionBase;
use ITSB\IFDW\Utils\Settings;

/**
 * The `Enqueue` class provides functions to register scripts for the
 * Frontend.
 *
 * @since 3.0
 */
final class Enqueue extends ActionBase {
	/**
	 * Register the api script for fussball.de.
	 *
	 * @since 3.0
	 * @return void
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
