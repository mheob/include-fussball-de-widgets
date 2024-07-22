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

use ITSB\IFDW\Infrastructure\FilterBase;

/**
 * The `PluginActions` class adds additional information to the plugin on the
 * plugin page.
 *
 * @since 3.0
 */
final class PluginActions extends FilterBase {
	/**
	 * Filters the plugin action links.
	 *
	 * This method is used to add additional links to the plugin page in the WordPress
	 * admin dashboard.
	 *
	 * @since 3.0
	 * @param array ...$args An array of plugin action links and files.
	 * @return array The updated array of plugin action links.
	 */
	public function filter( ...$args ): array {
		$links = func_get_arg( 0 );
		$file  = func_get_arg( 1 );

		if ( Settings::getPluginName() !== $file ) {
			return $links;
		}

		$href      =
			esc_url( 'https://www.paypal.me/mheob' );
		$ariaLabel = esc_attr__( 'Plugin Additional Links', 'include-fussball-de-widgets' );
		$linkText  = esc_html__( 'Donate', 'include-fussball-de-widgets' );
		// phpcs:ignore Generic.Files.LineLength
		$rowMeta = [ 'docs' => "<a href=\"$href\" target=\"_blank\" aria-label=\"$ariaLabel\">$linkText</a>" ];

		return array_merge( $links, $rowMeta );
	}
}
