<?php
/**
 * Include Fussball.de Widgets
 * Copyright (C) 2019 IT-Service Böhm - Alexander Böhm <ab@its-boehm.de>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Include_Fussball_De_Widgets
 */

/**
 * Logging outputs.
 *
 * Logs informations over the used system and plugin.
 *
 * @since 3.0.0
 */

defined( 'ABSPATH' ) || exit();

/**
 * Generates a logging output in the browser console or the sourcecode only.
 *
 * @since 3.0.0
 *
 * @param array   $arr The array with the arguments.
 * @param boolean $in_console If true, the log is output to the debug console of the browser.
 *
 * @return boolean
 */
function ifdw_console_log( $arr, $in_console = true ) {
	$logging_list_generell = [
		__( '[FUBADE] Plugin Version: ', 'include-fussball-de-widgets' ) . IFDW_VERSION,
		__( '[FUBADE] Website for registration: ', 'include-fussball-de-widgets' ) . IFDW_HOST,
	];

	$logging_list = [
		__( 'api: ', 'include-fussball-de-widgets' ) . esc_html( $arr['api'] ),
		__( 'notice: ', 'include-fussball-de-widgets' ) . esc_html( $arr['notice'] ),
		__( 'fullwidth: ', 'include-fussball-de-widgets' ) . esc_html( $arr['fullwidth'] ),
		__( 'devtools: ', 'include-fussball-de-widgets' ) . esc_html( $arr['devtools'] ),
	];

	if ( $in_console ) {
		$output = '';
		foreach ( $logging_list_generell as $logging_item ) {
			$output .= 'console.info(' . wp_json_encode( $logging_item, JSON_HEX_TAG ) . ');' . PHP_EOL;
		};
		foreach ( $logging_list as $logging_item ) {
			$output .= 'console.info(' . wp_json_encode( '[' . $arr['id'] . '] ' . $logging_item, JSON_HEX_TAG ) . ');' . PHP_EOL;
		};
		wp_add_inline_script( 'fubade-api', $output, 'after' );
	} else {
		foreach ( $logging_list_generell as $logging_item ) {
			echo '<!-- ' . wp_json_encode( $logging_item, JSON_HEX_TAG ) . '-->' . PHP_EOL;
		}
		foreach ( $logging_list as $logging_item ) {
			echo '<!-- ' . wp_json_encode( '[' . $arr['id'] . '] ' . $logging_item, JSON_HEX_TAG ) . '-->' . PHP_EOL;
		}
	}

	return true;
}
