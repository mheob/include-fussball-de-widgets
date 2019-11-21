<?php
/**
 * Include Fussball.de Widgets
 * Copyright (C) 2019 IT-Service Böhm - Alexander Böhm <ab@its-boehm.de>
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Include_Fussball_De_Widgets
 */

declare( strict_types=1 );
namespace IFDW\Utils\Logging;

defined( 'ABSPATH' ) || exit;

/**
 * Class SourceLogger is used to logs information over the used system and plugin to the browser console.
 *
 * @see IFDW\Utils\Logging\Base
 * @since 3.0
 */
class SourceLogger extends Base {
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

	// phpcs:disable Generic.CodeAnalysis.UselessOverridingMethod.Found
	/**
	 * Logger constructor.
	 *
	 * @since 3.0
	 */
	private function __construct() {
		parent::__construct();
	}
	// phpcs:enable

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
	 * Logs the general information, for example from the plugin, WordPress and / or the server.
	 *
	 * @since 3.0
	 * @return void
	 */
	protected function logGeneralInfo(): void {
		$message = '<!-- ' . PHP_EOL;

		foreach ( $this->generalInfoList as $item ) {
			$message .= $item . PHP_EOL;
		};

		$message .= ' -->' . PHP_EOL;

		print esc_html( $message );

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

		$message = '<!-- ' . PHP_EOL;

		foreach ( $arr as $key => $value ) {
			if ( 'id' === $key ) {
				continue;
			}

			$temp     = esc_html( $key ) . __( ': ', 'include-fussball-de-widgets' ) . esc_html( $value );
			$message .= '[' . $arr['id'] . '] ' . $temp . PHP_EOL;
		}

		$message .= ' -->' . PHP_EOL;

		print esc_html( $message );
	}
}
