=== Include Fussball.de Widgets ===
Contributors: mheob
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H6AM3N8GGMTQS
Tags: soccer, football, widget, fussball.de
Requires PHP: 5.6
Requires at least: 4.8
Tested up to: 5.1
Stable tag: 2.1.0
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Easy integration of the Fussball.de widgets (currently in the version since season 2016).

== Description ==

Easy integration of the Fussball.de widgets (currently in the version since season 2016).

== Installation ==

1. Install the Fussball.de Widget either via the WordPress.org plugin directory, or by uploading the files to your server.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. You can use the plugin in two ways. As a shortcode and from version 5 also as an integrated Gutenberg Block.
   1. In versions below 5.0 use the shortcode like:
      `[fubade api="{32-digit API}" notice="{description}" fullwidth={iframe width}]`  
      e.g. `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullwidth=true]`
   1. In versions since 5.0, you can use the Gutenberg block. You can find it under the widgets or with the search pattern `/fubade`.

== Frequently Asked Questions ==

= What is the `api` as `{32-digit API}`? =

Here the 32-digit ID must be entered from the official Fußball.de-Widget.
**The API is required.**

= What is the `notice` as `{description}`? =

The description can be entered according to your own wishes.
**The NOTICE is optional and can be omitted.**

= What is the `fullwidth` as `{iframe width}`? =

The IFRAME WIDTH can be set to the full width of 100% to the parent element.
As values are only `true` or `1` possible.
**The IFRAME WIDTH is optional and can be omitted.**

= Where can I get the official ID? =

You can get the required ID when you are at fussball.de at your widgets (<https://www.fussball.de/account.admin.widgets>). There you go to the corresponding widget to `Code anzeigen`.

You find there a code looking similar to this, at the near of the end:
```
<div id="widget1"></div>
<script type="text/javascript">
    new fussballdeWidgetAPI().showWidget(
        "widget1",
        "020EXXXXXG000000VS54XXXXXSGIXXME"
    );
</script>
```

The long (32-digit) number and letter mix at the end is the ID to be used.

= Obsolet ID =

In older versions there was still an ID must be assigned. This is no longer necessary because it is automatically generated.

== Changelog ==

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

= 2.1.0 =

= Added =

* Support for setting up the width of the widget to 100% to of their parent element.

== Screenshots ==

1. screenshot-1.jpg
