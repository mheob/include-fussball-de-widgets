=== Include Fussball.de Widgets ===
Contributors: mheob
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H6AM3N8GGMTQS
Tags: soccer, football, widget, fussball.de
Requires PHP: 5.6
Requires at least: 4.8
Tested up to: 5.1
Stable tag: 2.0.3
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
      `[fubade api="{32-digit API}" notice="{description}"]`
      e.g. `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19"]`
   1. In versions since 5.0, you can use the Gutenberg block. You can find it under the widgets or with the search pattern `/ fubade`.

== Frequently Asked Questions ==

= What is the `api` as `{32-digit API}`? =

Here the 32-digit ID must be entered from the official Fußball.de-Widget.
**The API is required.**

= What is the `notice` as `{description}`? =

The description can be entered according to your own wishes.
**The NOTICE is optional and can be omitted.**

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

### Obsolet ID

In older versions there was still an ID must be assigned. This is no longer necessary because it is automatically generated.

== Changelog ==

= 2.0.3 =

* [Fix] Internet Explorer 11 can't load plugin

= 2.0.2 =

* [Add] Local language files. For the Gutenberg Block they aren't in GlotPress.

= 2.0.1 =

* [Fix] Fatal error: Call to undefined function register_block_type()

= 2.0.0 (complete redesign) =

* [Add] using as Gutenberg Block
* [Modify] redesign the whole structure
* [Fix] problems with the input of the ID (no more input needed)
* [Check] tested up to wordpress version 5.0

= 1.6.1 =

* [Added]   if the ID is numeric only a string will added in front

= 1.6 =

* [Fixed]   clean up the ID in the shortcode by using only chars, digits and underscores
* [Fixed]   typo on the loading text

= 1.5.5 =

* [Fixed]   some minor code reformations
* [Checked] tested up to wordpress version 4.9.4

= 1.5.4 =

* [Checked] tested up to wordpress version 4.9.2

= 1.5.3 =

* [Checked] tested up to wordpress version 4.9

= 1.5.2 =

* [Checked] tested up to wordpress version 4.8.3

= 1.5.1 =

* [Fixed] uncaught ReferenceError: fubade is not defined

= 1.5 =

* [Added] from now on several widgets on a page are possible
* [Added] FAQ with much more accurate descriptions updated

= 1.4 =

* [Fixed] wrong sequence in the layout of the scripts

= 1.3 =

* [Fixed] I18N

= 1.2 =

* [Fixed] I18N

= 1.1 =

* [Fixed] I18N

= 1.0 =

* Initial release

== Upgrade Notice ==

= 2.0.3 =

- [Fix] Internet Explorer 11 can't load plugin

== Screenshots ==

1. screenshot-1.jpg
