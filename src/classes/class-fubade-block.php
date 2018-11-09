<?php
/**
 * Include Fussball.de Widgets
 * Copyright (C) 2018 IT-Service Böhm - Alexander Böhm <ab@its-boehm.de>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 3 as published
 * by the Free Software Foundation.
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

namespace Include_Fussball_De_Widgets;

// Exit if not defined.
defined( 'ABSPATH' ) || exit;

/**
 * Class Fubade_Block
 *
 * @since 2.0.0
 */
class Fubade_Block {
	/**
	 * The plugin direction
	 *
	 * @var string
	 */
	private $plugin_dir;

	/**
	 * Constructor function for the Fubade_Block class.
	 *
	 * @since 2.0.0
	 */
	public function __construct() {
		$this->plugin_dir = plugin_dir_path( dirname( __FILE__ ) );

		// Add the scripts and styles to the WordPress backend.
		add_action( 'enqueue_block_editor_assets', array( $this, 'register_editor_scripts_for_fubade' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'register_editor_styles_for_fubade' ) );

		// Add the styles to the WordPress frontend.
		add_action( 'enqueue_block_assets', array( $this, 'register_styles_for_fubade' ) );
	}

	/**
	 * Register the fubade scripts.
	 *
	 * @since 2.0.0
	 */
	public function register_editor_scripts_for_fubade() {
		// Register Gutenberg block.
		wp_enqueue_script(
			'fubade-editor-block',
			plugins_url( '/js/blocks-include-fussball-de-widgets.js', dirname( __FILE__ ) ),
			array( 'wp-element', 'wp-blocks', 'wp-i18n', 'wp-components', 'wp-editor' ),
			filemtime( $this->plugin_dir . 'js/blocks-include-fussball-de-widgets.js' ),
			true
		);

		wp_localize_script(
			'fubade-editor-block',
			'fubadeBlockScript',
			array(
				'plugin_dir' => $this->plugin_dir,
			)
		);

		// Register the api from fussball.de.
		if ( wp_script_is( 'fubade_api' ) ) {
			return;
		}

		wp_enqueue_script(
			'fubade_api',
			plugins_url( '/js/fubade-api.js', dirname( __FILE__ ) ),
			array(),
			filemtime( $this->plugin_dir . 'js/fubade-api.js' ),
			false
		);

		// phpcs:disable
		// // Or use this for the original external script
		// wp_enqueue_script(
		// 'fubade_api',
		// plugins_url( 'http://www.fussball.de/static/layout/fbde2/egm//js/widget2.js', dirname( __FILE__ ) ),
		// array(),
		// filemtime( 'http://www.fussball.de/static/layout/fbde2/egm//js/widget2.js' ),
		// false
		// );
		// phpcs:enable
	}

	/**
	 * Register the fubade styles.
	 *
	 * @since 2.0.0
	 */
	public function register_editor_styles_for_fubade() {
		// Register gutenberg map block.
		wp_enqueue_style(
			'fubade-editor-block',
			plugins_url( '/css/editor.css', dirname( __FILE__ ) ),
			array(),
			filemtime( $this->plugin_dir . 'css/editor.css' )
		);
	}

	/**
	 * Register the fubade styles.
	 *
	 * @since 2.0.0
	 */
	public function register_styles_for_fubade() {
		// Register gutenberg map block.
		wp_enqueue_style(
			'fubade-block',
			plugins_url( '/css/styles.css', dirname( __FILE__ ) ),
			array(),
			filemtime( $this->plugin_dir . 'css/styles.css' )
		);
	}
}
