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
 * Widget Initializer
 *
 * Register all widgets from 'Include_Fussball_De_Widgets'.
 *
 * @since   3.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Initialize all widgets
 *
 * @since   3.0.0
 */
function ifdw_widgets_init() {
	register_widget( 'IFDW_Fubade_Widget' );
}
