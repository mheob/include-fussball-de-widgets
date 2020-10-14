<?php declare( strict_types=1 );
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 Alexander Böhm
 */

namespace ITSB\IFDW\Shortcodes;

use ITSB\IFDW\Infrastructure\ShortcodeBase;

/**
 * The `Fubade` class defines and render the fubade shortcode.
 *
 * @since 3.1
 */
final class Fubade extends ShortcodeBase {
	/**
	 * Render the fubade shortcode
	 *
	 * @since 3.0
	 * @param array $atts Shortcode attributes (`id`, `api`, `notice`,
	 *                    `fullwidth` and `devtools`).
	 * @return string The output to the sourcecode.
	 */
	public function shortcode( array $atts ): string {
		$a = shortcode_atts(
			[
				'id'        => '',
				'api'       => '',
				'notice'    => '',
				'fullwidth' => '',
				'devtools'  => '',
			],
			$atts
		);

		return ( new \ITSB\IFDW\Frontend\Fubade() )->output( $a );
	}
}
