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

namespace ITSB\IFDW\PhpUnit\Tests\Infrastructure;

use ITSB\IFDW\Infrastructure\Autoloader;

/**
 * Class AutoloaderTest
 *
 * @since 3.1
 */
final class AutoloaderTest extends \WP_UnitTestCase {
	/**
	 * The instance.
	 *
	 * @since 3.1
	 * @var Autoloader
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
		self::$instance = new Autoloader();
	}

	/**
	 * Test registering of the autoloader class.
	 *
	 * @since 3.1
	 *
	 * @see Autoloader::register();
	 * @test
	 *
	 * @return void
	 */
	public function testRunningAutoloaderClass() {
		self::$instance->register();
		self::$instance->__destruct();
		// TODO: Write a more precise test.
		$this->assertTrue( true );
	}

	/**
	 * Test adding namespace
	 *
	 * @since 3.1
	 *
	 * @see Autoloader::addNamespace();
	 * @test
	 *
	 * @return void
	 */
	public function testAddingNamespace() {
		$expectedNamespaceArray[] = [
			'root'    => rtrim( ltrim( __NAMESPACE__, '\\' ), '\\' ) . '\\',
			'baseDir' => rtrim( __DIR__, '/' ) . '/',
			'prefix'  => '',
			'suffix'  => '.php'
		];

		$this->assertIsObject( self::$instance->addNamespace( __NAMESPACE__, __DIR__ ) );
		$this->assertEquals( $expectedNamespaceArray, self::$instance->getNamespaces() );
	}

	/**
	 * Test class does not belong to the current namespace
	 *
	 * @since 3.1
	 *
	 * @see Autoloader::autoload();
	 * @test
	 *
	 * @return void
	 */
	public function testClassDoesNotBelongToCurrentNamespace() {
		self::$instance->addNamespace( __NAMESPACE__, __DIR__ );
		self::$instance->autoload( \WP_UnitTestCase::class );
		// TODO: Write a more precise test.
		$this->assertTrue( true );
	}
}
