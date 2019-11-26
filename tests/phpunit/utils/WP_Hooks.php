<?php
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

declare( strict_types=1 );
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
