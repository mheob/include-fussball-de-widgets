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

require __DIR__ . '../../../utils/WP_Hooks.php';

use IFDW\Utils\PluginActions;
use IFDW\Tests\Utils\WP_Hooks;

/**
 * Class PluginActionsTest
 *
 * @since 3.1
 */
final class PluginActionsTest extends WP_UnitTestCase {
	/**
	 * The instance.
	 *
	 * @since 3.1
	 * @var PluginActions
	 */
	private static $instance;

	/**
	 * A few sample links.
	 *
	 * @since 3.1
	 * @var array
	 */
	private static $sampleLinks;

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
		self::$instance = PluginActions::getInstance();

		// Configure the sample data.
		self::$sampleLinks = [ '<a href="#">FAQ</a>', '<a href="#">Support</a>' ];
		self::$pluginRoot  = plugin_basename( IFDW_URL );
	}

	/**
	 * Tests adding the `plugin_row_meta`is set.
	 *
	 * @since 3.1
	 *
	 * @see PluginActions::addPluginRowMetaFilter();
	 * @test
	 *
	 * @return void
	 */
	public function testPluginRowMetaFilterIsSet(): void {
		$this->assertFalse( WP_Hooks::hasFilter( 'plugin_row_meta', self::$instance, 'addLinksToRowMeta' ) );

		self::$instance->addPluginRowMetaFilter();

		$this->assertTrue( WP_Hooks::hasFilter( 'plugin_row_meta', self::$instance, 'addLinksToRowMeta' ) );
	}

	/**
	 * Tests the returning an array, if the plugin path is wrong.
	 *
	 * @since 3.1
	 *
	 * @see PluginActions::addLinksToRowMeta();
	 * @test
	 *
	 * @return void
	 */
	public function testReturnsTheInputArrayWhenPluginPathIsDifferent() : void {
		$sampleFunctionCall = self::$instance->addLinksToRowMeta( self::$sampleLinks, 'wrong path' );

		$this->assertIsArray( $sampleFunctionCall );
		$this->assertSame( self::$sampleLinks, $sampleFunctionCall );
		$this->assertEquals( 2, count( $sampleFunctionCall ) );
	}

	/**
	 * Tests the returning an array.
	 *
	 * @since 3.1
	 *
	 * @see PluginActions::addLinksToRowMeta();
	 * @test
	 *
	 * @return void
	 */
	public function testReturnsTheUpdatedArrayOfRowMetaLinks(): void {
		$sampleFunctionCall = self::$instance->addLinksToRowMeta( self::$sampleLinks, self::$pluginRoot );

		$this->assertIsArray( $sampleFunctionCall );
		$this->assertEquals( 3, count( $sampleFunctionCall ) );
	}
}
