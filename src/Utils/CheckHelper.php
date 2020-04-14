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

namespace ITSB\IFDW\Utils;

/**
 * The `CheckHelper` class hold some global checks.
 *
 * Global test methods are defined here. These should help to make the right
 * decisions in the right moments.
 *
 * @since 3.1
 */
final class CheckHelper {
	/**
	 * The minimum PHP version.
	 *
	 * @since 3.1
	 * @var string
	 */
	private static $phpVersion;

	/**
	 * Checks the needed PHP version is used.
	 *
	 * @since 3.1
	 * @param string $phpVersion The minimum PHP version.
	 * @return boolean True, if the minimum PHP version is used; otherwise false
	 */
	public static function comparePhpVersion( string $phpVersion ): bool {
		self::$phpVersion = $phpVersion;

		if ( version_compare( phpversion(), self::$phpVersion, '>=' ) ) {
			return true;
		}

		add_action( 'admin_notices', 'self::createNotice' );
		return false;
	}

	/**
	 * The callback creates the admin notice if the PHP version is not compatible.
	 *
	 * @since 3.1
	 * @return void
	 */
	public static function createNotice() {
		echo '<div class="notice notice-error"><p>';
		printf( // translators: %s: The required PHP version.
			esc_html__(
				'Include Fussball.de Widgets requires PHP %s or higher.',
				'include-fussball-de-widgets'
			),
			esc_html( self::$phpVersion )
		);
		echo '</p></div>';
	}
}
