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

/**
 * Class ConsoleLogger is used to logs information over the used system and
 * plugin to the browser console.
 *
 * @see ITSB\IFDW\Utils\Logging\LoggerBase
 * @since 3.0
 */
class ConsoleLogger extends LoggerBase {
	/**
	 * The instance.
	 *
	 * @since 3.0
	 * @var self
	 */
	private static $instance;

	/**
	 * True if the general informations are already logged.
	 *
	 * @since 3.0
	 * @var boolean
	 */
	private $isGeneralLogged = false;

	/**
	 * Get the instance.
	 *
	 * @since 3.0
	 * @return self The instance of the class.
	 */
	public static function getInstance(): self {
		return self::$instance ?? new static();
	}

	/**
	 * Generates a logging output of an error.
	 *
	 * @since 3.0
	 *
	 * @param string $error The error message.
	 *
	 * @return void
	 */
	public function errorLog( string $error ): void {
		$errorMessage = 'console.info(' . wp_json_encode( $error, JSON_HEX_TAG ) . ');' . PHP_EOL;
		wp_add_inline_script( 'jquery', $errorMessage );
	}

	/**
	 * Generates a logging output.
	 *
	 * @since 3.0
	 *
	 * @param array $arr The arguments.
	 *
	 * @return void
	 */
	public function log( array $arr ): void {
		if ( ! $this->isGeneralLogged ) {
			$this->logGeneralInfo();
		}

		$this->logWidgetInfo( $arr );
	}

	/**
	 * Logs the general information, for example from the plugin, WordPress
	 * and / or the server.
	 *
	 * @since 3.0
	 * @return void
	 */
	protected function logGeneralInfo(): void {
		$output = '';
		foreach ( $this->generalInfoList as $item ) {
			$output .= 'console.log(' . wp_json_encode( $item, JSON_HEX_TAG ) . ');' . PHP_EOL;
		};

		$output .= "console.log('')" . PHP_EOL;

		wp_add_inline_script( 'fubade-api', $output );

		$this->isGeneralLogged = true;
	}

	/**
	 * Logs the information pertaining to a specific widget only.
	 *
	 * @since 3.0
	 *
	 * @param array $arr The arguments.
	 *
	 * @return void
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

			$temp       = esc_html( $key ) . __( ': ', 'include-fussball-de-widgets' ) . esc_html( $value );
			$outputBody = wp_json_encode( '[' . $arr['id'] . '] ' . $temp, JSON_HEX_TAG );
			$output    .= "console.info($outputBody);" . PHP_EOL;
		}

		$output .= "console.info('')" . PHP_EOL;

		wp_add_inline_script( 'fubade-api', $output );
	}
}
