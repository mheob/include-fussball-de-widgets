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

/**
 * Class ConsoleLogger is used to logs information over the used system and
 * plugin to the browser console.
 *
 * @see ITSB\IFDW\Utils\Logging\LoggerBase
 * @since 3.0
 */
class ConsoleLogger extends LoggerBase {
	/**
	 * The singleton instance of the ConsoleLogger class.
	 *
	 * @since 3.0
	 * @var ConsoleLogger
	 */
	private static $instance;

	/**
	 * Indicates whether the general information has already been logged.
	 *
	 * @since 3.0
	 * @var bool
	 */
	private $isGeneralLogged = false;


	/**
	 * Returns the singleton instance of the ConsoleLogger class.
	 *
	 * @since 3.0
	 * @return ConsoleLogger The singleton instance of the ConsoleLogger class.
	 */
	public static function getInstance(): self {
		return self::$instance ?? new static();
	}

	/**
	 * Logs an error message to the browser console.
	 *
	 * @since 3.0
	 * @param string $error The error message to log.
	 */
	public function errorLog( string $error ): void {
		$errorMessage = 'console.info(' . wp_json_encode( $error, JSON_HEX_TAG ) . ');' . PHP_EOL;
		wp_add_inline_script( 'jquery', $errorMessage );
	}

	/**
	 * Logs information about a specific widget.
	 *
	 * This method logs various information about a widget, such as its ID and other properties,
	 * to the browser console. If the general information has not been logged yet, it will be
	 * logged first before logging the widget-specific information.
	 *
	 * @since 3.0
	 * @param array $arr The arguments containing the widget information to log.
	 */
	public function log( array $arr ): void {
		if ( ! $this->isGeneralLogged ) {
			$this->logGeneralInfo();
		}

		$this->logWidgetInfo( $arr );
	}

	/**
	 * Logs general information to the browser console.
	 *
	 * This method logs various general information to the browser console.
	 * If the general information has not been logged yet, it will be logged here.
	 * The general information is stored in the `$generalInfoList` property.
	 *
	 * @since 3.0
	 */
	protected function logGeneralInfo(): void {
		$output = '';
		foreach ( $this->generalInfoList as $item ) {
			$output .= 'console.info(' . wp_json_encode( $item, JSON_HEX_TAG ) . ');' . PHP_EOL;
		}

		$output .= "console.info('')" . PHP_EOL;

		wp_add_inline_script( 'fubade-api', $output );

		$this->isGeneralLogged = true;
	}

	/**
	 * Logs information about a specific widget.
	 *
	 * This method logs various information about a widget, such as its ID and other properties,
	 * to the browser console. If the general information has not been logged yet, it will be
	 * logged first before logging the widget-specific information.
	 *
	 * @since 3.0
	 * @param array $arr The arguments containing the widget information to log.
	 */
	protected function logWidgetInfo( array $arr ): void {
		if ( ! isset( $arr['id'] ) ) {
			return;
		}

		$output = '';

		foreach ( $arr as $key => $value ) {
			if ( 'id' === $key ) {
				continue;
			}

			$temp       = esc_html( $key ) . ': ' . esc_html( $value );
			$outputBody = wp_json_encode( '[' . $arr['id'] . '] ' . $temp, JSON_HEX_TAG );
			$output    .= "console.info($outputBody);" . PHP_EOL;
		}

		$output .= "console.info('')" . PHP_EOL;

		wp_add_inline_script( 'fubade-api', $output );
	}
}
