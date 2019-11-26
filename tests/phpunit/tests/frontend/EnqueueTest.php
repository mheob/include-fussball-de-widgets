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

require_once __DIR__ . '../../../utils/WP_Hooks.php';

use IFDW\Frontend\Enqueue;
use IFDW\PhpUnit\Utils\WP_Hooks;

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
		self::$instance = Enqueue::getInstance();
	}

	/**
	 * Tests adding the `init` is set.
	 *
	 * @since 3.1
	 *
	 * @see Enqueue::addInitAction();
	 * @test
	 *
	 * @return void
	 */
	public function testInitActionIsSet(): void {
		$this->assertFalse( WP_Hooks::hasAction( 'init', self::$instance, 'registerFubadeApi' ) );
		self::$instance->addInitAction();
		$this->assertTrue( WP_Hooks::hasAction( 'init', self::$instance, 'registerFubadeApi' ) );
	}

	/**
	 * Tests `fubade-api` is registered.
	 *
	 * @since 3.1
	 *
	 * @see Enqueue::registerFubadeApi();
	 * @test
	 *
	 * @return void
	 */
	public function testFubadeApiIsRegisterd(): void {
		wp_deregister_script( 'fubade-api' );

		self::$instance->registerFubadeApi();

		// TODO: Write a more precise test.
		$this->assertTrue( true );
	}
}
