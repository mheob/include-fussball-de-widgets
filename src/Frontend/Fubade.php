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
		'UUID'       => 'uuid',
	];

	/**
	 * The attributes (`api`, `id`, `classes`, `notice`, `fullWidth` and `devtools`).
	 *
	 * @since 3.0
	 * @var array
	 */
	private $attr = [];


	/**
	 * Outputs the widget content based on the provided attributes.
	 *
	 * @since 4.0
	 * @param array $attr The attributes for the widget rendering
	 *                    (`api`, `id`, `type`, `classes`, `notice`, `fullWidth` and `devtools`).
	 * @return string The rendered widget content.
	 */
	public function output( array $attr ): string {
		$this->setAttr( $attr );

		$this->attr = [
			'api'       => sanitize_text_field( trim( $this->attr['api'] ) ),
			'id'        => StringHelper::startsWith( $this->attr['id'], 'fubade-' )
										? sanitize_text_field( trim( $this->attr['id'] ) )
										// phpcs:ignore Generic.Files.LineLength
										: 'fubade-' . random_int( 10, 99 ) . '-' . substr( $this->attr['api'], -5 ),
			'type'      => sanitize_text_field( trim( $this->attr['type'] ) ),
			'classes'   => empty( $this->attr['classes'] )
										? ''
										: sanitize_text_field( $this->attr['classes'] ),
			'notice'    => empty( $this->attr['notice'] )
										? ''
										: sanitize_text_field( $this->attr['notice'] ),
			'fullWidth' => '0' === $this->attr['fullWidth']
										|| 'false' === $this->attr['fullWidth']
										|| false === $this->attr['fullWidth']
										? false : true,
			'devtools'  => '1' === $this->attr['devtools']
										|| 'true' === $this->attr['devtools']
										|| true === $this->attr['devtools']
										? true : false,
			'isLegacy'  => 32 === strlen( $this->attr['api'] ) ? true : false,
		];

		$api = $this->attr['api'];

		if ( ! wp_script_is( 'fubade-api' ) ) {
			wp_enqueue_script( 'fubade-api' );
		}

		if ( $this->attr['devtools'] ) {
			wp_localize_script( 'fubade-api', 'attr', [ 'devtools' => $this->attr['devtools'] ] );
		}

		wp_add_inline_script( 'fubade-api', 'fussballDeWidgetAPI();', 'after' );

		if ( strlen( $api ) !== 32 && strlen( $api ) !== 36 ) {
			ConsoleLogger::getInstance()->log( $this->attr );
			return $this->render( self::ERROR['API_LENGTH'] );
		}

		if ( strlen( $api ) === 36 && ! StringHelper::isValidUUID( $api ) ) {
			ConsoleLogger::getInstance()->log( $this->attr );
			return $this->render( self::ERROR['UUID'] );
		}

		if ( strtolower( Settings::getHost() ) === strtolower( Settings::SERVER_NAME_DUMMY ) ) {
			ConsoleLogger::getInstance()->log( $this->attr );
			return $this->render( self::ERROR['HTTP_HOST'] );
		}

		return $this->render( null );
	}

	/**
	 * Sets the attributes for the widget rendering.
	 *
	 * @since 4.0
	 * @param array $attr The attributes for the widget rendering
	 *                    (`api`, `id`, `type`, `classes`, `notice`, `fullWidth` and `devtools`).
	 */
	private function setAttr( array $attr ): void {
		$this->attr = [
			'api'       => $attr['api'] ?? '',
			'id'        => $attr['id'] ?? 'ERROR_' . time(),
			'type'      => $attr['type'] ?? '',
			'classes'   => $attr['classes'] ?? '',
			'notice'    => $attr['notice'] ?? '',
			'fullWidth' => $attr['fullWidth'] ?? false,
			'devtools'  => $attr['devtools'] ?? false,
			'isLegacy'  => $attr['isLegacy'] ?? true,
		];
	}

	/**
	 * Generates the HTML attributes for the widget element.
	 *
	 * This method creates the `id`, `class`, and `style` attributes for the widget
	 * element based on the widget's attributes.
	 *
	 * @since 4.0
	 * @return string The HTML attributes for the widget element.
	 */
	private function getElementAttributes(): string {
		$idAttribute = 'id="' . esc_attr( $this->attr['id'] ) . '"';

		$classAttribute = ' class="include-fussball-de-widgets';
		if ( '' !== $this->attr['classes'] ) {
			$classAttribute .= ' ' . esc_attr( $this->attr['classes'] ) . '"';
		}
		$classAttribute .= '"';

		$styleAttribute = '';

		return $idAttribute . $classAttribute . $styleAttribute;
	}

	/**
	 * Renders the widget output.
	 *
	 * @since 4.0
	 * @param string|null $error Potential errors to display.
	 * @return string The rendered widget output.
	 */
	private function render( ?string $error ): string {
		if ( $error ) {
			return $this->renderError( $error );
		}

		if ( $this->attr['devtools'] ) {
			ConsoleLogger::getInstance()->log( $this->attr );
		}

		if ( $this->attr['isLegacy'] ) {
			return $this->renderLegacy();
		}

		return $this->renderCurrent();
	}

	/**
	 * Renders the error output for the widget.
	 *
	 * @since 4.0
	 * @param string $error The error message to display.
	 * @return string The error output HTML.
	 */
	private function renderError( string $error ): string {
		$styleAttribute =
		// phpcs:ignore Generic.Files.LineLength
		' style="padding:1rem;background-color:#f2dede;color:#a94442;border:1px solid #ebccd1;border-radius:4px"';
		$content = $this->getErrorOutput( $error );

		$output  = '<div' . $styleAttribute . '>' . PHP_EOL;
		$output .= "\t" . $content . PHP_EOL;
		$output .= '</div>' . PHP_EOL;

		ConsoleLogger::getInstance()->log( $this->attr );

		return $output;
	}

	/**
	 * Generates an HTML output for the legacy version of the fussball.de widget.
	 *
	 * This method creates an iframe element with the fussball.de widget and wraps it
	 * in a div element with the appropriate attributes. It also logs the widget attributes
	 * if the 'devtools' option is enabled.
	 *
	 * @since 4.0
	 * @return string The HTML output for the legacy version of the widget.
	 */
	private function renderLegacy(): string {
		$content = $this->createIframe();

		$output  = '<div ' . $this->getElementAttributes() . '>' . PHP_EOL;
		$output .= "\t" . $content . PHP_EOL;
		$output .= '</div>' . PHP_EOL;

		return $output;
	}

	/**
	 * Generates the HTML output for the current version of the fussball.de widget.
	 *
	 * This method creates an iframe element with the fussball.de widget and wraps it
	 * in a div element with the appropriate attributes, including data attributes
	 * for the widget's API key and type.
	 *
	 * @since 4.0
	 * @return string The HTML output for the current version of the widget.
	 */
	private function renderCurrent(): string {
		$classAttribute = 'class="fussballde_widget include-fussball-de-widgets';
		if ( '' !== $this->attr['classes'] ) {
			$classAttribute .= ' ' . esc_attr( $this->attr['classes'] ) . '"';
		}
		$classAttribute .= '"';

		$dataId   = ' data-id="' . $this->attr['api'] . '"';
		$dataType = ' data-type="' . $this->attr['type'] . '"';

		return "<div $classAttribute $dataId $dataType></div>" . PHP_EOL;
	}

	/**
	 * Generates the error output for the widget.
	 *
	 * @since 4.0
	 * @param string|null $error The error message to display.
	 * @return string The error output HTML.
	 */
	private function getErrorOutput( ?string $error ): string {
		switch ( $error ) {
			case self::ERROR['API_LENGTH']:
				$output  = __(
					'!! The fussball.de API must have a length of exactly 32 or 36 characters. !!',
					'include-fussball-de-widgets'
				) . PHP_EOL;
				$output .= sprintf( /* translators: %s: The length of the api. */
					esc_html__( 'Currently the API length is: %s', 'include-fussball-de-widgets' ),
					esc_html( strlen( $this->attr['api'] ) )
				);
				return $output;
			case self::ERROR['UUID']:
				return __(
					// phpcs:ignore Generic.Files.LineLength
					'!! The fussball.de API with a length of 36 characters must be a valid UUID. !!',
					'include-fussball-de-widgets'
				);
			case self::ERROR['HTTP_HOST']:
				return __(
					// phpcs:ignore Generic.Files.LineLength
					'The PHP variable <code>$_SERVER["HTTP_HOST"]</code> was not set by the server.',
					'include-fussball-de-widgets'
				);
			default:
				return __( 'An undefined error has occurred.', 'include-fussball-de-widgets' );
		}
	}

	/**
	 * Generates an iframe element with the fussball.de widget.
	 *
	 * @since 4.0
	 * @return string The HTML for the iframe element.
	 */
	private function createIframe(): string {
		$src    = '//www.fussball.de/widget2/-/schluessel/' . $this->attr['api'];
		$src   .= '/target/' . $this->attr['id'];
		$src   .= '/caller/' . Settings::getHost();
		$width  = $this->attr['fullWidth'] ? '100%' : '900px';
		$height = '100%';
		$style  = 'border: 1px solid #CECECE; overflow: hidden; min-height: 200px;';
		$attrs  = "src='$src' width='$width' height='$height' scrolling='no' style='$style'";

		return "<iframe $attrs></iframe>";
	}
}
