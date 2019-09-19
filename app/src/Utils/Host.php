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
 * @package Include_Fussball_de_Widgets
 */

namespace IFDW\Utils;

use function idn_to_ascii;

defined( 'ABSPATH' ) || exit;

/**
 * Class Host
 *
 * @since 3.0
 */
class Host {
  private static $host = false;

  /**
   * Clean up the hostname.
   *
   * @param string|null $host
   *
   * @return string The cleared hostname.
   */
  public static function cleanHost( ?string $host ): string {
    if ( ! self::$host && $host ) {
      if ( extension_loaded( 'intl' ) ) {
        if ( defined( 'INTL_IDNA_VARIANT_UTS46' ) ) {
          $host = idn_to_ascii( $host, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46 );
        } else {
          $host = idn_to_ascii( $host );
        }
      }
      self::$host = wp_unslash( $host ) ?? '';
    }

    return self::$host;
  }
}
