<?php
/**
 * Include Fussball.de Widgets
 * Copyright (C) 2019 IT-Service Böhm - Alexander Böhm <ab@its-boehm.de>
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Include_Fussball_De_Widgets
 */

declare( strict_types=1 );
namespace IFDW\Utils;

defined( 'ABSPATH' ) || exit;

/**
 * Class PluginActions adds additional information to the plugin on the plugin page.
 *
 * @since 3.0
 */
class PluginActions {
	/**
	 * The instance.
	 *
	 * @since 3.0
	 * @var self
	 */
	private static $instance;

	/**
	 * The PluginActions constructor.
	 *
	 * @since 3.0
	 */
	private function __construct() { }

	/**
	 * Get the instance.
	 *
	 * @since 3.0
	 * @return self The instance of the class.
	 */
	public static function getInstance(): self {
		return self::$instance ?? new static();
	}

	/**
	 * Add the plugin_row_meta filter.
	 *
	 * @since 3.0
	 * @return void
	 */
	public function addPluginRowMetaFilter(): void {
		add_filter( 'plugin_row_meta', [ $this, 'addLinksToRowMeta' ], 10, 2 );
	}

	/**
	 * Additional links on plugin page.
	 * Add additional links to the plugin on the plugin page along with meta information.
	 *
	 * @since 3.0
	 *
	 * @param array  $links List of existing plugin meta links.
	 * @param string $file  The current plugin in the loop of filtering.
	 *
	 * @return array List of modified plugin meta links.
	 */
	public function addLinksToRowMeta( array $links, string $file ): array {
		if ( plugin_basename( IFDW_URL ) !== $file ) {
			return $links;
		}

		$href      =
			esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H6AM3N8GGMTQS&source=url' );
		$ariaLabel = esc_attr__( 'Plugin Additional Links', 'include-fussball-de-widgets' );
		$linkText  = esc_html__( 'Donate', 'include-fussball-de-widgets' );
		$rowMeta   = [ 'docs' => "<a href=\"$href\" target=\"_blank\" aria-label=\"$ariaLabel\">$linkText</a>" ];

		return array_merge( $links, $rowMeta );
	}
}
