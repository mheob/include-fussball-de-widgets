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

namespace ITSB\IFDW\PhpUnit\Utils;

use ITSB\IFDW\Utils\Settings;

/**
 * Class TestHelper
 *
 * @since 3.1
 */
final class TestHelper {
	/**
	 * Restore the host to the default value.
	 *
	 * @since 3.1
	 * @return void
	 */
	public static function restoreHost() {
		$url = esc_url_raw( wp_unslash( $_SERVER['HTTP_HOST'] ?? '' ) );
		Settings::setHost( substr( $url, strpos( $url, ':' ) + 3 ) );
	}
}
