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

require_once __DIR__ . '../../../utils/Mock.php';

use ITSB\IFDW\PhpUnit\Utils\Mock;
use ITSB\IFDW\Utils\Host;

/**
 * Class HostTest
 *
 * @since 3.1
 */
final class HostTest extends \WP_UnitTestCase {
	/**
	 * Test that the hostname can not return cleaned.
	 *
	 * @since 3.1
	 *
	 * @see Host::cleanHost();
	 * @test
	 *
	 * @return void
	 */
	public function testCleanHostCanNotSet(): void {
		$expected = 'SERVER_NAME-not-set';

		$mock = new Mock( $this->getMockBuilder( Host::class )->getMock(), Host::class );
		$mock->setProperty( 'host', null );

		$this->assertEquals( $expected, Host::cleanHost( null ) );
		$this->assertEquals( $expected, Host::cleanHost( '' ) );
	}

	/**
	 * Test that the hostname return cleaned.
	 *
	 * @since 3.1
	 *
	 * @see Host::cleanHost();
	 * @test
	 *
	 * @return void
	 */
	public function testCleanHostIsSet(): void {
		$expected = 'example.com';

		$mock = new Mock( $this->getMockBuilder( Host::class )->getMock(), Host::class );
		$mock->setProperty( 'host', null );

		$this->assertEquals( $expected, Host::cleanHost( 'example.com' ) );
	}
}
