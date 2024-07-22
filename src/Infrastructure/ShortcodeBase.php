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
	 * Adds a WordPress shortcode with the given tag.
	 *
	 * The `shortcode` method will be called whenever the shortcode is used in a post or page.
	 *
	 * @since 3.0
	 * @param string $tag The shortcode tag to register.
	 */
	public function addShortcode( string $tag ): void {
		add_shortcode( $tag, [ $this, 'shortcode' ] );
	}
	/**
	 * Renders the shortcode content.
	 *
	 * This method is called whenever the shortcode is used in a post or page. It should
	 * return the HTML content to be displayed in place of the shortcode.
	 *
	 * @since 3.1
	 * @param array $atts An associative array of shortcode attributes.
	 * @return string The HTML content to be displayed.
	 */
	abstract public function shortcode( array $atts ): string;
}
