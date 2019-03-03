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
 * Shortcode Initializer
 *
 * Define and render the shortcode.
 *
 * @since   2.0.0
 * @package Include_Fussball_De_Widgets
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class Ifdw_Shortcode
 *
 * @since 2.0.0
 */
class Ifdw_Shortcode {
	/**
	 * Constructor function for the Ifdw_Shortcode class.
	 *
	 * @since 2.0.0
	 */
	public function __construct() {
		// Add the shortcode to init action of WordPress.
		add_shortcode( 'fubade', array( $this, 'render_shortcode' ) );
	}


	/**
	 * Render the shortcode
	 *
	 * @since 2.0.0
	 *
	 * @param array $atts Shortcode attributes (`id`, `api` and `notice`).
	 *
	 * @return string
	 */
	public function render_shortcode( $atts ) {
		$a = shortcode_atts(
			array(
				'id'        => '',
				'api'       => '',
				'notice'    => '',
				'fullwidth' => '',
			),
			$atts
		);

		if ( 32 !== strlen( $a['api'] ) ) {
			return __( '!!! The fussball.de API must have a length of exactly 32 characters. !!!', 'include-fussball-de-widgets' );
		}

		$notice     = sanitize_text_field( $a['notice'] );
		$api        = sanitize_text_field( strtoupper( preg_replace( '/[^\w]/', '', $a['api'] ) ) );
		$id_key     = 'fubade_' . substr( $api, -5 );
		$full_width = sanitize_text_field( $a['fullwidth'] );
		$full_width = '1' === $full_width || 'true' === $full_width || true === $full_width ? true : false;

		if ( ! wp_script_is( 'fubade_api' ) ) {
			$this->register_fubade_api();
		}

		$this->register_fubade_api_call( $id_key, $api, $full_width );

		ob_start();

		printf( "<div id=\"%s\" class=\"include-fussball-de-widgets\">\n", esc_html( $id_key ) );
		/* translators: %s: the description of the widget */
		printf( esc_html__( "... the fussball.de widget with the description \"%s\" is currently loading ...\n", 'include-fussball-de-widgets' ), esc_html( $notice ) );
		print ( "</div>\n" );

		return ob_get_clean();
	}


	/**
	 * Register the api from fussball.de.
	 *
	 * @since 2.0.0
	 */
	public function register_fubade_api() {
		wp_enqueue_script(
			'fubade_api',
			plugins_url( 'fubade-api.js', __FILE__ ),
			array(),
			filemtime( plugin_dir_path( __FILE__ ) . 'fubade-api.js' ),
			false
		);
	}


	/**
	 * Register the calling script for the api from fussball.de.
	 *
	 * @since 2.0.0
	 *
	 * @param string $id  The id of the div-container.
	 * @param string $api The api code from the fussball.de widget.
	 * @param bool   $full_width If TRUE the full_width will set; otherwise the default width will used.
	 */
	public function register_fubade_api_call( $id, $api, $full_width ) {
		wp_add_inline_script(
			'fubade_api',
			"new FussballdeWidgetAPI().showWidget( '$id', '$api', $full_width );",
			'after'
		);
	}
}
