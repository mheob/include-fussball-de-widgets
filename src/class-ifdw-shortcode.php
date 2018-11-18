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
	 * The plugin direction
	 *
	 * @var string
	 */
	private $plugin_dir;

	/**
	 * Constructor function for the Ifdw_Shortcode class.
	 *
	 * @since 2.0.0
	 */
	public function __construct() {
		$this->plugin_dir = plugin_dir_path( dirname( __FILE__ ) );

		// Add the shortcode to init action of WordPress.
		add_shortcode( 'fubade', array( $this, 'render_shortcode' ) );
	}

	/**
	 * Render the shortcode
	 *
	 * @param array $atts Shortcode attributes (`id`, `api` and `notice`).
	 *
	 * @return string
	 */
	public function render_shortcode( $atts ) {
		$a = shortcode_atts(
			array(
				'id'     => '',
				'api'    => '',
				'notice' => 'Thanks for using the widget "include-fussball-de-widgets" <3.',
			),
			$atts
		);

		if ( 32 !== strlen( $a['api'] ) ) {
			return __( '!!! the API musst have a length of 32 digits !!!', 'include-fussball-de-widgets' );
		}

		$api    = sanitize_text_field( strtoupper( preg_replace( '/[^\w]/', '', $a['api'] ) ) );
		$notice = sanitize_text_field( $a['notice'] );

		$id_key = 'fubade_' . substr( $api, -5 );

		if ( ! wp_script_is( 'fubade_api' ) ) {
			$this->register_fubade_api();
		}

		$this->register_fubade_api_call( $id_key, $api );

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
			plugins_url( '/src/fubade-api.js', dirname( __FILE__ ) ),
			array(),
			filemtime( $this->plugin_dir . 'src/fubade-api.js' ),
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
	 * Register the calling script for the api from fussball.de.
	 *
	 * @since 2.0.0
	 *
	 * @param string $id  The id of the div-container.
	 * @param string $api The api code from the fussball.de widget.
	 */
	public function register_fubade_api_call( $id, $api ) {
		wp_add_inline_script(
			'fubade_api',
			"new FussballdeWidgetAPI().showWidget('$id', '$api');",
			'after'
		);
	}
}
