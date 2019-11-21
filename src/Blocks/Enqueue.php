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

declare(strict_types=1);
namespace IFDW\Blocks;

use IFDW\Frontend\Fubade;

defined( 'ABSPATH' ) || exit();

/**
 * Class Enqueue provides Functions to register client-side assets (scripts and stylesheets) for the Gutenberg block.
 *
 * @since 3.0
 */
class Enqueue {
	/**
	 * The instance.
	 *
	 * @since 3.0
	 * @var self
	 */
	private static $instance;

	/**
	 * Enqueue constructor.
	 *
	 * @since 3.0
	 */
	private function __construct() {}

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
	 * Add the init action for registering the dynamic block.
	 *
	 * @since 3.0
	 * @return void
	 */
	public function addInitAction(): void {
		add_action( 'init', [ $this, 'registerDynamicBlock' ] );
	}

	/**
	 * Register the dynamic block.
	 *
	 * @since 3.0
	 * @return void
	 */
	public function registerDynamicBlock(): void {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		wp_register_script(
			'fubade-block-script',
			plugins_url( 'assets/js/blocks.js', IFDW_URL ),
			[],
			IFDW_VERSION,
			true
		);

		wp_set_script_translations( 'fubade-block-script', 'include-fussball-de-widgets' );

		wp_register_style(
			'fubade-block-style',
			plugins_url( 'assets/css/blocks-main.css', IFDW_URL ),
			[],
			IFDW_VERSION
		);

		register_block_type(
			'ifdw/fubade',
			[
				'attributes'      => [
					'id'        => [ 'type' => 'string' ],
					'api'       => [ 'type' => 'string' ],
					'notice'    => [ 'type' => 'string' ],
					'fullwidth' => [ 'type' => 'boolean' ],
					'devtools'  => [ 'type' => 'boolean' ],
				],
				'editor_script'   => 'fubade-block-script',
				'editor_style'    => 'fubade-block-style',
				'render_callback' => [ $this, 'render' ],
			]
		);
	}

	/**
	 * Creates the output to the sourcecode.
	 *
	 * @since 3.0
	 *
	 * @param array $attr The output attributes (`api`, `id`, `notice`, `fullwidth` and `devtools`).
	 *
	 * @return string The output to the sourcecode.
	 */
	public function render( array $attr ): string {
		return ( new Fubade() )->output( $attr );
	}
}
