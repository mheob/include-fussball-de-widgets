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

namespace ITSB\IFDW\PhpUnit\Utils;

/**
 * Class WP_Hooks
 * Helper for the WordPress action and filter hooks.
 *
 * @since 3.1
 */
final class WP_Hooks {
	/**
	 * Wrapper for the WordPress function `has_action()`.
	 *
	 * @since 3.1
	 * @see https://developer.wordpress.org/reference/functions/has_action/
	 *
	 * @param string $action The action hook.
	 * @param object $obj The callable class.
	 * @param string $cb The callback function.
	 *
	 * @return boolean
	 */
	public static function hasAction( string $action, object $obj, string $cb ): bool {
		return has_action( $action, [ $obj, $cb ] ) > 0 ? true : false;
	}

	/**
	 * Wrapper for the WordPress function `has_filter()`.
	 *
	 * @since 3.1
	 * @see https://developer.wordpress.org/reference/functions/has_filter/
	 *
	 * @param string $filter The filter hook.
	 * @param object $obj The callable class.
	 * @param string $cb The callback function.
	 *
	 * @return boolean
	 */
	public static function hasFilter( string $filter, object $obj, string $cb ): bool {
		return has_filter( $filter, [ $obj, $cb ] ) > 0 ? true : false;
	}
}
