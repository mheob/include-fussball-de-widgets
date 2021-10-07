=== Include Fussball.de Widgets ===
Contributors: mheob
Tags: soccer, football, fussball, gutenberg, widget, fussball.de
Donate link: https://www.paypal.me/mheob
Requires at least: 4.8
Tested up to: 5.8
Requires PHP: 7.2
Stable tag: 3.6.0
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin for easy integration of fussball.de widgets.

== Description ==
A WordPress plugin for easy integration of [fussball.de widgets](http://training-service.fussball.de/vereinsmitarbeiter/pressesprecherin/artikel/?tx_meinfussball_pi1%5Bmeinfussball%5D=1911&cHash=8e54ad110b258ac9679d70637b4ff796).

== Installation ==
1. Install the Fussball.de Widget either via the WordPress.org plugin directory, or by uploading the files to your server.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. You can use the plugin in several ways. As a shortcode, WordPress widget and since WordPress version 5 also as an integrated Gutenberg block.
   1. In wordpress versions below 5 use the shortcode like:
      `[fubade api="{32-digit API}" notice="{description}" fullwidth={iframe in fullwidth} devtools={print devtools}]`
      e.g. `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullwidth=true devtools=false]`
   1. In versions since 5.0, you can use the Gutenberg block. You can find it under the widgets or with the search pattern `fubade`.
   1. Even the usual WordPress widgets are possible.

== Frequently Asked Questions ==
= How should I write the shortcode? =

`[fubade api="{32-digit API}" notice="{description}" fullwidth={iframe in fullwidth} devtools={print devtools}]`
e.g. like:
`[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullwidth=true devtools=false]`

= What is the `api` as `{32-digit API}`? =

Here the 32-digit ID must be entered from the official Fußball.de-Widget.
**The API is required.**

= What is the `classes` as spaces separated `{CSS classes}` =

Custom CSS classes can be added to each widget to design it manually.
For example, this can be used to set a fixed height or something similar.
**The CLASSES are optional and can be omitted.**

= What is the `notice` as `{description}`? =

The description can be entered according to your own wishes.
**The NOTICE is optional and can be omitted.**

= What is the `fullwidth` as `{iframe in fullwidth}`? =

The IFRAME WIDTH can be set to the full width of 100% to the parent element.
As values are only `true` or `1` possible.
The default value ist `false` or rather `0`.
**The IFRAME WIDTH is optional and can be omitted.**

= What is the `devtools` as `{print devtools}`? =

The PRINT DEVTOOLS can help the creator to get debugging information.
As values are only `true` or `1` possible.
The default value ist `false` or rather `0`.
**The PRINT DEVTOOLS is optional and can be omitted.**

= Where can I get the official ID? =

You can get the required ID when you are at fussball.de at your widgets (<https://www.fussball.de/account.admin.widgets>). In the overview of your widget you find the point `Website-Schlüssel`. This is the needed string.

= What can I do if the plugin does not work? =

The first clue should always be the [official support forum at wordpress.org](https://wordpress.org/support/plugin/include-fussball-de-widgets) or the [Issues section on Github](https://github.com/mheob/include-fussball-de-widgets/issues).

Likewise and often the wrong quotes are used. It is essential to use the normal `"` sign.

The curly braces from my examples above should only show placeholders. These are also included, which is not correct.

= How can I participate in the development? =

The latest state of development is available at any time in my [Github repository](https://github.com/mheob/include-fussball-de-widgets/). Look around there.

= Support of other plugins =

This plugin support Borlabs Cookie since its version 2.0.

== Screenshots ==
1. screenshot-1.jpg

== Changelog ==
= 3.6.0 - 2021-10-05 =
= Added =
* Add the possibility for using custom css classes.
* Add `wp-blocks` class to increase css hierarchy.
* Add Olevmedia Shortcode exception for loading inside tabs.

= 3.5.0 - 2021-02-18 =
= Added =
* Add WPBakery Page Builder exception for loading inside tabs.

= 3.4.0 - 2020-11-02 =
= Added =
* Add Shortcode-Ultimate as the same as Divi-Tabs, Fusion-Tabs and KadenceBlock-Tabs.

= 3.3.5 - 2020-10-14 =
= Fixed =
* Set the server name even 'intl' is not active.

= 3.3.4 - 2020-09-25 =
= Fixed =
* Call the `idn_to_ascii` function without parameter to fix an issue on Mittwald server.

= 3.3.3 - 2020-09-11 =
= Fixed =
* Only show the console log statement, if hte devtools are activated.

= 3.3.2 - 2020-08-21 =
= Fixed =
* Add the correct version number to the readme and plugin files.

= 3.3.1 - 2020-08-21 =
= Fixed =
* Don't check for the correct server port, only whether the server port is set.

= 3.3.0 - 2020-08-06 =
= Added =
* Prevent generation of duplicated ids.

= 3.2.1 - 2020-05-01 =
= Fixed =
* Load the plugin even if the port is not set to 80 or 443 in a localhost environment.
* The error message if if the host is not set is corrected to `$_SERVER["HTTP_HOST"]`.

= 3.2.0 - 2020-04-14 =
= Added =
* Prevent the plugin activation, if the wp or php version is incorrect.
= Fixed =
* The output of the used php version in the logger section is now set correctly.
= Changed =
* The internal documentation is updated.
* Improve the linting in the development files.

= 3.1.3 - 2020-02-16 =
= Fixed =
* The `$_SERVER['SERVER_NAME']` is set to a default value to prevent an error during wp-cli updates.

= 3.1.2 - 2020-01-21 =
= Fixed =
* The Fubade widget (under Design->Widgets).
* The BorlabsCookie integration.

= 3.1.1 - 2020-01-21 =
= Fixed =
* Fix update issues on the wordpress backend.

= 3.1.0 - 2020-01-21 =
= Added =
* Add KadenceBlock-Tabs as the same as Divi-Tabs and Fusion-Tabs.
= Changed =
* Refactor "null ===" to exclamation mark syntax.
* Reformat code, so that the coding standards can be better adhered to and thus a faster development is possible.
* Integrate more test, to prevent possible error.

= 3.0.5 - 2019-10-13 =
= Fixed =
* Due to problems with the WordPress REST API the SourceLogger is deactivated until further notice.

= 3.0.4 - 2019-10-08 =
= Added =
* Error handling during generation of iframe.
* Highlighting of errors by displaying an alert box.
= Fixed =
* IFDW\Utils\Host::cleanHost() must be of the type string, null given.

= 3.0.3 - 2019-09-24 =
= Fixed =
* Loading issue when generating the widget via the gutenberg blocks.

= 3.0.2 - 2019-09-23 =
= Added =
* Add Fusion-Tabs as the same as Divi-Tabs.

= 3.0.1 - 2019-09-19 =
= Fixed =
* Warning: Use of undefined constant INTL_IDNA_VARIANT_UTS46

= 3.0.0 - 2019-09-16 =
= Added =
* A fussball.de widget can be generated in the WordPress widget area (Appearance -> Widgets).
* Tabs from theme Divi-Theme are now supported.
* Borlabs-Cookie support for loading the plugin as an opt-in setting.
* A donation link to cover my expenses a bit.
= Changed =
* [IMPORTANT] Set the required PHP version up to 7.2.
* Redesign the whole structure and use OOP from now on.
* Initialization of the fussball.de iframe from now on in PHP instead of JavaScript.
= Fixed =
* Logging issues have been resolved.

= 2.2.2 - 2019-06-20 =
= Fixed =
* Load the fubade-api in the footer.

= 2.2.1 - 2019-06-09 =
= Fixed =
* The inline styles height and width are removed to prevent complications with the themes.

= 2.2.0 - 2019-06-05 =
= Fixed =
* The widget will now also appear in IE and in the Edge if the domain uses non-ASCII characters (such as ä, ö, ü).
= Added =
* The Plugin is tested up to wordpress version 5.2.
* Preparations for easier debugging.
= Changed =
* Redefined the file structure for using WebPack in the development.
* Using the newest javascript features (ES6) for easier development.
* Cleanup the php code for a better performance.
* Update readme files for better plugin usage instructions.

= 2.1.1 - 2019-03-25 =
= Fixed =
* Fix a bug in the IE11, when the fullwidth was not set.

= 2.1.0 - 2019-03-03 =
= Added =
* Support for setting up the width of the widget to 100% to of their parent element.
= 2.0.3 - 2019-01-27 =
= Fixed =
* Fix an issue, that the Internet Explorer 11 can't load plugin.

= 2.0.2 - 2018-11-28 =
= Added =
* Local language files. For the Gutenberg Block they aren't in GlotPress.

= 2.0.1 - 2018-11-24 =
= Fixed =
* Fix the "Fatal error: Call to undefined function register_block_type()".

= 2.0.0 - 2018-11-24 =
= Added =
* Using as Gutenberg Block.
* The Plugin is tested up to wordpress version 5.0.
= Changed =
* No more input for the ID is needed. It will generate automatically at now.
* Redesign the whole structure.

= 1.6.1 - 2018-03-26 =
= Fixed =
* If the ID is numeric only, a string will added in front.

= 1.6.0 - 2018-03-17 =
= Fixed =
* Clean up the ID in the shortcode by using only chars, digits and underscores. This prevents some possible errors.
* Fix a typo on the loading text.

= 1.5.5 - 2018-02-06 =
= Changed =
* Some minor code reformations for a better performance.
= Added =
* The Plugin is tested up to wordpress version 4.9.4.

= 1.5.4 - 2018-01-17 =
= Added =
* The Plugin is tested up to wordpress version 4.9.2.

= 1.5.3 - 2017-11-13 =
= Added =
* The Plugin is tested up to wordpress version 4.9.

= 1.5.2 - 2017-11-01 =
= Added =
* The Plugin is tested up to wordpress version 4.8.3.

= 1.5.1 - 2017-08-30 =
= Fixed =
* Fix the "uncaught ReferenceError: fubade is not defined".

= 1.5.0 - 2017-08-26 =
= Added =
* From now on several widgets on a page are possible.
= Changed =
* The FAQ are now with much more accurate descriptions.

= 1.4.0 - 2017-08-23 =
= Fixed =
* Fix a wrong sequence in the layout of the scripts.

= 1.3.0 - 2017-08-23 =
= Fixed =
* Fix some typos.

= 1.2.0 - 2017-08-23 =
= Fixed =
* Fix some typos.

= 1.1.0 - 2017-08-23 =
= Fixed =
* Fix some typos.

= 1.0.0 - 2017-08-22 =
* Initial release.

== Upgrade Notice ==
* Add the possibility for using custom css classes.
* Add `wp-blocks` class to increase css hierarchy.
* Add Olevmedia Shortcode exception for loading inside tabs.
