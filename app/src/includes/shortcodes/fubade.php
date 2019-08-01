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
 * Fubade Shortcode Initializer
 *
 * Define and render the fubade shortcode.
 *
 * @since 3.0.0
 */

defined( 'ABSPATH' ) || exit();

/**
 * Render the fubade shortcode
 *
 * @since 2.0.0
 *
 * @param array $atts Shortcode attributes (`id`, `api`, `notice`, `fullwidth` and `devtools`).
 *
 * @return string
 */
function ifdw_fubade_shortcode( $atts ) {
	$a = shortcode_atts(
		[
			'id'        => '',
			'api'       => '',
			'notice'    => '',
			'fullwidth' => '',
			'devtools'  => '',
		],
		$atts
	);

	$log_fired = false;

	if ( 32 !== strlen( $a['api'] ) ) {
		ifdw_console_log( $a );
		$log_fired = true;
		/* translators: %s: the length of the api */
		printf( esc_html__( "<!-- API length: %s -->\n", 'include-fussball-de-widgets' ), esc_html( strlen( $a['api'] ) ) );
		return __( '!!! The fussball.de API must have a length of exactly 32 characters. !!!', 'include-fussball-de-widgets' );
	}

	$a['api']       = sanitize_text_field( strtoupper( preg_replace( '/[^\w]/', '', $a['api'] ) ) );
	$a['id']        = 'fubade_' . substr( $a['api'], -5 );
	$a['notice']    = sanitize_text_field( $a['notice'] );
	$a['fullwidth'] = '1' === $a['fullwidth'] || 'true' === $a['fullwidth'] || true === $a['fullwidth'] ? 1 : 0;
	$a['devtools']  = '1' === $a['devtools'] || 'true' === $a['devtools'] || true === $a['devtools'] ? 1 : 0;

	if ( ! wp_script_is( 'fubade-api' ) ) {
		wp_enqueue_script( 'fubade-api' );
	}

	ifdw_call_fubade_api( $a );

	if ( $a['devtools'] ) {
		ifdw_console_log( $a );
		$log_fired = true;
	}

	if ( ! $log_fired ) {
		ifdw_console_log( $a, false );
	}

	// TODO: Test the function call.
	return ifdw_render_fubade_output( $a );
}


/**
 * Register the calling script for the api from fussball.de.
 *
 * @since 2.0.0
 *
 * @param array $arr The array with the arguments.
 */
function ifdw_call_fubade_api( $arr ) {
	$api       = $arr['api'];
	$id        = $arr['id'];
	$fullwidth = $arr['fullwidth'];
	$devtools  = $arr['devtools'];

	wp_add_inline_script(
		'fubade-api',
		"new FussballdeWidgetAPI().showWidget( '$id', '$api', $full_width, $dev_tools );",
		'after'
	);
}


/**
 * Generates a logging output in the browser console.
 *
 * @since 2.2.0
 *
 * @param array   $arr The array with the arguments.
 * @param boolean $in_console If true, the log is output to the debug console of the browser.
 */
function ifdw_console_log( $arr, $in_console = true ) {
	$logging_list = [
		__( 'api: ', 'include-fussball-de-widgets' ) . esc_html( $arr['api'] ),
		__( 'notice: ', 'include-fussball-de-widgets' ) . esc_html( $arr['notice'] ),
		__( 'fullwidth: ', 'include-fussball-de-widgets' ) . esc_html( $arr['fullwidth'] ),
		__( 'devtools: ', 'include-fussball-de-widgets' ) . esc_html( $arr['devtools'] ),
	];

	if ( $in_console ) {
		$output = '';
		foreach ( $logging_list as $logging_item ) {
			$output .= 'console.info(' . wp_json_encode( '[' . $arr['id'] . '] ' . $logging_item, JSON_HEX_TAG ) . ');' . PHP_EOL;
		};
		wp_add_inline_script( 'fubade-api', $output, 'after' );
	} else {
		foreach ( $logging_list as $logging_item ) {
			echo '<!-- ' . wp_json_encode( '[' . $arr['id'] . '] ' . $logging_item, JSON_HEX_TAG ) . '-->' . PHP_EOL;
		}
	}
}
