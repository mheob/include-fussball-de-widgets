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

namespace ITSB\IFDW\Backend;

use ITSB\IFDW\Infrastructure\ActionBase;
use ITSB\IFDW\Utils\Settings;

/**
 * Class BorlabsCookie provides functions to add
 * "Borlabs-Cookie" (https://borlabs.io) support.
 *
 * @since 3.0
 */
class BorlabsCookie extends ActionBase {
	const CB_ID = 'fubade';

	/**
	 * The table cookies.
	 *
	 * @var string
	 */
	private $tableNameCookies;

	/**
	 * The table cookieGroups.
	 *
	 * @var string
	 */
	private $tableNameCookieGroups;

	/**
	 * Create the fubade content-blocker, if not exists already.
	 *
	 * @since 3.0
	 * @return void
	 */
	public function action(): void {
		if ( ! is_plugin_active( 'borlabs-cookie/borlabs-cookie.php' )
				|| BorlabsCookieHelper()->getContentBlockerData( self::CB_ID ) ) {
			return;
		}

		global $wpdb;

		$this->tableNameCookies      = $wpdb->base_prefix . 'borlabs_cookie_cookies';
		$this->tableNameCookieGroups = $wpdb->base_prefix . 'borlabs_cookie_groups';

		if ( ! $this->checkFubadeCookieExists() ) {
			$this->addCookie();
		}

		/* Setup variables */
		$cbHtml = '<div class="_brlbs-content-blocker">
	<div class="_brlbs-embed brlbs-ifdw">
		<img class="_brlbs-thumbnail" src="' .
			plugins_url( 'assets/images/cb-fubade.png', Settings::URL ) . '" alt="%%name%%">
		<div class="_brlbs-caption">
			<p>
				' . __(
				'By loading the widget, you agree to the privacy policy of fussball.de.',
				'include-fussball-de-widgets'
			) . '<br>
				<a href="%%privacy_policy_url%%" target="_blank" rel="nofollow">' .
					__( 'Learn more', 'include-fussball-de-widgets' ) . '</a>
			</p>
			<p>
			<a class="_brlbs-btn" href="#" data-borlabs-cookie-unblock role="button">
					' . __( 'Load widget', 'include-fussball-de-widgets' ) . '
				</a>
			</p>
			<p>
				<label>
					<input type="checkbox" name="unblockAll" value="1" checked>
					<small>' . __( 'Always load fussball.de Widgets', 'include-fussball-de-widgets' ) . '</small>
				</label>
			</p>
		</div>
	</div>
</div>';

		$cbCss = '.BorlabsCookie ._brlbs-content-blocker .brlbs-ifdw ._brlbs-caption a {
	color: #aaa;
}

.BorlabsCookie ._brlbs-content-blocker .brlbs-ifdw ._brlbs-caption a._brlbs-btn {
	background: #0000a8;
	color: #fff;
	border-radius: 50px;
}

.BorlabsCookie ._brlbs-content-blocker .brlbs-ifdw ._brlbs-caption a._brlbs-btn:hover {
	background: #fff;
	color: #0000a8;
}';

		BorlabsCookieHelper()->addContentBlocker(
			self::CB_ID,
			__( 'Fussball.de Widget', 'include-fussball-de-widgets' ),
			'',
			'http://www.fussball.de/privacy/',
			[ 'fussball.de', 'www.fussball.de' ],
			$cbHtml,
			$cbCss,
			'',
			'',
			[],
			false,
			false
		);
	}

	/**
	 * Check if the `fubade` exists.
	 *
	 * @since 3.0
	 * @return bool If the fubade cookie exists it is true, otherwise false.
	 */
	private function checkFubadeCookieExists(): bool {
		global $wpdb;

		// FIXME: use correct database caching.
    // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery
    // phpcs:disable WordPress.DB.DirectDatabaseQuery.NoCaching
		$cookieId = $wpdb->get_var(
			$wpdb->prepare(
				'SELECT `cookie_id`
        FROM `%s`
        WHERE `cookie_id` = %s
        LIMIT 1',
				$this->tableNameCookies,
				self::CB_ID
			)
		);
    // phpcs:enable

		if ( $cookieId > 0 ) {
			return true;
		}

		return false;
	}

	/**
	 * Add the fubade cookie, if not exists already.
	 *
	 * @since 3.0
	 * @return void
	 */
	private function addCookie(): void {
		global $wpdb;

		$defaultBlogLanguage = substr( get_option( 'WPLANG', 'en_US' ), 0, 2 ) ?? 'en';
		$cookieGroupIds      = [];

		// FIXME: use correct database caching.
    // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery
    // phpcs:disable WordPress.DB.DirectDatabaseQuery.NoCaching
		$cookieGroups = $wpdb->get_results(
			'SELECT `id`, `group_id`
      FROM `%s`
      WHERE `language` = "' . esc_sql( $defaultBlogLanguage ) . '"',
			$this->tableNameCookieGroups
		);
    // phpcs:enable

		foreach ( $cookieGroups as $groupData ) {
			$cookieGroupIds[ $groupData->group_id ] = $groupData->id;
		}

		$sqlQuery = 'INSERT INTO `' . $this->tableNameCookies . '`
        (
          `cookie_id`,
          `language`,
          `cookie_group_id`,
          `service`,
          `name`,
          `provider`,
          `purpose`,
          `privacy_policy_url`,
          `hosts`,
          `cookie_name`,
          `cookie_expiry`,
          `opt_in_js`,
          `position`,
          `status`,
          `undeletable`
        )
        VALUES
        (
					\'' . self::CB_ID . '\',
					\'' . esc_sql( $defaultBlogLanguage ) . '\',
					\'' . esc_sql( $cookieGroupIds['external - media'] ) . '\',
					\'Custom\',
					\'Fußball.de\',
					\'Fußball.de\',
					\'' . _x(
						'Used to unblock fußball.de content.',
						'Cookie - default Entry Fußball.de',
						'include-fussball-de-widgets'
					) . '\',
					\'' . _x(
						'http://www.fussball.de/privacy/',
						'Cookie - Default Entry Fußball.de',
						'include-fussball-de-widgets'
					) . '\',
          \'' . esc_sql( [ 'fussball.de', 'www.fussball.de' ] ) . '\',
					\'' . self::CB_ID . '\',
					\'' . _x( 'Unlimited', 'Cookie - Default Entry Fußball.de', 'include-fussball-de-widgets' ) . '\',
          \'' . esc_sql(
						'<script>
							if("object" === typeof window.BorlabsCookie) {
								window.BorlabsCookie.unblockContentId(\'' . self::CB_ID . '\');
							}
						</script>'
					) . '\',
          82,
          1,
          0
        )
				ON DUPLICATE KEY UPDATE `undeletable` = VALUES(`undeletable`)
        ';

		// FIXME: use correct database caching.
    // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery
    // phpcs:disable WordPress.DB.DirectDatabaseQuery.NoCaching
			$wpdb->query( '%s', $sqlQuery );
    // phpcs:enable
	}
}
