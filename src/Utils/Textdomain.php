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
 * Only needed for the Poedit workflow. The official translations comes
 * from wordpress.org.
 *
 * @since 3.0
 */
final class Textdomain extends ActionBase {
	/**
	 * Load the plugin textdomain.
	 *
	 * @since 3.0
	 * @return void
	 */
	public function action(): void {
		load_plugin_textdomain(
			'include-fussball-de-widgets',
			false,
			dirname( plugin_basename( Settings::getPluginName() ) ) . '/languages'
		);
	}
}
