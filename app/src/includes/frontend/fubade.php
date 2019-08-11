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
 * Creates the output of the widget from `fussball.de`.
 *
 * @since 3.0.0
 */

defined( 'ABSPATH' ) || exit();

/**
 * Creates the output to the sourcecode.
 *
 * @since 3.0.0
 *
 * @param array $attr The output attributes (`api`, `id`, `notice`, `fullwidth` and `devtools`).
 *
 * @return string
 */
function ifdw_create_fubade_output( $attr ) {
	// TODO: Configure default setting in the admin area.
	$log_msg = null;

	if ( 32 !== strlen( $attr['api'] ) ) {
		$log_msg = ifdw_console_log( $attr );
		/* translators: %s: the length of the api */
		printf( esc_html__( "<!-- API length: %s -->\n", 'include-fussball-de-widgets' ), esc_html( strlen( $attr['api'] ) ) );
		return __( '!!! The fussball.de API must have a length of exactly 32 characters. !!!', 'include-fussball-de-widgets' );
	}

	$new_attr = [
		'api'       => sanitize_text_field( strtoupper( preg_replace( '/[^\w]/', '', $attr['api'] ) ) ),
		'id'        => 'fubade_' . substr( $attr['api'], -5 ),
		'notice'    => empty( $attr['notice'] ) ? '' : sanitize_text_field( $attr['notice'] ),
		'fullwidth' => '1' === $attr['fullwidth'] || 'true' === $attr['fullwidth'] || true === $attr['fullwidth'] ? true : false,
		'devtools'  => '1' === $attr['devtools'] || 'true' === $attr['devtools'] || true === $attr['devtools'] ? true : false,
	];

	$log_msg             = $new_attr['devtools'] ? ifdw_console_log( $new_attr ) : ifdw_console_log( $new_attr, false );
	$new_attr['log_msg'] = $log_msg ? $log_msg : null;

	if ( ! wp_script_is( 'fubade-api' ) ) {
		wp_enqueue_script( 'fubade-api' );
	}

	wp_add_inline_script(
		'fubade-api',
		'new FussballdeWidgetAPI();',
		'after'
	);

	return ifdw_render_fubade_output( $new_attr );
}


/**
 * Render all the output.
 *
 * @since 3.0.0
 *
 * @param array $attr The output attributes (`api`, `id`, `notice`, `fullwidth` and `devtools`).
 *
 * @return string
 */
function ifdw_render_fubade_output( $attr ) {
	$output  = sprintf( '<div id="%s" class="include-fussball-de-widgets">', esc_html( $attr['id'] ) ) . PHP_EOL;
	$output .= ifdw_create_fubade_iframe( $attr );
	$output .= '</div>' . PHP_EOL;

	if ( $attr['log_msg'] ) {
		$output .= $attr['log_msg'];
	}

	// TODO: Control the Borlabs-Cookies especially for the widget class.
	// phpcs:disable
	// include_once ABSPATH . 'wp-admin/includes/plugin.php';
	// if ( is_plugin_active( 'borlabs-cookie/borlabs-cookie.php' ) ) {
	// return BorlabsCookieHelper()->blockContent( $output, 'ifdw_fubade' );
	// }
	// phpcs:enable

	return $output;
}


/**
 * Creates the iframe needed from fussball.de.
 *
 * @since 3.0.0
 *
 * @param array $attr The output attributes (`api`, `id`, `notice`, `fullwidth` and `devtools`).
 *
 * @return string
 */
function ifdw_create_fubade_iframe( $attr ) {
	// TODO: Perhaps a punycode variant is needed with IFDW_HOST.
	$src    = '//www.fussball.de/widget2/-/schluessel/' . $attr['api'] . '/target/' . $attr['id'] . '/caller/' . IFDW_HOST;
	$width  = $attr['fullwidth'] ? '100%' : '900px';
	$height = '200px';
	$style  = 'border: 1px solid #CECECE;';

	$output = "<iframe src='$src' frameborder='0' scrolling='no' width='$width' height='$height' style='$style'></iframe>" . PHP_EOL;

	return $output;
}
