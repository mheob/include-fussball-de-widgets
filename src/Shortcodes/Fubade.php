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
namespace IFDW\Shortcodes;

defined( 'ABSPATH' ) || exit;

/**
 * Class Fubade defines and render the fubade shortcode.
 *
 * @since 3.0
 */
class Fubade {
	/**
	 * The instance.
	 *
	 * @since 3.0
	 * @var self
	 */
	private static $instance;

	/**
	 * Fubade constructor.
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
	 * Add the fubade shortcode.
	 *
	 * @since 3.0
	 * @return void
	 */
	public function addShortcode(): void {
		add_shortcode( 'fubade', [ $this, 'createShortcode' ] );
	}

	/**
	 * Render the fubade shortcode
	 *
	 * @since 3.0
	 *
	 * @param array $atts Shortcode attributes (`id`, `api`, `notice`, `fullwidth` and `devtools`).
	 *
	 * @return string The output to the sourcecode.
	 */
	public function createShortcode( array $atts ): string {
		$a = shortcode_atts(
			[
				'id'        => '',
				'api'       => '',
				'notice'    => '',
				'fullwidth' => '',
				'devtools'  => '',
			],
			$atts
		);

		return ( new \IFDW\Frontend\Fubade() )->output( $a );
	}
}
