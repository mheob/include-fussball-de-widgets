<?php
/**
 * Include Fussball.de Widgets
 * Copyright (C) 2018 IT-Service Böhm - Alexander Böhm <ab@its-boehm.de>
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
 * Initializer of the blocks and other functions.
 *
 * Enqueue CSS/JS of all the blocks.
 * Initial the shortcode.
 *
 * @since   2.0.0
 * @package Include_Fussball_De_Widgets
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Register the dynamic block.
 *
 * `id`: the id talks between the html and the fussball.de api.
 * `api`: the official and individuell api snippet from fussball.de.
 * `notice`: an short description for the user.
 *
 * @since 2.0.0
 */
function register_dynamic_blocks() {
	// Scripts.
	wp_register_script(
		'ifdw-block',
		plugins_url( '/dist/blocks.build.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'dist/blocks.build.js' ),
		true
	);

	// Styles.
	wp_register_style(
		'ifdw-editor-block',
		plugins_url( '/dist/blocks.editor.build.css', __FILE__ ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'dist/blocks.editor.build.css' )
	);

	// The Block.
	if ( function_exists( 'register_block_type' ) ) {
		register_block_type(
			'ifdw/fubade',
			array(
				'attributes'      => array(
					'id'     => array(
						'type' => 'string',
					),
					'api'    => array(
						'type' => 'string',
					),
					'notice' => array(
						'type' => 'string',
					),
				),
				'editor_script'   => 'ifdw-block',
				'editor_style'    => 'ifdw-editor-block',
				'render_callback' => 'ifdw_render_block_fubade',
			)
		);
	}
}
add_action( 'init', 'register_dynamic_blocks' );


/**
 * Define the dynamic block.
 *
 * @param array $attributes Block attributes.
 *
 * @return string
 *
 * @since 2.0.0
 */
function ifdw_render_block_fubade( $attributes ) {
	require_once plugin_dir_path( __FILE__ ) . 'class-ifdw-shortcode.php';

	return ( new Ifdw_Shortcode() )->render_shortcode( $attributes );
}
