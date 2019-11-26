<?php
/**
 * Include Fussball.de Widgets
 * Copyright (C) 2019 IT-Service Böhm - Alexander Böhm <ab@its-boehm.de>
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Include_Fussball_De_Widgets
 */

declare( strict_types=1 );
namespace IFDW\PhpUnit\Tests\Utils;

require_once __DIR__ . '../../../utils/Stub.php';

use IFDW\PhpUnit\Utils\Stub;
use IFDW\Utils\Host;

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

		$stub = new Stub( $this->getMockBuilder( Host::class )->getMock(), Host::class );
		$stub->setProperty( 'host', null );

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

		$stub = new Stub( $this->getMockBuilder( Host::class )->getMock(), Host::class );
		$stub->setProperty( 'host', null );

		$this->assertEquals( $expected, Host::cleanHost( 'example.com' ) );
	}
}
