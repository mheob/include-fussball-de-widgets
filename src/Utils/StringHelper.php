<?php declare( strict_types=1 );
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2020 Alexander Böhm
 */

namespace ITSB\IFDW\Utils;

/**
 * The `Helper` class comment
 *
 * @since 3.3
 */
final class StringHelper {
	/**
	 * Check string starting with given substring
	 *
	 * @since 3.3
	 *
	 * @param string $string        The string to check.
	 * @param string $startString   The string to start with.
	 * @return boolean
	 */
	public static function startsWith( string $string, string $startString ): bool {
		return ( substr( $string, 0, strlen( $startString ) ) === $startString );
	}

	/**
	 * Check string ends with given substring
	 *
	 * @since 3.3
	 *
	 * @param string $string      The string to check.
	 * @param string $endString   The string to end with.
	 * @return boolean
	 */
	public static function endsWith( string $string, string $endString ): bool {
		return ( substr( $string, 0, -strlen( $endString ) ) === $endString );
	}
}
