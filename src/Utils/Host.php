<?php
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 Alexander Böhm
 */

declare( strict_types=1 );

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
		if ( ! isset( self::$host ) && ! empty( $host ) && extension_loaded( 'intl' ) ) {
			// phpcs:disable
			if ( version_compare( phpversion(), Settings::MIN_PHP, '>=' ) ) {
				$host = @idn_to_ascii( $host );
			} else {
				$host = idn_to_ascii( $host );
			}
			// phpcs:enable
		}

		return wp_unslash( $host ) ?? Settings::SERVER_NAME_DUMMY;
	}
}
