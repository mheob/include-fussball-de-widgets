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
 * The `FilterBase` class sets the general config for the filter.
 *
 * WordPress offers filter hooks to allow plugins to modify various types
 * of internal data at runtime.
 *
 * A plugin can modify data by binding a callback to a filter hook. When the
 * filter is later applied, each bound callback is run in order of priority,
 * and given the opportunity to modify a value by returning a new value.
 *
 * @since 3.1
 */
abstract class FilterBase {
	/**
	 * Adds a filter to the WordPress filter system.
	 *
	 * This method allows the class to register a filter callback that will be executed
	 * when the specified filter tag is applied. The callback method is defined in the
	 * `filter()` abstract method.
	 *
	 * @since 3.0
	 * @param string $tag           The name of the filter to add the callback to.
	 * @param int    $acceptedArgs  The number of arguments the callback accepts.
	 * @param int    $priority      The priority at which the callback is executed.
	 */
	public function addFilter( string $tag, int $acceptedArgs = 1, int $priority = 10 ): void {
		add_filter( $tag, [ $this, 'filter' ], $priority, $acceptedArgs );
	}

	/**
	 * Filters the provided arguments and returns the modified array.
	 *
	 * This method must be implemented by concrete subclasses to provide the
	 * actual filtering logic. The number of arguments accepted by the filter
	 * is determined by the `$acceptedArgs` parameter passed to the `addFilter()`
	 * method.
	 *
	 * @since 3.1
	 * @param mixed ...$args The arguments to be filtered.
	 * @return array The filtered arguments.
	 */
	abstract public function filter( ...$args ): array;
}
