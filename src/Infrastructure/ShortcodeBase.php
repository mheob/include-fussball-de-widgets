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

namespace ITSB\IFDW\Infrastructure;

/**
 * The `ShortcodeBase` class sets the general config for the filter.
 *
 * Care should be taken through prefixing or other means to ensure that the
 * shortcode tag being added is unique and will not conflict with other,
 * already-added shortcode tags. In the event of a duplicated tag, the tag
 * loaded last will take precedence.
 *
 * @since 3.1
 */
abstract class ShortcodeBase {
	/**
	 * Add the init shortcode for registering the fubade api.
	 *
	 * @since 3.0
	 * @param string $tag The name of the shortcode to generate.
	 * @return void
	 */
	public function addShortcode( string $tag ): void {
		add_shortcode( $tag, [ $this, 'shortcode' ] );
	}

	/**
	 * The callback function to run when the shortcode is found. Every
	 * shortcode callback is passed three parameters by default, including
	 * an array of attributes ($atts), the shortcode content or null if not
	 * set ($content), and finally the shortcode tag itself ($shortcode_tag),
	 * in that order.
	 *
	 * @since 3.1
	 * @param array $atts An array fo attributes.
	 * @return string The output to the sourcecode.
	 */
	abstract public function shortcode( array $atts ): string;
}
