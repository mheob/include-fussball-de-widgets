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
 * Functions to register client-side assets (scripts and stylesheets) for the Gutenberg block.
 *
 * @since   2.0.0
 * @package Include_Fussball_De_Widgets
 */

defined( 'ABSPATH' ) || exit();

/**
 * Register the dynamic block.
 *
 * `id`: the id talks between the html and the fussball.de api.
 * `api`: the official and individuell api snippet from fussball.de.
 * `notice`: an short description for the user.
 *
 * @since 2.0.0
 */
function ifdw_fubade_block_init() {
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	$dir = dirname( __FILE__ );

	$js_file = 'js/fubade-block.js';
	wp_register_script(
		'fubade-block-editor',
		plugins_url( $js_file, __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		filemtime( "$dir/$js_file" ),
		true
	);

	$editor_css = 'css/editor-block.css';
	wp_register_style(
		'fubade-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	// $style_css = 'css/frontend-block.css';
	// wp_register_style(
	// 'fubade-block',
	// plugins_url( $style_css, __FILE__ ),
	// array(),
	// filemtime( "$dir/$style_css" )
	// );
	register_block_type(
		'ifdw/fubade',
		array(
			'attributes'      => array(
				'id'        => array( 'type' => 'string' ),
				'api'       => array( 'type' => 'string' ),
				'notice'    => array( 'type' => 'string' ),
				'fullwidth' => array( 'type' => 'boolean' ),
			),
			'editor_script'   => 'fubade-block-editor',
			'editor_style'    => 'fubade-block-editor',
			'style'           => 'fubade-block',
			'render_callback' => 'ifdw_render_block_fubade',
		)
	);
}
add_action( 'init', 'ifdw_fubade_block_init' );

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
