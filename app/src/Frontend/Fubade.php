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

namespace IFDW\Frontend;

use IFDW\Utils\Logging\ConsoleLogger;
use IFDW\Utils\Logging\SourceLogger;

defined( 'ABSPATH' ) || exit();

/**
 * Class Fubade
 * Creates the output of the widget from `fussball.de`.
 *
 * @since 3.0
 */
class Fubade {
  private $attr = [];

  /**
   * Creates the output to the sourcecode.
   *
   * @param array $attr The output attributes (`api`, `id`, `notice`, `fullwidth` and `devtools`).
   *
   * @return string
   * @since 3.0
   */
  public function output( $attr ): string {
    // TODO: Configure default setting in the admin area.
    $this->setAttr( $attr );

    if ( 32 !== strlen( $this->attr['api'] ) ) {
      ConsoleLogger::getInstance()->log( $this->attr );
      /* translators: %s: the length of the api */
      printf(
        esc_html__( "<!-- API length: %s -->\n", 'include-fussball-de-Widgets' ),
        esc_html( strlen( $this->attr['api'] ) )
      );

      return __(
        '!!! The fussball.de API must have a length of exactly 32 characters. !!!',
        'include-fussball-de-Widgets'
      );
    }

    $this->attr = [
      'api'       => sanitize_text_field( strtoupper( preg_replace( '/[^\w]/', '', $this->attr['api'] ) ) ),
      'id'        => 'fubade_' . substr( $this->attr['api'], - 5 ),
      'notice'    => empty( $this->attr['notice'] ) ? '' : sanitize_text_field( $this->attr['notice'] ),
      'fullwidth' => '1' === $this->attr['fullwidth'] || 'true' === $this->attr['fullwidth']
                     || true === $this->attr['fullwidth'] ? true : false,
      'devtools'  => '1' === $this->attr['devtools'] || 'true' === $this->attr['devtools']
                     || true === $this->attr['devtools'] ? true : false
    ];

    if ( ! wp_script_is( 'fubade-api' ) ) {
      wp_enqueue_script( 'fubade-api' );
    }

    wp_add_inline_script( 'fubade-api', 'new FussballdeWidgetAPI();', 'after' );

    return $this->render();
  }

  /**
   * Set the attribute array
   *
   * @param array $attr The attributes for the widget rendering.
   */
  public function setAttr( array $attr ): void {
    $this->attr = [
      'api'       => $attr['api'] ?? '',
      'id'        => $attr['id'] ?? 'ERROR_' . time(),
      'notice'    => $attr['notice'] ?? '',
      'fullwidth' => $attr['fullwidth'] ?? false,
      'devtools'  => $attr['devtools'] ?? false
    ];
  }

  /**
   * Render all the output.
   *
   * @return string
   * @since 3.0
   */
  private function render(): string {
    $output = sprintf( '<div id="%s" class="include-fussball-de-Widgets">', esc_html( $this->attr['id'] ) ) . PHP_EOL;
    $output .= $this->createIframe();
    $output .= '</div>' . PHP_EOL;

    if ( $this->attr['devtools'] ) {
      ConsoleLogger::getInstance()->log( $this->attr );
    } else {
      SourceLogger::getInstance()->log( $this->attr );
    }

    return $output;
  }

  /**
   * Creates the iframe needed from fussball.de.
   *
   * @return string
   * @since 3.0
   */
  private function createIframe(): string {
    // TODO: Test the punycode variant of the IFDW_HOST.
    $src    = '//www.fussball.de/widget2/-/schluessel/' . $this->attr['api'] . '/target/' . $this->attr['id']
              . '/caller/' . IFDW_HOST;
    $width  = $this->attr['fullwidth'] ? '100%' : '900px';
    $height = '200px';
    $style  = 'border: 1px solid #CECECE; overflow: hidden';

    /** @noinspection HtmlDeprecatedAttribute */
    return "<iframe src='$src' width='$width' height='$height' scrolling='no' style='$style'></iframe>" . PHP_EOL;
  }
}
