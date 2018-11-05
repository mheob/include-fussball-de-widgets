<?php
/**
  * Plugin Name:    Include Fussball.de Widgets
  * Description:    Easy integration of the Fussball.de widgets (currently in the version since season 2016). Use it like: [fubade id="{DIV-ID}" api="{32-digit API}" notice="description"]
  * Author:         Alexander Böhm
  * Author URI:     http://profiles.wordpress.org/mheob
  * Min WP Version: 4.8
  * Max WP Version: 5.x
  * Text Domain:    include-fussball-de-widgets
  * Domain Path:    /languages
  * Version:        2.0.0
  * 
  * @package        Include_Fussball_de_Widgets
  */

require_once __DIR__ . "/blocks/fubade.php";


add_action( 'plugins_loaded', 'fubade_load_textdomain' );
/**
 * Register the textdomain for the l10n.
 */
function fubade_load_textdomain() {
	load_plugin_textdomain( 'include-fussball-de-widgets', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}


/**
 * Register the shortcode
 */
function fubade_init() {
  add_shortcode( 'fubade', 'fubade_render_shortcode' );
  
	if ( function_exists( 'register_block_type' ) ) {
		register_block_type( 'include-fussball-de-widgets/fubade', array(
			'render_callback' => 'fubade_render_shortcode',
		) );
	}
}
add_action( 'init', 'fubade_init' );


/**
 * Render the shortcode
 *
 * @param array $atts Shortcode attributes.
 * 
 * @return string
 */
function fubade_render_shortcode( $atts ) {
  if ( empty( $atts["api"] ) ) {
    return "";
  }

	ob_start();

	$api    = strtoupper( preg_replace( '/[^\w]/', '', $atts["api"] ) );
	$id_key = preg_replace( '/[^\w]/', '', $atts["id"] );
	$id_key = is_numeric( $id_key ) ? 'fubade_' . $id_key : $id_key;

	/* translators: %1$s: the description of the widget */
  printf( '<!-- STARTS The widget "%1$s" from include-fussball-de-widgets -->', $atts["notice"] );
	printf( '<div id="%1$s" class="%2$s">...', $id_key, "fubade" );
	/* translators: %1$s: the description of the widget */
	printf( __( 'the fussball.de widget with the description <i>%1$s</i> is currently loading', "fubade" ), $atts["notice"] );
	print ( '...</div>' );
	/* translators: %1$s: the description of the widget */
  printf( '<!-- ENDS The widget "%1$s" from include-fussball-de-widgets -->', $atts["notice"] );

	/** @noinspection HtmlUnknownTarget */
	echo '<script type="text/javascript" src="' . plugin_dir_url( __FILE__ ) . 'js/fubade-api.js"></script>';
	echo '<script type="text/javascript">new FussballdeWidgetAPI().showWidget("' . $id_key . '", "' . $api . '");</script>';

	return ob_get_clean();
}
