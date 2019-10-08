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
  private const ERROR = [ 'API_LENGTH' => 'api-length', 'SERVER_NAME' => 'no-server-name' ];
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


    if ( 32 !== strlen( $this->attr['api'] ) ) {
      ConsoleLogger::getInstance()->log( $this->attr );
      printf( // translators: %s: the length of the api
        esc_html__( "<!-- API length: %s -->\n", 'include-fussball-de-widgets' ),
        esc_html( strlen( $this->attr['api'] ) )
      );

      return $this->render( self::ERROR['API_LENGTH'] );
    }

    if ( IFDW_HOST === 'SERVER_NAME-not-set' ) {
      ConsoleLogger::getInstance()->log( $this->attr );

      return $this->render( self::ERROR['SERVER_NAME'] );
    }

    return $this->render( null );
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
   * @param string|null $error Potential errors.
   *
   * @return string
   * @since 3.0
   */
  private function render( ?string $error ): string {
    $divAttributeString = 'id="' . esc_html( $this->attr['id'] ) . '" class="include-fussball-de-widgets"';

    if ( $error ) {
      $divAttributeString .= ' style="padding:1rem;background-color:#f2dede;color:#a94442;border:1px solid #ebccd1;border-radius:4px"';

      switch ( $error ) {
        case self::ERROR['API_LENGTH']:
          $divContent = __(
                          '!!! The fussball.de API must have a length of exactly 32 characters. !!!',
                          'include-fussball-de-widgets'
                        ) . PHP_EOL;
          break;
        case self::ERROR['SERVER_NAME']:
          $divContent = __(
                          'The PHP variable <code>$_SERVER["SERVER_NAME"]</code> was not set by the server.',
                          'include-fussball-de-widgets'
                        ) . PHP_EOL;
          break;
        default:
          $divContent = __( 'An undefined error has occurred.', 'include-fussball-de-widgets' ) . PHP_EOL;
      }
    } else {
      $divContent = $this->createIframe();
    }

    $output = "<div $divAttributeString>" . PHP_EOL;
    $output .= $divContent;
    $output .= '</div>' . PHP_EOL;

    if ( $this->attr['devtools'] ) {
      ConsoleLogger::getInstance()->log( $this->attr );
    } elseif ( ! is_admin() ) {
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
    $src    = '//www.fussball.de/widget2/-/schluessel/' . $this->attr['api'];
    $src    .= '/target/' . $this->attr['id'];
    $src    .= '/caller/' . IFDW_HOST;
    $width  = $this->attr['fullwidth'] ? '100%' : '900px';
    $height = '200px';
    $style  = 'border: 1px solid #CECECE; overflow: hidden';

    /** @noinspection HtmlDeprecatedAttribute */
    return "<iframe src='$src' width='$width' height='$height' scrolling='no' style='$style'></iframe>" . PHP_EOL;
  }
}
