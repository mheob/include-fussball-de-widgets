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

require_once __DIR__ . '../../../utils/WP_Hooks.php';

use ITSB\IFDW\Utils\PluginActions;
use ITSB\IFDW\PhpUnit\Utils\WP_Hooks;
use ITSB\IFDW\Utils\Settings;

/**
 * Class PluginActionsTest
 *
 * @since 3.1
 */
final class PluginActionsTest extends \WP_UnitTestCase {
	/**
	 * The instance.
	 *
	 * @since 3.1
	 * @var PluginActions
	 */
	private static $instance;

	/**
	 * A few sample links.
	 *
	 * @since 3.1
	 * @var array
	 */
	private static $links;

	/**
	 * Set up the configuration
	 *
	 * @since 3.1
	 * @return void
	 */
	public function setUp() {
		// Get the instance.
		self::$instance = new PluginActions();

		// Configure the sample data.
		self::$links = [ '<a href="#">FAQ</a>', '<a href="#">Support</a>' ];
	}

	/**
	 * Tests adding the `plugin_row_meta` is set.
	 *
	 * @since 3.1
	 *
	 * @see PluginActions::addFilter();
	 * @test
	 *
	 * @return void
	 */
	public function testPluginRowMetaFilterIsSet(): void {
		$tag = 'plugin_row_meta';
		$this->assertFalse( WP_Hooks::hasFilter( $tag, self::$instance, 'filter' ) );
		self::$instance->addFilter( $tag );
		$this->assertTrue( WP_Hooks::hasFilter( $tag, self::$instance, 'filter' ) );
	}

	/**
	 * Tests the returning an array, if the plugin path is wrong.
	 *
	 * @since 3.1
	 *
	 * @see PluginActions::filter();
	 * @test
	 *
	 * @return void
	 */
	public function testReturnsTheInputArrayWhenPluginPathIsDifferent() : void {
		$sampleFunctionCall = self::$instance->filter( [ self::$links, 'wrong path' ] );

		$this->assertIsArray( $sampleFunctionCall );
		$this->assertSame( self::$links, $sampleFunctionCall );
		$this->assertEquals( 2, count( $sampleFunctionCall ) );
	}

	/**
	 * Tests the returning an array.
	 *
	 * @since 3.1
	 *
	 * @see PluginActions::filter();
	 * @test
	 *
	 * @return void
	 */
	public function testReturnsTheUpdatedArrayOfRowMetaLinks(): void {
		$sampleFunctionCall = self::$instance->filter( [ self::$links, plugin_basename( Settings::URL ) ] );

		$this->assertIsArray( $sampleFunctionCall );
		$this->assertEquals( 3, count( $sampleFunctionCall ) );
	}
}
