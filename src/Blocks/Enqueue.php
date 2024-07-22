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

namespace ITSB\IFDW\Blocks;

use ITSB\IFDW\Frontend\Fubade;
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
	 * Registers the Fubade Gutenberg block and its associated assets.
	 *
	 * This method is responsible for registering the Fubade block with WordPress,
	 * including the block's JavaScript and CSS assets. It also sets up the
	 * necessary translations for the block.
	 *
	 * @since 4.0
	 */
	public function action(): void {
		if ( version_compare( get_bloginfo( 'version' ), Settings::MIN_WP, '<' ) ) {
			return;
		}

		wp_register_script(
			'fubade-block-script',
			plugins_url( 'assets/js/blocks.js', Settings::getPluginName() ),
			[],
			Settings::VERSION,
			true
		);

		wp_set_script_translations( 'fubade-block-script', 'include-fussball-de-widgets' );

		wp_register_style(
			'fubade-block-style',
			plugins_url( 'assets/css/blocks-main.css', Settings::getPluginName() ),
			[],
			Settings::VERSION
		);

		register_block_type(
			'ifdw/fubade',
			[
				'attributes'      => [
					'id'        => [ 'type' => 'string' ],
					'api'       => [ 'type' => 'string' ],
					'type'      => [ 'type' => 'string' ],
					'classes'   => [ 'type' => 'string' ],
					'notice'    => [ 'type' => 'string' ],
					'fullWidth' => [ 'type' => 'boolean' ],
					'devtools'  => [ 'type' => 'boolean' ],
				],
				'editor_script'   => 'fubade-block-script',
				'editor_style'    => 'fubade-block-style',
				'render_callback' => [ $this, 'render' ],
			]
		);
	}

	/**
	 * Renders the Fubade block.
	 *
	 * @since 3.0
	 * @param array $attr The block attributes
	 *                    (`api`, `id`, `classes`, `notice`, `fullWidth` and `devtools`).
	 * @return string The rendered block output.
	 */
	public function render( array $attr ): string {
		return ( new Fubade() )->output( $attr );
	}
}
