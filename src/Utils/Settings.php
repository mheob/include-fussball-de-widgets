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

use ITSB\IFDW\Utils\Host;

/**
 * The `Settings` class hold all needed global variables and constants.
 *
 * @since 3.1
 */
class Settings {
	public const VERSION           = '4.0.0';
	public const MIN_PHP           = '7.4.0';
	public const MIN_WP            = '4.8';
	public const SERVER_NAME_DUMMY = 'HTTP_HOST-not-set';

	/**
	 * The plugin name.
	 *
	 * @since 3.1
	 * @var string
	 */
	private static $pluginName;

	/**
	 * The hostname of the current server.
	 *
	 * @since 3.1
	 * @var string
	 */
	private static $host;

	/**
	 * Get the value of plugin name.
	 *
	 * @since 3.1
	 * @return string The plugin name.
	 */
	public static function getPluginName() {
		return self::$pluginName;
	}

	/**
	 * Sets the plugin name.
	 *
	 * @since 3.1
	 * @param string $pluginName The plugin name to set.
	 */
	public static function setPluginName( $pluginName ) {
		self::$pluginName = $pluginName;
	}

	/**
	 * Gets the hostname of the current server.
	 *
	 * @since 3.1
	 * @return string The hostname of the current server.
	 */
	public static function getHost(): string {
		return self::$host;
	}

	/**
	 * Sets the hostname of the current server.
	 *
	 * This method attempts to retrieve the hostname from the `$_SERVER` superglobal.
	 * If the hostname is not set or is a local hostname, it defaults to 'localhost'.
	 * Otherwise, it cleans and returns the hostname.
	 *
	 * @since 3.1
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
		$cleanedUrl = substr( $url, strpos( $url, ':' ) + 3 );
		self::$host = Host::cleanHost( false !== $cleanedUrl ? $cleanedUrl : null );
	}
}
