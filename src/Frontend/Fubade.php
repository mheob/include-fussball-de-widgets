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

namespace ITSB\IFDW\Frontend;

use ITSB\IFDW\Utils\Logging\ConsoleLogger;
use ITSB\IFDW\Utils\Settings;
use ITSB\IFDW\Utils\StringHelper;

/**
 * The `Fubade` class used to create the output of the widget from `fussball.de`.
 *
 * @since 3.0
 */
final class Fubade {
	private const ERROR = [
		'API_LENGTH' => 'api-length',
		'HTTP_HOST'  => 'no-server-name',
	];

	/**
	 * The attributes (`api`, `id`, `classes`, `notice`, `fullWidth` and `devtools`).
	 *
	 * @since 3.0
	 * @var array
	 */
	private $attr = [];

	/**
	 * Creates the output to the sourcecode.
	 *
	 * @since 3.0
	 *
	 * @param array $attr The output attributes (`api`, `id`, `classes`, `notice`, `fullWidth` and `devtools`).
	 * @return string The output to the sourcecode.
	 */
	public function output( array $attr ): string {
		// TODO [#33]: Configure default setting in the admin area.
		$this->setAttr( $attr );

		$this->attr = [
			'api'       => sanitize_text_field( strtoupper( preg_replace( '/[^\w]/', '', $this->attr['api'] ) ) ),
			'id'        => StringHelper::startsWith( $this->attr['id'], 'fubade-' )
										? sanitize_text_field( $this->attr['id'] )
										: 'fubade-' . random_int( 10, 99 ) . '-' . substr( $this->attr['api'], -5 ),
			'classes'   => empty( $this->attr['classes'] ) ? '' : sanitize_text_field( $this->attr['classes'] ),
			'notice'    => empty( $this->attr['notice'] ) ? '' : sanitize_text_field( $this->attr['notice'] ),
			'fullWidth' => '1' === $this->attr['fullWidth']
										|| 'true' === $this->attr['fullWidth']
										|| true === $this->attr['fullWidth']
										? true : false,
			'devtools'  => '1' === $this->attr['devtools']
										|| 'true' === $this->attr['devtools']
										|| true === $this->attr['devtools']
										? true : false,
		];

		if ( ! wp_script_is( 'fubade-api' ) ) {
			wp_enqueue_script( 'fubade-api' );
		}

		if ( $this->attr['devtools'] ) {
			wp_localize_script( 'fubade-api', 'attr', [ 'devtools' => $this->attr['devtools'] ] );
		}

		wp_add_inline_script( 'fubade-api', 'fussballDeWidgetAPI();', 'after' );

		if ( strlen( $this->attr['api'] ) !== 32 ) {
			ConsoleLogger::getInstance()->log( $this->attr );
			return $this->render( self::ERROR['API_LENGTH'] );
		}

		if ( strtolower( Settings::getHost() ) === strtolower( Settings::SERVER_NAME_DUMMY ) ) {
			ConsoleLogger::getInstance()->log( $this->attr );
			return $this->render( self::ERROR['HTTP_HOST'] );
		}

		return $this->render( null );
	}

	/**
	 * Set the attribute array.
	 *
	 * @since 3.0
	 * @param array $attr The attributes (`api`, `id`, `classes`, `notice`, `fullWidth` and `devtools`)
	 *                    for the widget rendering.
	 * @return void
	 */
	private function setAttr( array $attr ): void {
		$this->attr = [
			'api'       => $attr['api'] ?? '',
			'id'        => $attr['id'] ?? 'ERROR_' . time(),
			'classes'   => $attr['classes'] ?? '',
			'notice'    => $attr['notice'] ?? '',
			'fullWidth' => $attr['fullWidth'] ?? false,
			'devtools'  => $attr['devtools'] ?? false,
		];
	}

	/**
	 * Render all the output.
	 *
	 * @since 3.0
	 * @param string|null $error Potential errors.
	 * @return string The rendered the output.
	 */
	private function render( ?string $error ): string {
		$idAttribute = ' id="' . esc_attr( $this->attr['id'] ) . '"';

		$classAttribute = ' class="include-fussball-de-widgets';
		if ( '' !== $this->attr['classes'] ) {
			$classAttribute .= ' ' . esc_attr( $this->attr['classes'] ) . '"';
		}
		$classAttribute .= '"';

		if ( $error ) {
			$content        = $this->getErrorOutput( $error );
			$styleAttribute =
			' style="padding:1rem;background-color:#f2dede;color:#a94442;border:1px solid #ebccd1;border-radius:4px"';
		} else {
			$content        = $this->createIframe();
			$styleAttribute = '';
		}

		$output  = '<div' . $idAttribute . $classAttribute . $styleAttribute . '>' . PHP_EOL;
		$output .= "\t" . $content . PHP_EOL;
		$output .= '</div>' . PHP_EOL;

		if ( $this->attr['devtools'] ) {
			ConsoleLogger::getInstance()->log( $this->attr );
		}

		return $output;
	}

	/**
	 * Returns the error output content.
	 *
	 * @since 3.6
	 * @param string|null $error Potential errors.
	 * @return string The error output content.
	 */
	private function getErrorOutput( ?string $error ): string {
		switch ( $error ) {
			case self::ERROR['API_LENGTH']:
				$output  = __(
					'!!! The fussball.de API must have a length of exactly 32 characters. !!!',
					'include-fussball-de-widgets'
				) . PHP_EOL;
				$output .= sprintf( /* translators: %s: The length of the api. */
					esc_html__( 'Currently the API length is: %s', 'include-fussball-de-widgets' ),
					esc_html( strlen( $this->attr['api'] ) )
				);
				return $output;
			case self::ERROR['HTTP_HOST']:
				return __(
					'The PHP variable <code>$_SERVER["HTTP_HOST"]</code> was not set by the server.',
					'include-fussball-de-widgets'
				);
			default:
				return __( 'An undefined error has occurred.', 'include-fussball-de-widgets' );
		}
	}

	/**
	 * Creates the iframe needed from fussball.de.
	 *
	 * @since 3.0
	 * @return string The iframe.
	 */
	private function createIframe(): string {
		$src    = '//www.fussball.de/widget2/-/schluessel/' . $this->attr['api'];
		$src   .= '/target/' . $this->attr['id'];
		$src   .= '/caller/' . Settings::getHost();
		$width  = $this->attr['fullWidth'] ? '100%' : '900px';
		$height = '100%';
		$style  = 'border: 1px solid #CECECE; overflow: hidden; min-height: 200px;';

		return "<iframe src='$src' width='$width' height='$height' scrolling='no' style='$style'></iframe>";
	}
}
