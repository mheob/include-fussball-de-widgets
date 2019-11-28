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
	 * Create and return an instance of the plugin.
	 *
	 * This always returns a shared instance. This way, outside code can always
	 * get access to the object instance of the plugin.
	 *
	 * @return Plugin Plugin instance.
	 */
	public static function create(): Plugin {
		static $plugin = null;
		if ( null === $plugin ) {
			$plugin = new Plugin();
		}
		return $plugin;
	}
}
