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
	 * Stores the cleaned host string.
	 *
	 * This property is used to cache the cleaned host string returned by the `cleanHost()` method.
	 *
	 * @since 3.0
	 * @var ?string
	 */
	private static $host;

	/**
	 * Cleans the provided host string.
	 *
	 * If the host is not set and the `intl` extension is loaded, the function will attempt to
	 * convert the host to ASCII using `idn_to_ascii()`. The minimum required PHP version for this
	 * is defined in the `Settings` class.
	 *
	 * @param ?string $host The host string to clean.
	 * @return string The cleaned host string, or a dummy value from the `Settings` class if the
	 *                host could not be cleaned.
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
