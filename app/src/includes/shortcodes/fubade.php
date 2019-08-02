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

	// TODO: Test the function calls.
	return ifdw_create_fubade_output( $a );
}
