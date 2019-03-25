# Include Fussball.de Widgets

Easy integration of the fussball.de widgets (currently in the version since season 2016) for Wordpress.

[![WordPress plugin](https://img.shields.io/wordpress/plugin/v/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![WordPress](https://img.shields.io/wordpress/v/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![Wordpress Plugin Downloads](https://img.shields.io/wordpress/plugin/dt/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![Wordpress Plugin Installs](https://img.shields.io/wordpress/plugin/installs/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)

## Installation

1. Install the Fussball.de Widget either via the WordPress.org plugin directory, or by uploading the files to your server.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. You can use the plugin in two ways. As a shortcode and from version 5 also as an integrated Gutenberg Block.
   1. In versions below 5.0 use the shortcode like:  
      `[fubade api="{32-digit API}" notice="{description}" fullwidth={iframe width}]`
      e.g. `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullwidth=true]`
   1. In versions since 5.0, you can use the Gutenberg block. You can find it under the widgets or with the search pattern `/fubade`.

## How to use

### How should I write the shortcode?

`[fubade api="{32-digit API}" notice="{description}" fullwidth={iframe width}]`
e.g. `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullwidth=true]`

### What is the `api` as `{32-digit API}`?

Here the 32-digit ID must be entered from the official Fußball.de-Widget.

**The API is required.**

### What is the `notice` as `{description}`?

The description can be entered according to your own wishes.
**The NOTICE is optional and can be omitted.**

### What is the `fullwidth` as `{iframe width}`?

The IFRAME WIDTH can be set to the full width of 100% to the parent element.
As values are only `true` or `1` possible.
**The IFRAME WIDTH is optional and can be omitted.**

### Where can I get the official ID?

You can get the required ID when you are at fussball.de at your widgets (<https://www.fussball.de/account.admin.widgets>). There you go to the corresponding widget to `Code anzeigen`.

You find there a code looking similar to this, at the near of the end:

```html
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
