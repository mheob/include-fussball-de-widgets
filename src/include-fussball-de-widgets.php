<?php
/**
 * Plugin Name:    Include Fussball.de Widgets
 * Description:    Easy integration of the Fussball.de widgets (currently in the version since season 2016). Use it like: [fubade id="{DIV-ID}" api="{32-digit API}" notice="description"]
 * Author:         Alexander Böhm
 * Author URI:     http://profiles.wordpress.org/mheob
 * Min WP Version: 4.8
 * Max WP Version: 5.x
 * Text Domain:    include-fussball-de-widgets
 * Version:        2.0.0
 *
 * @package Include_Fussball_De_Widgets
 */

// Exit if not defined.
defined( 'ABSPATH' ) || exit;

// Generate the shortcode.
require_once __DIR__ . '/classes/class-fubade-shortcode.php';
new Include_Fussball_De_Widgets\Fubade_Shortcode();

// Generate the Gutenberg blocks only if Gutenberg is running.
if ( function_exists( 'register_block_type' ) ) {
	require_once __DIR__ . '/classes/class-fubade-block.php';
	new Include_Fussball_De_Widgets\Fubade_Block();
}
