=== Include Fussball.de Widgets ===
Contributors: mheob
Donate link: https://www.tsg-irlich.de
Tags: soccer, football, widget, fussball.de
Requires PHP: 5.6
Requires at least: 4.8
Tested up to: 4.9.2
Stable tag: 1.5.3
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Easy integration of the Fussball.de widgets (currently in the version since season 2016).

== Description ==

Easy integration of the Fussball.de widgets (currently in the version since season 2016).

== Installation ==

1. Install the Fussball.de Widget either via the WordPress.org plugin directory, or by uploading the files to your server.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Use Shortcode like `[fubade id="{DIV-ID}" api="{32-digit API}" notice="{description}"]`<br> 
e.g. `[fubade id="standingsU19" api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19"]`.

== Frequently Asked Questions ==

= What is the `id` as `{DIV-ID}`? =

If there is more than one widget on a single page, the respective DIV container must be distinguished. This is done through this value.
**The ID is optional and can be omitted.**

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
	new fussballdeWidgetAPI().showWidget('widget1', '020EXXXXXG000000VS54XXXXXSGIXXME');
</script>
```

The long (32-digit) number and letter mix at the end is the ID to be used.

== Changelog ==

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

= 1.5.3 =

* [Checked] tested up to wordpress version 4.9

== Screenshots ==

1. screenshot-1.jpg
