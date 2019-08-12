<?php
declare( strict_types=1 );
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

namespace IFDW\Blocks;

use IFDW\Frontend\Fubade;

defined( 'ABSPATH' ) || exit();


/**
 * Class Enqueue
 * Functions to register client-side assets (scripts and stylesheets) for the Gutenberg block.
 *
 * @since 3.0.0
 */
class Enqueue {
  private static $instance = null;


  /**
   * Enqueue constructor.
   *
   * @since 3.0.0
   */
  private function __construct() {
    add_action( 'init', [ $this, 'registerDynamicBlock' ] );
  }


  /**
   * Get the instance.
   *
   * @return Enqueue
   * @since 3.0.0
   */
  public static function getInstance() {
    if ( null === self::$instance ) {
      self::$instance = new Enqueue();
    }

    return self::$instance;
  }


  /**
   * Register the dynamic block.
   * `id`: the id talks between the html and the fussball.de api.
   * `api`: The official and individuell api snippet from fussball.de.
   * `notice`: A short description for the user.
   * `fullwidth`: If true, the widget is displaying in the full width.
   * `devtools`: If true, some dev tools are used.
   *
   * @since 3.0.0
   */
  public function registerDynamicBlock() {
    wp_register_script( 'fubade-block-script',
                        plugins_url( 'assets/js/blocks.js', IFDW_URL ),
                        [ 'wp-Blocks', 'wp-i18n', 'wp-element' ],
                        IFDW_VERSION,
                        true );

    wp_set_script_translations( 'fubade-block-script', 'include-fussball-de-Widgets' );

    wp_register_style( 'fubade-block-style',
                       plugins_url( 'assets/css/blocks-main.css', IFDW_URL ),
                       [],
                       IFDW_VERSION );

    register_block_type( 'ifdw/fubade',
                         [
                           'attributes'      => [
                             'id'        => [ 'type' => 'string' ],
                             'api'       => [ 'type' => 'string' ],
                             'notice'    => [ 'type' => 'string' ],
                             'fullwidth' => [ 'type' => 'boolean' ],
                             'devtools'  => [ 'type' => 'boolean' ],
                           ],
                           'editor_script'   => 'fubade-block-script',
                           'editor_style'    => 'fubade-block-style',
                           'render_callback' => [ new Fubade(), 'output' ],
                         ] );
  }
}
