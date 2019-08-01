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
 * Render the output of the widget from `fussball.de`.
 *
 * @since 3.0.0
 */

/**
 * Render all the output to the sourcecode.
 *
 * @since 3.0.0
 *
 * @param array $arr The output attributes (`id`, `api`, `notice`, `fullwidth` and `devtools`).
 *
 * @return string
 */
function ifdw_render_fubade_output( $arr ) {
	// TODO: Test the render function.
	$output  = sprintf( '<div id="%s" class="include-fussball-de-widgets">', esc_html( $arr['id'] ) ) . PHP_EOL;
	$output .= ifdw_create_fubade_iframe( $attr );
	$output .= '</div>' . PHP_EOL;

	return ob_get_clean();
}


/**
 * Render all the output to the sourcecode.
 *
 * @since 3.0.0
 *
 * @param array $arr The output attributes (`id`, `api`, `notice`, `fullwidth` and `devtools`).
 *
 * @return string
 */
function ifdw_create_fubade_iframe( $arr ) {
	// TODO: Test the iframe creation function.
	$src    = '//www.fussball.de/widget2/-/schluessel/' . $arr['api'] . '/target/' . $arr['id'] . '/caller/' . get_home_url();
	$width  = $arr['fullwidth'] ? '100%' : '900px';
	$height = '200px';
	$style  = 'border: 1px solid #CECECE;';

	$output  = "<iframe src='$src' frameborder='0' scrolling='no' width='$width' height='$height' style='$style'>" . PHP_EOL;
	$output .= esc_html_e( '... the fussball.de widget is currently loading ...', 'include-fussball-de-widgets' ) . PHP_EOL;
	$output .= '</iframe>' . PHP_EOL;

	return $output;
}
