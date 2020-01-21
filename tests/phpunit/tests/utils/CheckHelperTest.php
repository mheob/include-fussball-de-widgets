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

use ITSB\IFDW\Utils\CheckHelper;
use ITSB\IFDW\Utils\Settings;

/**
 * Class CheckHelperTest
 *
 * @since 3.1
 */
final class CheckHelperTest extends \WP_UnitTestCase {
	/**
	 * Tests the `CheckHelper` returns true.
	 *
	 * @since 3.1
	 *
	 * @see CheckHelper::comparePhpVersion();
	 * @test
	 *
	 * @return void
	 */
	public function testTheCheckHelperReturnsTrue() {
		$this->assertTrue( CheckHelper::comparePhpVersion( Settings::MIN_PHP ) );
	}

	/**
	 * Tests the `CheckHelper` returns false.
	 *
	 * @since 3.1
	 *
	 * @see CheckHelper::comparePhpVersion();
	 * @test
	 *
	 * @return void
	 */
	public function testTheCheckHelperReturnsFalse() {
		$this->assertFalse( CheckHelper::comparePhpVersion( '9.9.9' ) );
	}

	/**
	 * Test the `createNotice` method contains specific string.
	 *
	 * @since 3.1
	 *
	 * @see Host::cleanHost();
	 * @test
	 *
	 * @return void
	 */
	public function testCreateNoticeContainsSpecificString() {
		$expected = '<div class="notice notice-error"><p>' .
			'Include Fussball.de Widgets requires PHP 9.9.9 or higher.' .
			'</p></div>';
		$this->expectOutputString( $expected );
		CheckHelper::createNotice();
	}
}
