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

namespace ITSB\IFDW\PhpUnit\Tests\Utils;

use ITSB\IFDW\Shortcodes\Fubade;

/**
 * Class FubadeTest
 *
 * @since 3.1
 */
final class FubadeTest extends \WP_UnitTestCase {
	/**
	 * The instance.
	 *
	 * @since 3.1
	 * @var Fubade
	 */
	private static $instance;

	/**
	 * A few sample links.
	 *
	 * @since 3.1
	 * @var array
	 */
	private static $sampleAtts = [
		'api'       => '12345678901234567890123456789012',
		'id'        => 'fubade_12345',
		'notice'    => 'my notice',
		'fullwidth' => true,
		'devtools'  => true
	];

	/**
	 * Set up the configuration
	 *
	 * @since 3.1
	 * @return void
	 */
	public function setUp() {
		// Get the instance.
		self::$instance = new Fubade();
	}

	/**
	 * Tests the `fubade` shortcode is added.
	 *
	 * @since 3.1
	 *
	 * @see Fubade::addShortcode();
	 * @test
	 *
	 * @return void
	 */
	public function testFubadeShortcodeIsAdded(): void {
		remove_shortcode( 'fubade' );
		$this->assertFalse( shortcode_exists( 'fubade' ) );
		self::$instance->addShortcode();
		$this->assertTrue( shortcode_exists( 'fubade' ) );
	}

	/**
	 * Tests the returning of the fubade shortcode output.
	 *
	 * @since 3.1
	 *
	 * @see Fubade::shortcode();
	 * @test
	 *
	 * @return void
	 */
	public function testReturnsTheFubadeShortcodeOutput() : void {
		// phpcs:disable Generic.Files.LineLength.MaxExceeded
		$expected  = '<div id="fubade_89012" class="include-fussball-de-widgets">' . PHP_EOL;
		$expected .= "<iframe src='//www.fussball.de/widget2/-/schluessel/12345678901234567890123456789012/target/fubade_89012/caller/example.org' width='100%' height='200px' scrolling='no' style='border: 1px solid #CECECE; overflow: hidden'></iframe>" . PHP_EOL;
		$expected .= '</div>' . PHP_EOL;
		// phpcs:enable

		$this->assertEquals( $expected, self::$instance->shortcode( self::$sampleAtts ) );
	}
}
