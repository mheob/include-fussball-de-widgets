<?php
/*
  Plugin Name: Include Fussball.de Widgets
  Description: Easy integration of the Fussball.de widgets (currently in the version since season 2016). Use it like: [fubade id="{DIV-ID}" api="{32-digit API}" notice="description"]
  Version: 1.4
  Author: Alexander Böhm
  Author URI: http://profiles.wordpress.org/mheob
  Min WP Version: 4.8
  Max WP Version: 4.x
  Text Domain: include-fussball-de-widgets
  Domain Path: /languages
*/

/* define useful constants */
define( 'FUBADE_ID_VALUE', 'fubade' );
define( 'FUBADE_ID_KEY', 'id' );
define( 'FUBADE_API', 'api' );
define( 'FUBADE_NOTICE', 'notice' );


add_action( 'plugins_loaded', 'fubade_load_textdomain' );
/**
 * Register the textdomain for the l10n.
 */
function fubade_load_textdomain() {
	load_plugin_textdomain( 'include-fussball-de-widgets', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}


add_shortcode( FUBADE_ID_VALUE, "fubade_shortcode" );
/**
 * Generate the functionality of the shortcode.
 *
 * @param $atts
 *
 * @return string
 */
function fubade_shortcode( $atts ) {
	extract( shortcode_atts( array(
		FUBADE_ID_KEY => FUBADE_ID_VALUE,
		FUBADE_API    => '000',
		FUBADE_NOTICE => '...',
	), $atts ) );

	$args = shortcode_atts( array(
		FUBADE_ID_KEY => FUBADE_ID_VALUE,
		FUBADE_API    => '000',
		FUBADE_NOTICE => '...',
	), $atts );

	ob_start();

	printf( '<div id="%1$s" class="fubade">...', $args[ FUBADE_ID_KEY ] );
	/* translators: %1$s: the description of the widget */
	printf( __( 'the fussball.de widget with the description <i>%1$s</i> is currently loaded', FUBADE_ID_VALUE ), $args[ FUBADE_NOTICE ] );
	print ( '...</div>' );

	wp_enqueue_script( 'fubade-api', plugin_dir_url( __FILE__ ) . 'js/fubade-api.js' );
	wp_localize_script( 'fubade-api', FUBADE_ID_VALUE, array(
		'missing_div' => __( "Can't display the iframe. The following DIV is missing. ID = ", FUBADE_ID_VALUE ),
		FUBADE_ID_KEY => $args[ FUBADE_ID_KEY ],
		FUBADE_API    => $args[ FUBADE_API ],
	) );

	return ob_get_clean();
}
