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
	 * Add the init action for registering the fubade api.
	 *
	 * @since 3.0
	 * @param string $tag          The name of the action to hook the callback
	 *                             to.
	 * @param int    $priority     (Optional) Used to specify the order in
	 *                             the functions associated with a particular
	 *                             action are executed. Lower numbers correspond
	 *                             with earlier execution, and functions with
	 *                             the same priority are executed in the order
	 *                             in which they were added to the action.
	 *                             Default 10.
	 * @param int    $acceptedArgs (Optional) The number of arguments the
	 *                             function accepts. Default 1.
	 * @return void
	 */
	public function addAction( string $tag, int $priority = 10, int $acceptedArgs = 1 ): void {
		add_action( $tag, [ $this, 'action' ], $priority, $acceptedArgs );
	}

	/**
	 * The action callback to be run when the action is applied.
	 *
	 * @since 3.1
	 * @return void
	 */
	abstract public function action(): void;
}
