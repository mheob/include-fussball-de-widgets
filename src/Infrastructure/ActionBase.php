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

namespace ITSB\IFDW\Infrastructure;

/**
 * The `ActionBase` class sets the general config for the actions.
 *
 * Actions are the hooks that the WordPress core launches at specific points
 * during execution, or when specific events occur. Plugins can specify that
 * one or more of its PHP functions are executed at these points, using the
 * Action API.
 *
 * @since 3.1
 */
abstract class ActionBase {
	/**
	 * Adds an action to the WordPress action system.
	 *
	 * This method registers a callback function to be executed when the specified
	 * action tag is triggered. The callback function is bound to the current
	 * instance of the `ActionBase` class.
	 *
	 * @since 3.0
	 * @param string $tag           The name of the action to which the callback function should
	 *                              be added.
	 * @param int    $priority      Optional. The priority at which the function should be fired.
	 *                              Default is 10.
	 * @param int    $acceptedArgs  Optional. The number of arguments the callback function should
	 *                              accept. Default is 1.
	 */
	public function addAction( string $tag, int $priority = 10, int $acceptedArgs = 1 ): void {
		add_action( $tag, [ $this, 'action' ], $priority, $acceptedArgs );
	}

	/**
	 * Executes the action logic.
	 *
	 * This method should be implemented by concrete subclasses of `ActionBase` to define the
	 * specific behavior of the action.
	 *
	 * @since 3.1
	 */
	abstract public function action(): void;
}
