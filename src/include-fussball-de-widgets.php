<?php
/**
 * Plugin Name:    Include Fussball.de Widgets
 * Description:    Easy integration of the Fussball.de widgets (currently in the version since season 2016). Use it like: [fubade id="{DIV-ID}" api="{32-digit API}" notice="description"]
 * Version:        2.0.0
 * Author:         Alexander Böhm
 * Author URI:     http://profiles.wordpress.org/mheob
 * License:        GPL-2.0-or-later
 * License URI:    https://www.gnu.org/licenses/gpl.html
 *
 * @package Include_Fussball_De_Widgets
 */

/**
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
 */

// Exit if not defined.
defined( 'ABSPATH' ) || exit;

// Generate the shortcode.
require_once __DIR__ . '/classes/class-fubade-shortcode.php';
new Include_Fussball_De_Widgets\Fubade_Shortcode();

// Generate the Gutenberg blocks only if Gutenberg is running.
if ( function_exists( 'register_block_type' ) ) {
	require_once __DIR__ . '/classes/class-fubade-block.php';
	new Include_Fussball_De_Widgets\Fubade_Block();
}
