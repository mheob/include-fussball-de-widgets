=== Include Fussball.de Widgets ===
Contributors: mheob
Tags: fussball.de, fussball, gutenberg, widget
Donate link: https://www.paypal.me/mheob
Requires at least: 4.8
Tested up to: 6.6
Requires PHP: 7.4
Stable tag: 4.0.0
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin for easy integration of fussball.de widgets.

== Description ==

A WordPress plugin for the easy integration of the [fussball.de widgets](https://training-service.fussball.de/vereinsmitarbeiter/pressesprecherin/artikel/?tx_meinfussball_pi1%5Bmeinfussball%5D=1911#!/).

Integrate the fussball.de widgets with the help of one of the three helpers

- the classic [shortcode](https://developer.wordpress.org/plugins/shortcodes/),
- as [WordPress widget](https://wordpress.org/documentation/article/manage-wordpress-widgets/),
- or as [Gutenberg Block](https://wordpress.org/documentation/article/block-based-widgets-editor/).

All three variants are supported. For the "old" widgets from [fussball.de](https://fussball.de) and the new type from [next.fussball.de](https://next.fussball.de). The integration process is almost identical for both types.

== Installation ==

1. Install the Fussball.de widget either via the WordPress.org plugin directory or by uploading the files to your server.
1. Activate the plugin via the 'Plugins' menu in WordPress.
1. You can use the plugin in several ways. As a shortcode, WordPress widget and also as an integrated Gutenberg block.
   1. Use the following shortcode
      1. For the old version: `[fubade api="{32-digit API}" notice="{Note}" fullWidth={iframe in full width} devtools={output of DevTools}]` e.g. `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullWidth=true devtools=false]`
      1. For the new variant: `[fubade api="{36-digit data-id}" type="{data-type}" notice="{note}" fullWidth={iframe in full width} devtools={output of DevTools}]` e.g. `[fubade api="299e1496-abcd-abcd-1234-8880c7270477" notice="Standings U19" fullWidth=true devtools=false]`
   1. Use the Gutenberg block with the search pattern `/fubade`.
   1. The usual WordPress widgets are also possible.

== Frequently Asked Questions ==


= Where can I get the website key (old version) =

You can get the required key from fussball.de in your widgets (<https://www.fussball.de/account.admin.widgets>). In the overview of your widget you will find the item `Website key`. This is the required character string.

= Where do I get the necessary information (new variant) =

You can obtain the required data from next.fussball.de in your widgets (<https://next.fussball.de/widgets>). There you click on the button "to widget". Then click on "Show code" in the left column. The lower code block contains the necessary information. For example like this:

`
<div
  class="soccer_widget"
  data-id="299e1496-abcd-abcd-1234-8880c7270477"
	data-type="table"
/>
`

= How should I write the shortcode (old variant) =

`[fubade api="{32-digit API}" notice="{Note}" fullWidth={iframe in full width} devtools={output of the DevTools}]` e.g. like this: `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullWidth=true devtools=false]`
The fields `notice`, `fullWidth` and `devtools` are optional and do not have to be set.

= How should I write the shortcode (new variant) =

`[fubade api="{36-digit data-id}" type="{data-type}" notice="{notice}" fullWidth={iframe in full width} devtools={output of the DevTools}]` e.g.`[fubade api="299e1496-abcd-abcd-1234-8880c7270477" notice="Standings U19" fullWidth=true devtools=false]`
The fields `notice`, `fullWidth` and `devtools` are optional and do not have to be set.

= What is the `api` (old: `{32-digit API}`) =

The 32-digit ID (the website key) from the official Fußball.de widget must be entered here.
**The API is required.**

= What is the `api` (new: `{36-digit data-id}`) =

The 36-digit ID (found as `data-id`) from the official Fußball.de widget must be entered here.
**The API is required.**

= What is the `type` (only new: `{data-type}`) =

The 36-digit ID (found as `data-id`) from the official Fußball.de widget must be entered here.
**The TYPE is only available for the new widget. It is required there.**

= What is `classes` as space-separated `{CSS classes}`? =

You can add your own CSS classes to each widget to design it manually. For example, a fixed height or something similar can be set.
**The CSS CLASSES are optional and can be omitted.**

= What is the `notice` as `{note}`? =

The description can be entered according to your own wishes.
**NOTE is optional and can be omitted.**

= What is the `fullWidth` as `{iframe in full width}` =

The IFRAME IN FULL WIDTH can be set to the full width of 100% for the parent element.
Only `true` or `1` are possible as values.
The default value is `false` or `0`.
**IFRAME IN FULL WIDTH is optional and can be omitted.**

= What is the `devtools` as `{output of the DevTools}`? =

The PRINT DEVTOOLS can help the creator to retrieve debugging information.
Only `true` or `1` are possible as values.
The default value is `false` or `0`.
**DEVTOOLS output is optional and can be omitted.**

= What can I do if the plugin does not work =

The first point of reference should always be the [official support forum on wordpress.org](https://wordpress.org/support/plugin/include-fussball-de-widgets) or also the [problem area on GitHub](https://github.com/mheob/include-fussball-de-widgets/issues).

The wrong quotation marks are also often used. The normal `"` character must be used here.

The curly brackets from my examples above should only indicate placeholders. These are also often inserted with which is not correct.

= How can I participate in the development? =

The latest state of development is available at any time in my [GitHub repository](https://github.com/mheob/include-fussball-de-widgets/). Look around there.

== Screenshots ==

1. screenshot-1.png

== Changelog ==

= 4.0.0 - 2024-07-23 =
= Added =
* use new fussball.de API
= Changed =
* remove BorlabsCookie integration (BREAKING CHANGE!)
* increase the minimum required PHP version to 7.4 (BREAKING CHANGE!)
* update all dependencies
= Refactored =
* reorganize the whole code structure

= 3.7.0 - 2022-02-08 =
= Added =
* Add Elementor Toggle exception for loading inside tabs.

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
* Call the `idn_to_ascii` function without parameter to fix an issue on Mitwald server.

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
* Loading issue when generating the widget via the Gutenberg blocks.

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
* Fix a bug in the IE11, when the fullWidth was not set.

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

* use new fussball.de API and remove BorlabsCookie integration (BREAKING CHANGE!)
