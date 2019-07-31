<?php
/**
 * Include Fussball.de Widgets
 * Copyright (C) 2018 IT-Service Böhm - Alexander Böhm <ab@its-boehm.de>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Include_Fussball_De_Widgets
 */

/**
 * Functions to add "Borlabs-Cookie" support.
 *
 * @since   2.3.0
 * @package Include_Fussball_De_Widgets
 */

/**
 * Detect if the borlabs-cookie plugin is active.
 */

defined( 'ABSPATH' ) || exit();

if ( ! in_array( 'borlabs-cookie/borlabs-cookie.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
	exit();
}

$content_blocker_html = '<div class="_brlbs-content-blocker">
		<div class="_brlbs-embed _brlbs-twitter">
				<img class="_brlbs-thumbnail" src="%%thumbnail%%" alt="%%name%%">
			<div class="_brlbs-caption">
				<p>' . __( 'By loading the widget, you agree to the privacy policy of fussball.de.', 'include-fussball-de-widgets' ) . '<br><a href="%%privacy_policy_url%%" target="_blank" rel="nofollow">' . __( 'Learn more', 'include-fussball-de-widgets' ) . '</a></p>
				<p><a class="_brlbs-btn" href="#" data-borlabs-cookie-unblock role="button">' . __( 'Load widget', 'include-fussball-de-widgets' ) . '</a></p>
				<p><label><input type="checkbox" name="unblockAll" value="1" checked> <small>' . __( 'Always load fussball.de widgets', 'include-fussball-de-widgets' ) . '</small></label></p>
			</div>
		</div>
	</div>';

/**
 * Add a content blocker.
 *
 * @since 2.3.0
 */
BorlabsCookieHelper()->addContentBlocker(
	'ifdw_fubade',
	__( 'Fussball.de Widget', 'include-fussball-de-widgets' ),
	'',
	'http://www.fussball.de/privacy/',
	[ 'fussball.de' ],
	$content_blocker_html,
	'',
	'',
	'',
	[],
	false,
	false
);
