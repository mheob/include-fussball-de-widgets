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

use ITSB\IFDW\Widgets\Widgets;

/**
 * Class WidgetsTest
 *
 * @since 3.1
 */
final class WidgetsTest extends \WP_UnitTestCase {
	/**
	 * The instance.
	 *
	 * @since 3.1
	 * @var Widgets
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
		self::$instance = new Widgets();
	}

	/**
	 * Tests adding the `action` is set.
	 *
	 * @since 3.1
	 *
	 * @see Widgets::action();
	 * @test
	 *
	 * @return void
	 */
	public function testRegisterWidgetActionIsSet(): void {
		// TODO: Integrate Test.
		self::$instance->action();
		$this->assertTrue( true );
	}
}
