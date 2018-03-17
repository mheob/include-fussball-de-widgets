<?php
/*
  Plugin Name: Include Fussball.de Widgets
  Description: Easy integration of the Fussball.de widgets (currently in the version since season 2016). Use it like: [fubade id="{DIV-ID}" api="{32-digit API}" notice="description"]
  Version: 1.6
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

	$id_key = preg_replace( '/[^\w]/', '', $args[ FUBADE_ID_KEY ] );
	$api    = strtoupper( preg_replace( '/[^\w]/', '', $args[ FUBADE_API ] ) );

	printf( '<div id="%1$s" class="fubade">...', $id_key );
	/* translators: %1$s: the description of the widget */
	printf( __( 'the fussball.de widget with the description <i>%1$s</i> is currently loading', FUBADE_ID_VALUE ), $args[ FUBADE_NOTICE ] );
	print ( '...</div>' );

	/** @noinspection HtmlUnknownTarget */
	echo '<script type="text/javascript" src="' . plugin_dir_url( __FILE__ ) . 'js/fubade-api.js"></script>';

	echo '<script type="text/javascript">new FussballdeWidgetAPI().showWidget("' . $id_key . '", "' . $api . '");</script>';

	return ob_get_clean();
}
