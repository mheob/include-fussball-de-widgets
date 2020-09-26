<?php declare( strict_types=1 );
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    IT Service Böhm -- Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 IT Service Böhm -- Alexander Böhm
 */

namespace ITSB\IFDW\Utils;

/**
 * Class Host provides utilities for checking and generating hosting things.
 *
 * @since 3.0
 */
class Host {
	/**
	 * The stored hostname.
	 *
	 * @since 3.1
	 * @var string
	 */
	private static $host;

	/**
	 * Clean up the hostname.
	 *
	 * @since 3.0
	 * @param string|null $host The hostname getting from the server.
	 * @return string The cleared hostname.
	 */
	public static function cleanHost( ?string $host ): string {
		if ( ! isset( self::$host ) && ! empty( $host ) ) {
			if ( extension_loaded( 'intl' ) ) {
				$idna_options = is_int( IDNA_DEFAULT ) ? IDNA_DEFAULT : 0;
				$idna_variant = is_int( INTL_IDNA_VARIANT_UTS46 ) ? INTL_IDNA_VARIANT_UTS46 : 1;
				$host         = idn_to_ascii( $host, $idna_options, $idna_variant );
			}
			self::$host = wp_unslash( $host ) ?? '';
		}

		return self::$host ?? Settings::SERVER_NAME_DUMMY;
	}
}
