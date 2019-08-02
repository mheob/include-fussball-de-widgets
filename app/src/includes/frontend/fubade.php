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
 * @param array $attr The output attributes (`id`, `api`, `notice`, `fullwidth` and `devtools`).
 *
 * @return string
 */
function ifdw_create_fubade_output( $attr ) {
	$log_fired = false;

	if ( $attr['devtools'] ) {
		$log_fired = ifdw_console_log( $attr );
	}

	if ( ! $log_fired ) {
		$log_fired = ifdw_console_log( $attr, false );
	}

	if ( ! wp_script_is( 'fubade-api-dummy' ) ) {
		wp_enqueue_script( 'fubade-api-dummy' );
	}

	wp_add_inline_script(
		'fubade-api-dummy',
		ifdw_add_js_event_listener(),
		'after'
	);

	return ifdw_render_fubade_output( $attr );
}


/**
 * Render all the output.
 *
 * @since 3.0.0
 *
 * @param array $attr The output attributes (`id`, `api`, `notice`, `fullwidth` and `devtools`).
 *
 * @return string
 */
function ifdw_render_fubade_output( $attr ) {
	// TODO: Test the render function.
	$output  = sprintf( '<div id="%s" class="include-fussball-de-widgets">', esc_html( $attr['id'] ) ) . PHP_EOL;
	$output .= ifdw_create_fubade_iframe( $attr );
	$output .= '</div>' . PHP_EOL;

	return $output;
}


/**
 * Creates the iframe needed from fussball.de.
 *
 * @since 3.0.0
 *
 * @param array $attr The output attributes (`id`, `api`, `notice`, `fullwidth` and `devtools`).
 *
 * @return string
 */
function ifdw_create_fubade_iframe( $attr ) {
	// TODO: Perhaps a punycode variant is needed with get_home_url().
	$src    = '//www.fussball.de/widget2/-/schluessel/' . $attr['api'] . '/target/' . $attr['id'] . '/caller/' . get_home_url();
	$width  = $attr['fullwidth'] ? '100%' : '900px';
	$height = '200px';
	$style  = 'border: 1px solid #CECECE;';

	$output  = "<iframe src='$src' frameborder='0' scrolling='no' width='$width' height='$height' style='$style'>" . PHP_EOL;
	$output .= esc_html_e( '... the fussball.de widget is currently loading ...', 'include-fussball-de-widgets' ) . PHP_EOL;
	$output .= '</iframe>' . PHP_EOL;

	return $output;
}

/**
 * Returns the needed event listener for the messages from fussball.de.
 *
 * @return string
 */
function ifdw_add_js_event_listener() {
	$output = 'window.FussballdeWidgetAPI = () => {
  window.addEventListener(
    "message",
    evt => {
      const currentIframe = document.querySelector("#" + evt.data.container + " > iframe");

      if ("setHeight" === evt.data.type) {
        currentIframe.setAttribute("height", evt.data.value + "px");
        currentIframe.style.height = ";
        currentIframe.style.minHeight = "200px";
      }

      if ("setWidth" === evt.data.type) {
        if ("100%" !== currentIframe.getAttribute("width")) {
          currentIframe.setAttribute("width", evt.data.value + "px");
        }

        currentIframe.style.width = "";
      }
    },
    false
  );
};';

	return $output;
}
