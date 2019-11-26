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

namespace ITSB\IFDW\PhpUnit\Tests\Utils\Logging;

use ITSB\IFDW\Utils\Logging\ConsoleLogger;

/**
 * Class ConsoleLoggerTest
 *
 * @since 3.1
 */
final class ConsoleLoggerTest extends \WP_UnitTestCase {
	/**
	 * The instance.
	 *
	 * @since 3.1
	 * @var ConsoleLogger
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
		self::$instance = new ConsoleLogger();
	}

	/**
	 * Test adding the inline script after the `errorLog()` was fired.
	 *
	 * @since 3.1
	 *
	 * @see ConsoleLogger::errorLog();
	 * @test
	 *
	 * @return void
	 */
	public function testAddInlineScriptAfterErrorLogWasFired(): void {
		$exampleData = 'example data';

		self::$instance->errorLog( $exampleData );

		// TODO: Write a more precise test.
		$this->assertTrue( true );
	}

	/**
	 * Test adding the inline script after the `log()` was fired.
	 *
	 * @since 3.1
	 *
	 * @see ConsoleLogger::log();
	 * @test
	 *
	 * @return void
	 */
	public function testAddInlineScriptLogWidgetInfoWasFired(): void {
		$exampleData = [
			'api'       => '123',
			'id'        => 'fubade_12345',
			'notice'    => 'my notice',
			'fullwidth' => true,
			'devtools'  => true
		];

		self::$instance->log( $exampleData );

		// TODO: Write the test.
		$this->assertTrue( true );
	}

	/**
	 * Test cancelling logging, if no id is set when `log()` is fired.
	 *
	 * @since 3.1
	 *
	 * @see ConsoleLogger::log();
	 * @test
	 *
	 * @return void
	 */
	public function testCancelLoggingIfNoIdIsSet(): void {
		$exampleData = [];

		wp_enqueue_script( 'fubade-api' );
		self::$instance->log( $exampleData );

		// TODO: Write a more precise test.
		$this->assertTrue( true );
	}
}
