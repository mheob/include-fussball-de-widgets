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

defined( 'ABSPATH' ) || exit;


/**
 * Class Ifdw_Shortcode
 *
 * @since 2.0.0
 */
class Ifdw_Shortcode {
	/**
	 * The id of the div-container.
	 *
	 * @var string
	 */
	private $id;

	/**
	 * The api code from the fussball.de widget.
	 *
	 * @var string
	 */
	private $api;

	/**
	 * The notice of the current widget.
	 *
	 * @var string
	 */
	private $notice;

	/**
	 * If TRUE the full_width will set; otherwise the default width will used.
	 *
	 * @var bool
	 */
	private $full_width;

	/**
	 * If TRUE the dev_tools will activated.
	 *
	 * @var boolean
	 */
	private $dev_tools;

	/**
	 * Constructor function for the Ifdw_Shortcode class.
	 *
	 * @since 2.0.0
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'register_fubade_api' ] );
		add_shortcode( 'fubade', [ $this, 'render_shortcode' ] );
	}


	/**
	 * Register the api script for fussball.de.
	 *
	 * @since 2.2.0
	 */
	public function register_fubade_api() {
		$js_file = 'js/fubade-api.js';
		wp_register_script(
			'fubade-api',
			plugins_url( $js_file, __FILE__ ),
			[ 'wp-i18n' ],
			filemtime( dirname( __FILE__ ) . '/' . $js_file ),
			true
		);
		wp_set_script_translations( 'fubade-api', 'include-fussball-de-widgets' );
	}


	/**
	 * Render the shortcode
	 *
	 * @since 2.0.0
	 *
	 * @param array $atts Shortcode attributes (`id`, `api`, `notice`, `fullwidth` and `devtools`).
	 *
	 * @return string
	 */
	public function render_shortcode( $atts ) {
		$a = shortcode_atts(
			[
				'id'        => '',
				'api'       => '',
				'notice'    => '',
				'fullwidth' => '',
				'devtools'  => '',
			],
			$atts
		);

		if ( 32 !== strlen( $a['api'] ) ) {
			$this->console_log( false );
			/* translators: %s: the length of the api */
			printf( esc_html__( "<!-- API length: %s -->\n", 'include-fussball-de-widgets' ), esc_html( strlen( $a['api'] ) ) );
			return __( '!!! The fussball.de API must have a length of exactly 32 characters. !!!', 'include-fussball-de-widgets' );
		}

		$this->api        = sanitize_text_field( strtoupper( preg_replace( '/[^\w]/', '', $a['api'] ) ) );
		$this->id         = 'fubade_' . substr( $this->api, -5 );
		$this->notice     = sanitize_text_field( $a['notice'] );
		$this->full_width = '1' === $a['fullwidth'] || 'true' === $a['fullwidth'] || true === $a['fullwidth'] ? 1 : 0;
		$this->dev_tools  = '1' === $a['devtools'] || 'true' === $a['devtools'] || true === $a['devtools'] ? 1 : 0;

		if ( ! wp_script_is( 'fubade-api' ) ) {
			wp_enqueue_script( 'fubade-api' );
		}

		$this->register_fubade_api_call();

		if ( $this->dev_tools ) {
			$this->console_log();
		}

		ob_start();

		printf( '<div id="%s" class="include-fussball-de-widgets" data-version="' . esc_html( IFDW_VERSION ) . '\">\n', esc_html( $this->id ) );
		/* translators: %s: the description of the widget */
		printf( esc_html__( "... the fussball.de widget with the description \"%s\" is currently loading ...\n", 'include-fussball-de-widgets' ), esc_html( $this->notice ) );
		print ( "</div>\n" );

		return ob_get_clean();
	}


	/**
	 * Register the calling script for the api from fussball.de.
	 *
	 * @since 2.0.0
	 */
	private function register_fubade_api_call() {
		wp_add_inline_script(
			'fubade-api',
			"new FussballdeWidgetAPI().showWidget( '$this->id', '$this->api', $this->full_width, $this->dev_tools );",
			'after'
		);
	}


	/**
	 * Generates a logging output in the browser console.
	 *
	 * @since 2.2.0
	 *
	 * @param boolean $in_console If true, the log is output to the debug console of the browser.
	 */
	private function console_log( $in_console = true ) {
		$logging_list = [
			esc_html__( 'api: ', 'include-fussball-de-widgets' ) . esc_html( $this->api ),
			esc_html__( 'notice: ', 'include-fussball-de-widgets' ) . esc_html( $this->notice ),
			esc_html__( 'fullwidth: ', 'include-fussball-de-widgets' ) . esc_html( $this->full_width ),
			esc_html__( 'devtools: ', 'include-fussball-de-widgets' ) . esc_html( $this->dev_tools ),
		];

		if ( $in_console ) {
			$output = '';
			foreach ( $logging_list as $logging_item ) {
				$output .= 'console.info(' . wp_json_encode( '[' . esc_html( $this->id ) . '] ' . $logging_item, JSON_HEX_TAG ) . ');' . PHP_EOL;
			};
			wp_add_inline_script( 'fubade-api', $output, 'after' );
		} else {
			foreach ( $logging_list as $logging_item ) {
				echo '<!--' . wp_json_encode( '[' . esc_html( $this->id ) . '] ' . $logging_item, JSON_HEX_TAG ) . '-->' . PHP_EOL;
			}
		}
	}
}
