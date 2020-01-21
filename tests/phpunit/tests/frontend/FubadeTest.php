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

namespace ITSB\IFDW\PhpUnit\Tests\Frontend;

require_once __DIR__ . '../../../Utils/Mock.php';
require_once __DIR__ . '../../../Utils/TestHelper.php';

use ITSB\IFDW\Frontend\Fubade;
use ITSB\IFDW\PhpUnit\Utils\{Mock, TestHelper};
use ITSB\IFDW\Utils\Settings;

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
	private $instance;

	/**
	 * The attribute array with sample.
	 *
	 * @since 3.1
	 * @var array
	 */
	private $sampleAttr = [
		'api'       => '12346578901234657890123465789012',
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
		$this->instance = new Fubade();
	}

	/**
	 * Tests the render output if the api length is not 32.
	 *
	 * @since 3.1
	 *
	 * @see Fubade::output();
	 * @test
	 *
	 * @return void
	 */
	public function testRenderOutputIfApiLengthIsNot32() {
		$expected          = '!!! The fussball.de API must have a length of exactly 32 characters. !!!';
		$sampleAttr        = $this->sampleAttr;
		$sampleAttr['api'] = '';
		$this->assertContains( $expected, $this->instance->output( $sampleAttr ) );
	}

	/**
	 * Tests the render output if there is a server name error.
	 *
	 * @since 3.1
	 *
	 * @see Fubade::output();
	 * @test
	 *
	 * @return void
	 */
	public function testRenderOutputIfServerNotError() {
		$mock = new Mock( $this->getMockBuilder( Settings::class )->getMock(), Settings::class );
		$mock->setProperty( 'host', 'SERVER_NAME-not-set' );

		$expected = 'The PHP variable <code>$_SERVER["SERVER_NAME"]</code> was not set by the server.';
		$this->assertContains( $expected, $this->instance->output( $this->sampleAttr ) );

		TestHelper::restoreHost();
	}
}
