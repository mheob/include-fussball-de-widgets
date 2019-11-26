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

use IFDW\Shortcodes\Fubade;

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
	private static $instance;

	/**
	 * A few sample links.
	 *
	 * @since 3.1
	 * @var array
	 */
	private static $sampleAtts;

	/**
	 * Set up the configuration
	 *
	 * @since 3.1
	 * @return void
	 */
	public function setUp() {
		// Get the instance.
		self::$instance = Fubade::getInstance();

		// Configure the sample data.
		self::$sampleAtts = [
			'api'       => '12345678901234567890123456789012',
			'id'        => 'fubade_12345',
			'notice'    => 'my notice',
			'fullwidth' => true,
			'devtools'  => true
		];
	}

	/**
	 * Tests the `fubade` shortcode is added.
	 *
	 * @since 3.1
	 *
	 * @see Fubade::addShortcode();
	 * @test
	 *
	 * @return void
	 */
	public function testFubadeShortcodeIsAdded(): void {
		remove_shortcode( 'fubade' );
		$this->assertFalse( shortcode_exists( 'fubade' ) );
		self::$instance->addShortcode();
		$this->assertTrue( shortcode_exists( 'fubade' ) );
	}

	/**
	 * Tests the returning of the fubade shortcode output.
	 *
	 * @since 3.1
	 *
	 * @see Fubade::createShortcode();
	 * @test
	 *
	 * @return void
	 */
	public function testReturnsTheFubadeShortcodeOutput() : void {
		// phpcs:disable Generic.Files.LineLength.MaxExceeded
		$expected  = '<div id="fubade_89012" class="include-fussball-de-widgets">' . PHP_EOL;
		$expected .= "<iframe src='//www.fussball.de/widget2/-/schluessel/12345678901234567890123456789012/target/fubade_89012/caller/example.org' width='100%' height='200px' scrolling='no' style='border: 1px solid #CECECE; overflow: hidden'></iframe>" . PHP_EOL;
		$expected .= '</div>' . PHP_EOL;
		// phpcs:enable

		$this->assertEquals( $expected, self::$instance->createShortcode( self::$sampleAtts ) );
	}
}
