<?php
/*
  Plugin Name: Include Fussball.de Widgets
  Description: Easy integration of the Fussball.de widgets (currently in the version since season 2016). Use it like: [fubade id="{DIV-ID}" api="{32-digit API}" notice="description"]
  Version: 1.0
  Author: Alexander Böhm
  Author URI: http://profiles.wordpress.org/mheob
  Min WP Version: 4.8
  Max WP Version: 4.x
  Text Domain: fubade
  Domain Path: /languages
*/

/* define useful constants */
define( 'FUBADE_ID_VALUE', 'fubade' );
define( 'FUBADE_ID_KEY', 'id' );
define( 'FUBADE_API', 'api' );
define( 'FUBADE_NOTICE', 'notice' );

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

	printf( '<script type="text/javascript" src="%1$s"></script>', esc_url( plugins_url( "js/fubade-api.js", __FILE__ ) ) );
	printf( '<script type="text/javascript">new fussballdeWidgetAPI().showWidget("%1$s", "%2$s");</script>', $args[ FUBADE_ID_KEY ], $args[ FUBADE_API ] );

	return ob_get_clean();
}

add_shortcode( FUBADE_ID_VALUE, "fubade_shortcode" );
