<?php declare( strict_types=1 );
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    IT Service Böhm -- Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 IT Service Böhm -- Alexander Böhm
 */

namespace ITSB\IFDW\Utils\Logging;

use ITSB\IFDW\Utils\Settings;

/**
 * Abstract Class LoggerBase ist used to config the base attributes for
 * the logging classes.
 *
 * @since 3.0
 */
abstract class LoggerBase {
	/**
	 * The general info list.
	 *
	 * @since 3.0
	 * @var array
	 */
	protected $generalInfoList = [];

	/**
	 * Base constructor.
	 *
	 * @since 3.0
	 */
	protected function __construct() {
		global $wp_version;
		$this->generalInfoList = [
			__( '[FUBADE] Plugin Version: ', 'include-fussball-de-widgets' ) . Settings::VERSION,
			__( '[FUBADE] Website for registration: ', 'include-fussball-de-widgets' ) . Settings::getHost(),
			__( '[FUBADE] Wordpress version: ', 'include-fussball-de-widgets' ) . $wp_version,
			__( '[FUBADE] PHP version: ', 'include-fussball-de-widgets' ) . phpversion(),
			__( '[FUBADE] PHP ext loaded: ', 'include-fussball-de-widgets' ) .
				wp_json_encode( get_loaded_extensions() )
		];
	}

	/**
	 * Generates a logging output.
	 *
	 * @since 3.0
	 * @param array $arr The arguments.
	 * @return void
	 */
	abstract public function log( array $arr ): void;

	/**
	 * Logs the general information, for example from the plugin, WordPress
	 * and / or the server.
	 *
	 * @since 3.0
	 * @return void
	 */
	abstract protected function logGeneralInfo(): void;

	/**
	 * Logs the information pertaining to a specific widget only.
	 *
	 * @since 3.0
	 * @param array $arr The arguments.
	 * @return void
	 */
	abstract protected function logWidgetInfo( array $arr ): void;

	// TODO [$5e95fbd5c099020007a01c48]: Add a file or database logging system.
}
