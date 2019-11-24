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
namespace IFDW\PhpUnit\Tests\Utils\Logging;

use IFDW\Utils\Logging\SourceLogger;

/**
 * Class SourceLoggerTest
 *
 * @since 3.1
 */
final class SourceLoggerTest extends \WP_UnitTestCase {
	/**
	 * The instance.
	 *
	 * @since 3.1
	 * @var SourceLogger
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
		self::$instance = SourceLogger::getInstance();
	}

	/**
	 * Test adding the inline script after the `log()` was fired.
	 *
	 * @since 3.1
	 *
	 * @see SourceLogger::log();
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

		wp_enqueue_script( 'fubade-api' );
		self::$instance->log( $exampleData );

		// TODO: Write the test.
		$this->assertTrue( true );
	}

	/**
	 * Test cancelling logging, if no id is set when `log()` is fired.
	 *
	 * @since 3.1
	 *
	 * @see SourceLogger::log();
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
