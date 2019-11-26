<?php declare( strict_types=1 );
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    IT Service Böhm -- Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 IT Service Böhm -- Alexander Böhm
 */

namespace ITSB\IFDW\Widgets;

use ITSB\IFDW\Infrastructure\ActionBase;

/**
 * Class Widgets register all Widgets from 'Include_Fussball_De_Widgets'.
 *
 * @since 3.0
 */
class Widgets extends ActionBase {
	/**
	 * Initialize all Widgets
	 *
	 * @since 3.0.0
	 * @return void
	 */
	public function action(): void {
		register_widget( '\\IFDW\\Widgets\\FubadeWidget' );
	}
}
