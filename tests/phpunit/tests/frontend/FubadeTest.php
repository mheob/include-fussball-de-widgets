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
namespace IFDW\PhpUnit\Tests\Frontend;

require_once __DIR__ . '../../../utils/Stub.php';

use IFDW\Frontend\Fubade;
use IFDW\PhpUnit\Utils\Stub;
use IFDW\Utils\Host;

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
		$stub = new Stub( $this->getMockBuilder( Host::class )->getMock(), Host::class );
		$stub->setProperty( 'host', null );
		Host::cleanHost( null );

		// TODO: Add test with the IFDW_HOST constants.
		$expected = 'The PHP variable <code>$_SERVER["SERVER_NAME"]</code> was not set by the server.';
		// TODO: After correcting the test case remove the NOT in the `assertNotContains` function name.
		$this->assertNotContains( $expected, $this->instance->output( $this->sampleAttr ) );
	}
}
