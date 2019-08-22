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

namespace IFDW\Shortcodes;

defined( 'ABSPATH' ) || exit;

/**
 * Class Fubade
 * Define and render the fubade shortcode.
 *
 * @since 3.0
 */
class Fubade {
  private static $instance = null;

  /**
   * Fubade constructor.
   *
   * @since 3.0
   */
  private function __construct() { }

  /**
   * Get the instance.
   *
   * @return self
   * @since 3.0
   */
  public static function getInstance(): self {
    if ( null === self::$instance ) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  /**
   * Add the fubade shortcode.
   *
   * @since 3.0
   */
  public function addShortcode(): void {
    add_shortcode( 'fubade', [ $this, 'createShortcode' ] );
  }

  /**
   * Render the fubade shortcode
   *
   * @param array $atts Shortcode attributes (`id`, `api`, `notice`, `fullwidth` and `devtools`).
   *
   * @return string
   * @since 3.0
   */
  public function createShortcode( $atts ): string {
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
