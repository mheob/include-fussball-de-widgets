<?php
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 Alexander Böhm
 */

declare( strict_types=1 );

namespace ITSB\IFDW\Utils;

use ITSB\IFDW\Infrastructure\ActionBase;

/**
 * The `Textdomain` class register the used textdomain for local usages.
 *
 * Only needed for the Poedit workflow. The official translations comes from wordpress.org.
 *
 * @since 3.0
 */
final class Textdomain extends ActionBase {
	/**
	 * Loads the plugin's textdomain for localization.
	 *
	 * This method is called to load the textdomain for the plugin, which allows for
	 * localized strings to be used throughout the plugin. The textdomain is loaded
	 * from the 'languages' directory relative to the plugin's main file.
	 *
	 * @since 3.0
	 */
	public function action(): void {
		load_plugin_textdomain(
			'include-fussball-de-widgets',
			false,
			dirname( plugin_basename( Settings::getPluginName() ) ) . '/languages'
		);
	}
}
