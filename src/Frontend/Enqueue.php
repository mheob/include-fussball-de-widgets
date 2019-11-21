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
namespace IFDW\Frontend;

defined( 'ABSPATH' ) || exit();

/**
 * Class Enqueue provides functions to register scripts for the Frontend.
 *
 * @since 3.0
 */
class Enqueue {
	/**
	 * The instance.
	 *
	 * @since 3.0
	 * @var self
	 */
	private static $instance;

	/**
	 * Enqueue constructor.
	 *
	 * @since 3.0
	 */
	private function __construct() { }

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
	 * Add the init action for registering the fubade api.
	 *
	 * @since 3.0
	 * @return void
	 */
	public function addInitAction(): void {
		add_action( 'init', [ $this, 'registerFubadeApi' ] );
	}

	/**
	 * Register the api script for fussball.de.
	 *
	 * @since 3.0
	 * @return void
	 */
	public function registerFubadeApi(): void {
		wp_register_script(
			'fubade-api',
			plugins_url( 'assets/js/fubade-api.js', IFDW_URL ),
			[ 'wp-i18n' ],
			IFDW_VERSION,
			true
		);
		wp_set_script_translations( 'fubade-api', 'include-fussball-de-widgets' );
	}
}
