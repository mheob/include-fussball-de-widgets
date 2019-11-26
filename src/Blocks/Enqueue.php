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

namespace ITSB\IFDW\Blocks;

use ITSB\IFDW\Infrastructure\ActionBase;
use ITSB\IFDW\Utils\Settings;

/**
 * The `Enqueue` class provides Functions to register client-side assets
 * (scripts and stylesheets) for the Gutenberg block.
 *
 * @since 3.0
 */
final class Enqueue extends ActionBase {
	/**
	 * Register the dynamic block.
	 *
	 * @since 3.0
	 * @return void
	 */
	public function action(): void {
		if ( version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ) {
			return;
		}

		wp_register_script(
			'fubade-block-script',
			plugins_url( 'assets/js/blocks.js', Settings::URL ),
			[],
			Settings::VERSION,
			true
		);

		wp_set_script_translations( 'fubade-block-script', 'include-fussball-de-widgets' );

		wp_register_style(
			'fubade-block-style',
			plugins_url( 'assets/css/blocks-main.css', Settings::URL ),
			[],
			Settings::VERSION
		);

		register_block_type(
			'ifdw/fubade',
			[
				'attributes'      => [
					'id'        => [ 'type' => 'string' ],
					'api'       => [ 'type' => 'string' ],
					'notice'    => [ 'type' => 'string' ],
					'fullwidth' => [ 'type' => 'boolean' ],
					'devtools'  => [ 'type' => 'boolean' ],
				],
				'editor_script'   => 'fubade-block-script',
				'editor_style'    => 'fubade-block-style',
				'render_callback' => [ $this, 'render' ],
			]
		);
	}

	/**
	 * Creates the output to the sourcecode.
	 *
	 * @since 3.0
	 *
	 * @param array $attr The output attributes (`api`, `id`, `notice`,
	 *                    `fullwidth` and `devtools`).
	 *
	 * @return string The output to the sourcecode.
	 */
	public function render( array $attr ): string {
		return ( new Fubade() )->output( $attr );
	}
}
