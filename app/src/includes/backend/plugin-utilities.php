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
 * Plugin utilities.
 *
 * @since 3.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Additional links on plugin page.
 *
 * Add additional links to the plugin on the plugin page along with meta information.
 *
 * @since 3.0.0
 *
 * @param  array  $links List of existing plugin meta links.
 * @param  string $file The current plugin in the loop of filtering.
 * @return array  List of modified plugin meta links.
 */
function ifdw_plugin_action_links( $links, $file ) {
	if ( plugin_basename( IFDW_URL ) === $file ) {
		$row_meta = [
			'docs' => '<a href="' . esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H6AM3N8GGMTQS' ) . '" 
										target="_blank"
										aria-label="' . esc_attr__( 'Plugin Additional Links', 'include-fussball-de-widgets' ) . '">
										' . esc_html__( 'Donate', 'include-fussball-de-widgets' ) . '
								</a>',
		];

		return array_merge( $links, $row_meta );
	}

	return $links;
}
