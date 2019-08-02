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
 * @since 3.0.0
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

	if ( 32 !== strlen( $a['api'] ) ) {
		ifdw_console_log( $a );
		/* translators: %s: the length of the api */
		printf( esc_html__( "<!-- API length: %s -->\n", 'include-fussball-de-widgets' ), esc_html( strlen( $a['api'] ) ) );
		return __( '!!! The fussball.de API must have a length of exactly 32 characters. !!!', 'include-fussball-de-widgets' );
	}

	$a['api']       = sanitize_text_field( strtoupper( preg_replace( '/[^\w]/', '', $a['api'] ) ) );
	$a['id']        = 'fubade_' . substr( $a['api'], -5 );
	$a['notice']    = sanitize_text_field( $a['notice'] );
	$a['fullwidth'] = '1' === $a['fullwidth'] || 'true' === $a['fullwidth'] || true === $a['fullwidth'] ? 1 : 0;
	$a['devtools']  = '1' === $a['devtools'] || 'true' === $a['devtools'] || true === $a['devtools'] ? 1 : 0;

	// TODO: Test the function calls.
	return ifdw_create_fubade_output( $a );
}
