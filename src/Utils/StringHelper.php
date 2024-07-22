<?php
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2020 Alexander Böhm
 */

declare( strict_types=1 );

namespace ITSB\IFDW\Utils;

/**
 * The `Helper` class comment
 *
 * @since 3.3
 */
final class StringHelper {
	/**
	 * Check if a string starts with a given substring.
	 *
	 * @since 3.3
	 * @param string $text      The string to check.
	 * @param string $startText The substring to check for at the start of the string.
	 * @return bool  True if the string starts with the given substring, false otherwise.
	 */
	public static function startsWith( string $text, string $startText ): bool {
		return substr( $text, 0, strlen( $startText ) ) === $startText;
	}

	/**
	 * Check if a string ends with a given substring.
	 *
	 * @since 3.3
	 * @param string $text    The string to check.
	 * @param string $endText The substring to check for at the end of the string.
	 * @return bool  True if the string ends with the given substring, false otherwise.
	 */
	public static function endsWith( string $text, string $endText ): bool {
		return substr( $text, 0, -strlen( $endText ) ) === $endText;
	}


	/**
	 * Check if the given string is a valid UUID.
	 *
	 * @since 4.0
	 * @param string $uuid The string to check for a valid UUID.
	 * @return bool True if the input string is a valid UUID, false otherwise.
	 */
	public static function isValidUUID( string $uuid ): bool {
		// Regular expression pattern for valid UUIDs
		$pattern = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i';
		return preg_match( $pattern, $uuid ) === 1;
	}
}
