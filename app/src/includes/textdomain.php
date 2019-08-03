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
 * Informations about the plugin textdomain.
 * Only needed for the Poedit workflow. The official translations comes from wordpress.org.
 *
 * @since 3.0.0
 */

defined( 'ABSPATH' ) || exit();

/**
 * Load the plugin textdomain.
 *
 * @since 3.0.0
 */
function ifdw_load_textdomain() {
	load_plugin_textdomain( 'include-fussball-de-widgets', false, dirname( plugin_basename( IFDW_URL ) ) . '/languages' );
}
