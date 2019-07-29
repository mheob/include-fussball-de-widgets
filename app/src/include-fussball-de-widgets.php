<?php
/**
 * Plugin Name:    Include Fussball.de Widgets
 * Description:    Easy integration of the Fussball.de widgets (currently in the version since season 2016). Use it like: [fubade api="{32-digit API}" notice="description"]
 * Version:        2.2.3-b3
 * Author:         IT-Service Böhm -- Alexander Böhm
 * Author URI:     http://profiles.wordpress.org/mheob
 * License:        GPLv2
 * License URI:    https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:    include-fussball-de-widgets
 *
 * @package Include_Fussball_De_Widgets
 */

defined( 'ABSPATH' ) || exit;


define( 'IFDW_VERSION', '2.2.3-b3' );


/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'init-block.php';


/**
 * Shortcode Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'class-ifdw-shortcode.php';
new Ifdw_Shortcode();
