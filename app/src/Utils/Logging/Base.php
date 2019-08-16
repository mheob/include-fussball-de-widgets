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

namespace IFDW\Utils\Logging;

defined( 'ABSPATH' ) || exit;

/**
 * Abstract Class Base
 * Config the base attributes for the logging classes.
 *
 * @since 3.0
 */
abstract class Base {
  protected $generalInfoList = [];

  /**
   * Base constructor.
   *
   * @since 3.0
   */
  protected function __construct() {
    global $wp_version;
    $this->generalInfoList = [
      __( '[FUBADE] Plugin Version: ', 'include-fussball-de-Widgets' ) . IFDW_VERSION,
      __( '[FUBADE] Website for registration: ', 'include-fussball-de-Widgets' ) . IFDW_HOST,
      __( '[FUBADE] Wordpress version: ', 'include-fussball-de-Widgets' ) . $wp_version,
      __( '[FUBADE] PHP version: ', 'include-fussball-de-Widgets' ) . PHP_VERSION
    ];
  }

  /**
   * Generates a logging output.
   *
   * @param array $arr The arguments.
   *
   * @since 3.0
   */
  abstract public function log( array $arr );

  /**
   * Logs the general information, for example from the plugin, WordPress and / or the server.
   *
   * @since 3.0
   */
  abstract protected function logGeneralInfo();

  /**
   * Logs the information pertaining to a specific widget only.
   *
   * @param array $arr The arguments.
   *
   * @since 3.0
   */
  abstract protected function logWidgetInfo( array $arr );
}
