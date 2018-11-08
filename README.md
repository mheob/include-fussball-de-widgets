# Include Fussball.de Widgets

Easy integration of the fussball.de widgets (currently in the version since season 2016) for Wordpress.

[![WordPress plugin](https://img.shields.io/wordpress/plugin/v/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![WordPress](https://img.shields.io/wordpress/v/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![Wordpress Plugin Downloads](https://img.shields.io/wordpress/plugin/dt/include-fussball-de-widgets.svg)](https://wordpress.org/plugins/include-fussball-de-widgets)

## Installation

1. Install the Fussball.de Widget either via the WordPress.org plugin directory, or by uploading the files to your server.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Use Shortcode like `[fubade id="{DIV-ID}" api="{32-digit API}" notice="{description}"]`<br>
   e.g. `[fubade id="standingsU19" api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19"]`.

## How to use

### What is the `id` as `{DIV-ID}`?

If there is more than one widget on a single page, the respective DIV container must be distinguished. This is done through this value.

**The ID is optional and can be omitted.**

### What is the `api` as `{32-digit API}`?

Here the 32-digit ID must be entered from the official Fußball.de-Widget.

**The API is required.**

### What is the `notice` as `{description}`?

The description can be entered according to your own wishes.
**The NOTICE is optional and can be omitted.**

### Where can I get the official ID?

You can get the required ID when you are at fussball.de at your widgets (<https://www.fussball.de/account.admin.widgets>). There you go to the corresponding widget to `Code anzeigen`.

You find there a code looking similar to this, at the near of the end:

```html
<div id="widget1"></div>
<script type="text/javascript">
    new fussballdeWidgetAPI().showWidget('widget1', '020EXXXXXG000000VS54XXXXXSGIXXME');
</script>
```

The long (32-digit) number and letter mix at the end is the ID to be used.

## Changelog

### 1.6.1

- [Add] if the ID is numeric only a string will added in front

### 1.6

- [Fix] clean up the ID in the shortcode by using only chars, digits and underscores
- [Fix] typo on the loading text

### 1.5.5

- [Fix] some minor code reformations
- [Check] tested up to wordpress version 4.9.4

### 1.5.4

- [Check] tested up to wordpress version 4.9.2

### 1.5.3

- [Check] tested up to wordpress version 4.9

### 1.5.2

- [Check] tested up to wordpress version 4.8.3

### 1.5.1

- [Fix] uncaught ReferenceError: fubade is not defined

### 1.5

- [Add] from now on several widgets on a page are possible
- [Add] FAQ with much more accurate descriptions updated

### 1.4

- [Fix] wrong sequence in the layout of the scripts

### 1.3

- [Fix] I18N

### 1.2

- [Fix] I18N

### 1.1

- [Fix] I18N

### 1.0

- Initial release
