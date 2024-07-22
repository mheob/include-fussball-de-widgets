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

namespace ITSB\IFDW\Widgets;

use ITSB\IFDW\Infrastructure\ActionBase;

/**
 * Class Widgets register all Widgets from 'Include_Fussball_De_Widgets'.
 *
 * @since 3.0
 */
class Widgets extends ActionBase {
	/**
	 * Registers the FubadeWidget widget.
	 *
	 * This method is responsible for registering the FubadeWidget widget with WordPress,
	 * allowing it to be used in the plugin.
	 *
	 * @since 3.0
	 */
	public function action(): void {
		register_widget( '\\ITSB\\IFDW\\Widgets\\FubadeWidget' );
	}
}
