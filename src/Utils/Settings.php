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

namespace ITSB\IFDW\Utils;

use ITSB\IFDW\Utils\Host;

/**
 * The `Settings` class hold all needed global variables and constants.
 *
 * @since 3.1
 */
class Settings {
	public const VERSION           = '3.6.0';
	public const MIN_PHP           = '7.2.0';
	public const MIN_WP            = '4.8';
	public const SERVER_NAME_DUMMY = 'HTTP_HOST-not-set';

	/**
	 * The name of this plugin.
	 *
	 * @since 3.1
	 * @var string
	 */
	private static $pluginName;

	/**
	 * The hostname of the WordPress running system.
	 *
	 * @since 3.1
	 * @var string
	 */
	private static $host;

	/**
	 * Get the value of plugin name.
	 *
	 * @since 3.1
	 * @return string
	 */
	public static function getPluginName() {
		return self::$pluginName;
	}

	/**
	 * Set the value of plugin name.
	 *
	 * @since 3.1
	 * @param string $pluginName The plugin name.
	 * @return void
	 */
	public static function setPluginName( $pluginName ) {
		self::$pluginName = $pluginName;
	}

	/**
	 * Get the the value of hostname.
	 *
	 * @since 3.1
	 * @return string
	 */
	public static function getHost(): string {
		return self::$host;
	}

	/**
	 * Set the the value of hostname.
	 *
	 * @since 3.1
	 * @return void
	 */
	public static function setHost(): void {
		// phpcs:disable
		$port = $_SERVER['SERVER_PORT'] ?? null;
		$host = $_SERVER['HTTP_HOST'] ?? '';
		// phpcs:enable

		if ( ! $port || ! $host || '' === $host || 'localhost' === $host || '127.0.01' === $host ) {
			self::$host = 'localhost';
			return;
		}

		$url        = esc_url_raw( wp_unslash( $host ?? '' ) );
		self::$host = Host::cleanHost( substr( $url, strpos( $url, ':' ) + 3 ) ?: null );
	}
}
