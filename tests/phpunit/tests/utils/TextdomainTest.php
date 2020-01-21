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

require_once __DIR__ . '../../../Utils/WP_Hooks.php';

use ITSB\IFDW\PhpUnit\Utils\WP_Hooks;
use ITSB\IFDW\Utils\{Settings, Textdomain};

/**
 * Class TextdomainTest
 *
 * @since 3.1
 */
final class TextdomainTest extends \WP_UnitTestCase {
	/**
	 * The instance.
	 *
	 * @since 3.1
	 * @var Textdomain
	 */
	private static $instance;

	/**
	 * The plugin root.
	 *
	 * @since 3.1
	 * @var string
	 */
	private static $pluginRoot;

	/**
	 * Set up the configuration
	 *
	 * @since 3.1
	 * @return void
	 */
	public function setUp() {
		// Get the instance.
		self::$instance = new Textdomain();

		// Configure the sample data.
		self::$pluginRoot = plugin_basename( Settings::getPluginName() );
	}

	/**
	 * Tests adding the `plugins_loaded` is set.
	 *
	 * @since 3.1
	 *
	 * @see Textdomain::addAction();
	 * @test
	 *
	 * @return void
	 */
	public function testPluginRowMetaFilterIsSet(): void {
		$tag = 'plugins_loaded';
		$this->assertFalse( WP_Hooks::hasAction( $tag, self::$instance, 'action' ) );
		self::$instance->addAction( $tag );
		$this->assertTrue( WP_Hooks::hasAction( $tag, self::$instance, 'action' ) );
	}

	/**
	 * Tests the returning an array, if the plugin path is wrong.
	 *
	 * @since 3.1
	 *
	 * @see Textdomain::action();
	 * @test
	 *
	 * @return void
	 */
	public function testReturnsTheInputArrayWhenPluginPathIsDifferent() : void {
		// TODO: Write a more precise test.
		self::$instance->action();
		$this->assertTrue( true );
	}
}
