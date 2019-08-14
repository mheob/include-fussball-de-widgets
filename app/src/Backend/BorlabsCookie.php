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

namespace IFDW\Backend;

defined( 'ABSPATH' ) || exit();

/**
 * Class BorlabsCookie
 * Functions to add "Borlabs-Cookie" support.
 *
 * @since 3.0.0
 */
class BorlabsCookie {
  private static $instance = null;

  /**
   * BorlabsCookie constructor.
   *
   * @since 3.0.0
   */
  private function __construct() {
    add_action( 'admin_init', [ $this, 'createContentBlocker' ] );
  }

  /**
   * Get the instance.
   *
   * @return BorlabsCookie
   * @since 3.0.0
   */
  public static function getInstance() {
    if ( null === self::$instance ) {
      self::$instance = new BorlabsCookie();
    }

    return self::$instance;
  }

  /**
   * Check if the Borlabs Cookie plugin is installed and active.
   *
   * @since 3.0.0
   */
  function createContentBlocker() {
    if ( ! is_plugin_active( 'borlabs-cookie/BorlabsCookie.php' ) ) {
      return null;
    }

    /* Setup variables */
    $cbHtml = '<div class="_brlbs-content-blocker">
	<div class="_brlbs-embed brlbs-ifdw">
		<img class="_brlbs-thumbnail" src="' . plugins_url( 'assets/images/cb-fubade.png', IFDW_URL ) . '" alt="%%name%%">
		<div class="_brlbs-caption">
			<p>
			  ' . __( 'By loading the widget, you agree to the privacy policy of fussball.de.', 'include-fussball-de-Widgets' ) . '<br>
			  <a href="%%privacy_policy_url%%" target="_blank" rel="nofollow">' . __( 'Learn more', 'include-fussball-de-Widgets' ) . '</a>
			</p>
			<p>
  			<a class="_brlbs-btn" href="#" data-borlabs-cookie-unblock role="button">
  			  ' . __( 'Load widget', 'include-fussball-de-Widgets' ) . '
	  		</a>
			</p>
			<p>
			  <label>
			    <input type="checkbox" name="unblockAll" value="1" checked> 
			    <small>' . __( 'Always load fussball.de Widgets', 'include-fussball-de-Widgets' ) . '</small>
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

    BorlabsCookieHelper()->addContentBlocker( 'fubade',
                                              __( 'Fussball.de Widget', 'include-fussball-de-Widgets' ),
                                              '',
                                              'http://www.fussball.de/privacy/',
                                              [ 'fussball.de', 'www.fussball.de' ],
                                              $cbHtml,
                                              $cbCss,
                                              '',
                                              '',
                                              [],
                                              false,
                                              false );
  }
}
