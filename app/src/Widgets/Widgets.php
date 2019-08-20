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

namespace IFDW\Widgets;

defined( 'ABSPATH' ) || exit;

/**
 * Class Widgets
 * Register all Widgets from 'Include_Fussball_De_Widgets'.
 *
 * @since 3.0
 */
class Widgets {
  private static $instance = null;

  /**
   * Widgets constructor.
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
   * Add the widgets_init action.
   *
   * @since 3.0
   */
  public function addWidgetInitAction(): void {
    add_action( 'widgets_init', [ $this, 'registerWidgets' ] );
  }

  /**
   * Initialize all Widgets
   *
   * @since   3.0.0
   */
  public function registerWidgets(): void {
    register_widget( '\\IFDW\\Widgets\\FubadeWidget' );
  }
}
