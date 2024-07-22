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

namespace ITSB\IFDW;

/**
 * The plugin factory is responsible for instantiating the plugin and
 * returning that instance.
 *
 * It can decide whether to return a shared or a fresh instance as needed.
 *
 * To read more about why this is preferable to a Singleton:
 *
 * @see https://www.alainschlesser.com/singletons-shared-instances/
 *
 * @since 3.1
 */
final class PluginFactory {
	/**
	 * Creates a singleton instance of the Plugin class.
	 *
	 * This method ensures that only one instance of the Plugin class is created and returned.
	 * If an instance has already been created, it will return the existing instance instead
	 * of creating a new one.
	 *
	 * @since 3.1
	 * @return Plugin The singleton instance of the Plugin class.
	 */
	public static function create(): Plugin {
		static $plugin = null;
		if ( null === $plugin ) {
			$plugin = new Plugin();
		}
		return $plugin;
	}
}
