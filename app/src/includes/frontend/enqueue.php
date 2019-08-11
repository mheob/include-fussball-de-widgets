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
 * Functions to register script for the frontend.
 *
 * @since 3.0.0
 */

defined( 'ABSPATH' ) || exit();

/**
 * Register the api script for fussball.de.
 *
 * @since 3.0.0
 */
function ifdw_register_fubade_api() {
	wp_register_script(
		'fubade-api',
		plugins_url( 'assets/js/fubade-api.js', IFDW_URL ),
		[ 'wp-i18n' ],
		IFDW_VERSION,
		true
	);
	wp_set_script_translations( 'fubade-api', 'include-fussball-de-widgets' );
}
