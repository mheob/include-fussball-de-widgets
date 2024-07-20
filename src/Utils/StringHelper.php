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
	 * Check string starting with given substring
	 *
	 * @since 3.3
	 *
	 * @param string $text          The string to check.
	 * @param string $startText     The string to start with.
	 * @return boolean
	 */
	public static function startsWith( string $text, string $startText ): bool {
		return substr( $text, 0, strlen( $startText ) ) === $startText;
	}

	/**
	 * Check string ends with given substring
	 *
	 * @since 3.3
	 *
	 * @param string $text        The string to check.
	 * @param string $endText     The string to end with.
	 * @return boolean
	 */
	public static function endsWith( string $text, string $endText ): bool {
		return substr( $text, 0, -strlen( $endText ) ) === $endText;
	}
}
