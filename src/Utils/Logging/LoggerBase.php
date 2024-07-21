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
	 * An array of general information to be logged, such as plugin version, website for
	 * registration, WordPress version, PHP version, and loaded PHP extensions.
	 *
	 * @since 3.0
	 * @var array
	 */
	protected $generalInfoList = [];

	/**
	 * Initializes the general information list for logging, including the plugin version,
	 * website for registration, WordPress version, PHP version, and loaded PHP extensions.
	 *
	 * @since 3.0
	 */
	protected function __construct() {
		global $wp_version;
		$this->generalInfoList = [
			/* phpcs:disable Generic.Files.LineLength */
			__( '[FUBADE] Plugin Version: ', 'include-fussball-de-widgets' ) . Settings::VERSION,
			__( '[FUBADE] Website for registration: ', 'include-fussball-de-widgets' ) . Settings::getHost(),
			__( '[FUBADE] Wordpress version: ', 'include-fussball-de-widgets' ) . $wp_version,
			__( '[FUBADE] PHP version: ', 'include-fussball-de-widgets' ) . phpversion(),
			__( '[FUBADE] PHP ext loaded: ', 'include-fussball-de-widgets' ) . wp_json_encode( get_loaded_extensions() ),
			/* phpcs:enable */
		];
	}

	/**
	 * Logs the provided array of arguments.
	 *
	 * @since 3.0
	 * @param array $arr The arguments to log.
	 */
	abstract public function log( array $arr ): void;

	/**
	 * Logs the general information for the plugin, including the plugin version,
	 * website for registration, WordPress version, PHP version, and loaded PHP extensions.
	 *
	 * @since 3.0
	 */
	abstract protected function logGeneralInfo(): void;

	/**
	 * Logs the provided array of widget-related information.
	 *
	 * @since 3.0
	 * @param array $arr The widget-related information to log.
	 */
	abstract protected function logWidgetInfo( array $arr ): void;
}
