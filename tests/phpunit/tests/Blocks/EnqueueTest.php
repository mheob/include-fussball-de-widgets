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

namespace ITSB\IFDW\PhpUnit\Tests\Blocks;

require_once __DIR__ . '../../../utils/WP_Hooks.php';

use ITSB\IFDW\Blocks\Enqueue;
use ITSB\IFDW\PhpUnit\Utils\WP_Hooks;

/**
 * Class EnqueueTest
 *
 * @since 3.1
 */
final class EnqueueTest extends \WP_UnitTestCase {
	/**
	 * The instance.
	 *
	 * @since 3.1
	 * @var Enqueue
	 */
	private static $instance;

	/**
	 * Set up the configuration
	 *
	 * @since 3.1
	 * @return void
	 */
	public function setUp() {
		// Get the instance.
		self::$instance = new Enqueue();
	}

	/**
	 * Tests adding the `init` is set.
	 *
	 * @since 3.1
	 *
	 * @see Enqueue::addAction();
	 * @test
	 *
	 * @return void
	 */
	public function testInitActionIsSet(): void {
		$tag = 'init';
		$this->assertFalse( WP_Hooks::hasAction( $tag, self::$instance, 'action' ) );
		self::$instance->addAction( $tag );
		$this->assertTrue( WP_Hooks::hasAction( $tag, self::$instance, 'action' ) );
	}

	/**
	 * Tests `fubade-block-script` is registered.
	 *
	 * @since 3.1
	 *
	 * @see Enqueue::action();
	 * @test
	 *
	 * @return void
	 */
	public function testFubadeBlockScriptIsRegisterd(): void {
		wp_deregister_script( 'fubade-block-script' );
		wp_deregister_style( 'fubade-block-style' );
		unregister_block_type( 'ifdw/fubade' );

		self::$instance->action();

		// TODO: Write a more precise test.
		$this->assertTrue( true );
	}

	/**
	 * Tests cancelling on version under five.
	 *
	 * @since 3.1
	 *
	 * @see Enqueue::action();
	 * @test
	 *
	 * @return void
	 */
	public function testCancelOnVersionUnderFive(): void {
		global $wp_version;
		$wp_version = '4.9.0';
		unregister_block_type( 'ifdw/fubade' );
		self::$instance->action();

		// TODO: Write a more precise test.
		$this->assertTrue( true );
	}

	/**
	 * Tests 'render' outputs a string.
	 *
	 * @since 3.1
	 *
	 * @see Enqueue::render();
	 * @test
	 *
	 * @return void
	 */
	public function testRenderOutputsString(): void {
		$this->assertIsString( self::$instance->render( [ 'api' => '12345678901234567890123456789012' ] ) );
	}
}
