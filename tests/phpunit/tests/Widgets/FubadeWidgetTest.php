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

namespace ITSB\IFDW\PhpUnit\Tests\Widgets;

use ITSB\IFDW\Widgets\FubadeWidget;

/**
 * Class FubadeWidgetTest
 *
 * @since 3.1
 */
final class FubadeWidgetTest extends \WP_UnitTestCase {
	/**
	 * The instance.
	 *
	 * @since 3.1
	 * @var FubadeWidget
	 */
	private static $instance;

	/**
	 * The sample attributes.
	 *
	 * @since 3.1
	 * @var array
	 */
	private $attributes = [
		'title'     => 'Fussball.de Widget',
		'api'       => '12345678901234567890123456789012',
		'fullwidth' => null,
		'devtools'  => '1'
	];

	/**
	 * The updated attributes.
	 *
	 * @since 3.1
	 * @var array
	 */
	private $updatedAttributes;

	/**
	 * Set up the configuration
	 *
	 * @since 3.1
	 * @return void
	 */
	public function setUp() {
		// Get the instance.
		self::$instance = new FubadeWidget();

		// Set the updatedAttributes property.
		$this->updatedAttributes = self::$instance->update( $this->attributes, $this->attributes );
	}

	/**
	 * Test the updated instance array should contains special values.
	 *
	 * @since 3.1
	 *
	 * @see FubadeWidget::update()
	 * @test
	 *
	 * @return void
	 */
	public function testUpdatedAttributesArrayShouldContainsSpecialValues() {
		$expectedAttributes = [
			'title'     => 'Fussball.de Widget',
			'api'       => '12345678901234567890123456789012',
			'fullwidth' => false,
			'devtools'  => 1
		];

		$this->assertSame( $expectedAttributes, $this->updatedAttributes );
	}

	/**
	 * Test the output contains the expected string.
	 *
	 * @since 3.1
	 *
	 * @see FubadeWidget::widget()
	 * @test
	 *
	 * @return void
	 */
	public function testOutputContainsExpectedString() {
		$args = [
			'before_widget' => '',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
			'after_widget'  => ''
		];

		// phpcs:disable Generic.Files.LineLength.MaxExceeded
		$expected  = PHP_EOL;
		$expected .= '&lt;h3&gt;Fussball.de Widget&lt;/h3&gt;' . PHP_EOL;
		$expected .= '&lt;div id=&quot;fubade_89012&quot; class=&quot;include-fussball-de-widgets&quot;&gt;' . PHP_EOL;
		$expected .= '&lt;iframe src=&#039;//www.fussball.de/widget2/-/schluessel/12345678901234567890123456789012/target/fubade_89012/caller/example.org&#039; width=&#039;900px&#039; height=&#039;200px&#039; scrolling=&#039;no&#039; style=&#039;border: 1px solid #CECECE; overflow: hidden&#039;&gt;&lt;/iframe&gt;' . PHP_EOL;
		$expected .= '&lt;/div&gt;' . PHP_EOL;
		$expected .= PHP_EOL;
		// phpcs:enable

		$this->expectOutputString( $expected );
		self::$instance->widget( $args, $this->updatedAttributes );

		// TODO: Check BorlabsCookie is loaded.
	}

	/**
	 * Test the form output contains the expected string.
	 *
	 * @since 3.1
	 *
	 * @see FubadeWidget::form()
	 * @test
	 *
	 * @return void
	 */
	public function testFormOutputContainsExpectedString() {
		$expected  = '<p>';
		$expected .= '<label for="TITLE">';
		$expected .= 'Title: ';
		$expected .= '</label>';
		$expected .= '<input';
		$expected .= 'type="text"';
		$expected .= 'class="widefat"';
		$expected .= 'id="ID';
		$expected .= 'name="TITLE"';
		$expected .= 'value="TITLE">';
		$expected .= '</p>';

		$expected .= '<p>';
		$expected .= '<label for="API">';
		$expected .= 'API: ';
		$expected .= '</label>';
		$expected .= '<input';
		$expected .= 'type="text"';
		$expected .= 'class="widefat"';
		$expected .= 'pattern="[A-Za-z0-9]{32}"';
		$expected .= 'id="ID';
		$expected .= 'name="API"';
		$expected .= 'value="API">';
		$expected .= '</p>';

		$expected .= '<p>';
		$expected .= '<input';
		$expected .= 'id="FULL_WIDTH';
		$expected .= 'name="FULL_WIDTH"';
		$expected .= 'type="checkbox"';
		$expected .= 'value="1">';
		$expected .= '<label for="FULL_WIDTH">';
		$expected .= 'FULL_WIDTH: ';
		$expected .= '</label>';
		$expected .= '</p>';

		$expected .= '<p>';
		$expected .= '<input';
		$expected .= 'id="DEVTOOLS';
		$expected .= 'name="DEVTOOLS"';
		$expected .= 'type="checkbox"';
		$expected .= 'checked';
		$expected .= 'value="1">';
		$expected .= '<label for="DEVTOOLS">';
		$expected .= 'DEVTOOLS: ';
		$expected .= '</label>';
		$expected .= '</p>';

		$this->expectOutputString( $expected );
		self::$instance->form( $this->updatedAttributes );
	}
}
