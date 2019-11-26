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
namespace IFDW\Utils;

defined( 'ABSPATH' ) || exit;

/**
 * Class Textdomain register the used textdomain for local usages.
 *
 * Only needed for the Poedit workflow. The official translations comes from wordpress.org.
 *
 * @since 3.0
 */
class Textdomain {
	/**
	 * The instance.
	 *
	 * @since 3.0
	 * @var self
	 */
	private static $instance;

	/**
	 * Textdomain constructor.
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
	 * Add the plugins_loaded action.
	 *
	 * @since 3.0
	 * @return void
	 */
	public function addPluginsLoadedAction(): void {
		add_action( 'plugins_loaded', [ $this, 'loadTextdomain' ] );
	}

	/**
	 * Load the plugin textdomain.
	 *
	 * @since 3.0
	 * @return void
	 */
	public function loadTextdomain(): void {
		load_plugin_textdomain(
			'include-fussball-de-widgets',
			false,
			dirname( plugin_basename( IFDW_URL ) ) . '/languages'
		);
	}
}
