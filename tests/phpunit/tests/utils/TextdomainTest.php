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

require_once __DIR__ . '../../../utils/WP_Hooks.php';

use IFDW\Utils\Textdomain;
use IFDW\PhpUnit\Utils\WP_Hooks;

/**
 * Class TextdomainTest
 *
 * @since 3.1
 */
final class TextdomainTest extends \WP_UnitTestCase {
	/**
	 * The instance.
	 *
	 * @since 3.1
	 * @var Textdomain
	 */
	private static $instance;

	/**
	 * The plugin root.
	 *
	 * @since 3.1
	 * @var string
	 */
	private static $pluginRoot;

	/**
	 * Set up the configuration
	 *
	 * @since 3.1
	 * @return void
	 */
	public function setUp() {
		// Get the instance.
		self::$instance = Textdomain::getInstance();

		// Configure the sample data.
		self::$pluginRoot = plugin_basename( IFDW_URL );
	}

	/**
	 * Tests adding the `plugins_loaded` is set.
	 *
	 * @since 3.1
	 *
	 * @see Textdomain::addPluginsLoadedAction();
	 * @test
	 *
	 * @return void
	 */
	public function testPluginRowMetaFilterIsSet(): void {
		$this->assertFalse( WP_Hooks::hasAction( 'plugins_loaded', self::$instance, 'loadTextdomain' ) );
		self::$instance->addPluginsLoadedAction();
		$this->assertTrue( WP_Hooks::hasAction( 'plugins_loaded', self::$instance, 'loadTextdomain' ) );
	}

	/**
	 * Tests the returning an array, if the plugin path is wrong.
	 *
	 * @since 3.1
	 *
	 * @see Textdomain::loadTextdomain();
	 * @test
	 *
	 * @return void
	 */
	public function testReturnsTheInputArrayWhenPluginPathIsDifferent() : void {
		// TODO: Write the test.
		self::$instance->loadTextdomain();
		$this->assertTrue( true );
	}
}
