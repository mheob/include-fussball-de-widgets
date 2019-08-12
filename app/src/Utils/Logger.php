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

namespace IFDW\Utils;

defined( 'ABSPATH' ) || exit;

/**
 * Class Logger
 * Logs information over the used system and plugin.
 *
 * @since 3.0.0
 */
class Logger {
  private static $instance = null;

  /**
   * Logger constructor.
   */
  private function __construct() { }

  /**
   * Get the instance.
   *
   * @return Logger
   * @since 3.0.0
   */
  public static function getInstance() {
    if ( null === self::$instance ) {
      self::$instance = new Logger();
    }

    return self::$instance;
  }

  /**
   * Generates a logging output in the browser console or the sourcecode only.
   *
   * @param array   $arr        The array with the arguments.
   * @param boolean $in_console If true, the log is output to the debug console of the browser.
   *
   * @return boolean
   * @since 3.0.0
   */
  public function log( $arr, $in_console = true ) {
    // TODO: Define the logging.
    $loggingListGenerell = [
      __( '[FUBADE] Plugin Version: ', 'include-fussball-de-Widgets' ) . IFDW_VERSION,
      __( '[FUBADE] Website for registration: ', 'include-fussball-de-Widgets' ) . IFDW_HOST
    ];

    $loggingList = [
      __( 'api: ', 'include-fussball-de-Widgets' ) . esc_html( $arr['api'] ),
      __( 'notice: ', 'include-fussball-de-Widgets' ) . esc_html( $arr['notice'] ),
      __( 'fullwidth: ', 'include-fussball-de-Widgets' ) . esc_html( $arr['fullwidth'] ),
      __( 'devtools: ', 'include-fussball-de-Widgets' ) . esc_html( $arr['devtools'] ),
    ];

    if ( $in_console ) {
      $output = '';
      foreach ( $loggingListGenerell as $loggingItem ) {
        $output .= 'console.info(' . wp_json_encode( $loggingItem, JSON_HEX_TAG ) . ');' . PHP_EOL;
      };

      $output .= "console.info('')" . PHP_EOL;

      foreach ( $loggingList as $loggingItem ) {
        $output .= 'console.info(' . wp_json_encode( '[' . $arr['id'] . '] ' . $loggingItem,
                                                     JSON_HEX_TAG ) . ');' . PHP_EOL;
      };

      $output .= "console.info('----------')" . PHP_EOL;
      $output .= "console.info('')" . PHP_EOL;

      wp_add_inline_script( 'fubade-api', $output, 'after' );
    } else {
      $message = '<!-- ' . PHP_EOL;

      foreach ( $loggingListGenerell as $loggingItem ) {
        $message .= $loggingItem . PHP_EOL;
      };

      $message .= '' . PHP_EOL;

      foreach ( $loggingList as $loggingItem ) {
        $message .= '[' . $arr['id'] . '] ' . $loggingItem . PHP_EOL;
      };

      $message .= ' -->' . PHP_EOL;

      return $message;
    }

    return null;
  }
}
