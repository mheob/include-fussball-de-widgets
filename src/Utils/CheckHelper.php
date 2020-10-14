<?php declare( strict_types=1 );
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 Alexander Böhm
 */

namespace ITSB\IFDW\Utils;

/**
 * The `CheckHelper` class hold some global checks.
 *
 * Global test methods are defined here. These should help to make the right
 * decisions in the right moments.
 *
 * @since 3.1
 */
final class CheckHelper {
	/**
	 * Checks the needed WordPress and PHP version is used.
	 *
	 * @since 3.2
	 * @param string $wpVersion     The minimum WordPress version.
	 * @param string $phpVersion    The minimum PHP version.
	 * @return boolean              True, if the minimum WordPress and
	 *                              PHP version is used; otherwise false.
	 */
	public static function versionsAreInvalid( string $wpVersion, string $phpVersion ): bool {
		global $wp_version;

		if ( version_compare( phpversion(), $phpVersion, '>=' )
			&& version_compare( $wp_version, $wpVersion, '>=' ) ) {
				return false;
		}

		return true;
	}
}
