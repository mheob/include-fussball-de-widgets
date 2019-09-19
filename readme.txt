=== Include Fussball.de Widgets ===
Contributors: mheob
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H6AM3N8GGMTQS&source=url
Tags: soccer, football, widget, fussball.de
Requires PHP: 7.2
Requires at least: 4.8
Tested up to: 5.2
Stable tag: 3.0.1
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin for easy integration of fussball.de widgets.

== Description ==

A WordPress plugin for easy integration of fussball.de widgets.

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

The first clue should always be the [official support forum at wordpress.org](https://wordpress.org/support/plugin/include-fussball-de-widgets) or the [Issues section on Github](https://github.com/ITS-Boehm/include-fussball-de-widgets/issues). 

Likewise and often the wrong quotes are used. It is essential to use the normal `"` sign. 
 
The curly braces from my examples above should only show placeholders. These are also included, which is not correct.

= How can I participate in the development? =

The latest state of development is available at any time in my [Github repository](https://github.com/ITS-Boehm/include-fussball-de-widgets/). Look around there.

== Changelog ==

= 3.0.1 - 2019-09-19 =

= Fix =

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

= [2.0.3] - 2019-01-27 =

= Fixed =

* Fix an issue, that the Internet Explorer 11 can't load plugin.

= [2.0.2] - 2018-11-28 =

= Added =

* Local language files. For the Gutenberg Block they aren't in GlotPress.

= [2.0.1] - 2018-11-24 =

= Fixed =

* Fix the "Fatal error: Call to undefined function register_block_type()".

= [2.0.0] - 2018-11-24 =

= Added =

* Using as Gutenberg Block.
* The Plugin is tested up to wordpress version 5.0.

= Changed =

* No more input for the ID is needed. It will generate automatically at now.
* Redesign the whole structure.

= [1.6.1] - 2018-03-26 =

= Fixed =

* If the ID is numeric only, a string will added in front.

= [1.6.0] - 2018-03-17 =

= Fixed =

* Clean up the ID in the shortcode by using only chars, digits and underscores. This prevents some possible errors.
* Fix a typo on the loading text.

= [1.5.5] - 2018-02-06 =

= Changed =

* Some minor code reformations for a better performance.

= Added =

* The Plugin is tested up to wordpress version 4.9.4.

= [1.5.4] - 2018-01-17 =

= Added =

* The Plugin is tested up to wordpress version 4.9.2.

= [1.5.3] - 2017-11-13 =

= Added =

* The Plugin is tested up to wordpress version 4.9.

= [1.5.2] - 2017-11-01 =

= Added =

* The Plugin is tested up to wordpress version 4.8.3.

= [1.5.1] - 2017-08-30 =

= Fixed =

* Fix the "uncaught ReferenceError: fubade is not defined".

= [1.5.0] - 2017-08-26 =

= Added =

* From now on several widgets on a page are possible.

= Changed =

* The FAQ are now with much more accurate descriptions.

= [1.4.0] - 2017-08-23 =

= Fixed =

* Fix a wrong sequence in the layout of the scripts.

= [1.3.0] - 2017-08-23 =

= Fixed =

* Fix some typos.

= [1.2.0] - 2017-08-23 =

= Fixed =

* Fix some typos.

= [1.1.0] - 2017-08-23 =

= Fixed =

* Fix some typos.

= 1.0.0 - 2017-08-22 =

* Initial release.

== Upgrade Notice ==

= 3.0.1 - 2019-09-19 =

= Fix =

* Warning: Use of undefined constant INTL_IDNA_VARIANT_UTS46

== Screenshots ==

1. screenshot-1.jpg
