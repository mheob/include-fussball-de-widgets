# Include Fussball.de Widgets

Jump to the [german](#deutsch) version.

[![WordPress plugin](https://img.shields.io/wordpress/plugin/v/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![WordPress](https://img.shields.io/wordpress/plugin/tested/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![Wordpress Plugin Downloads](https://img.shields.io/wordpress/plugin/dt/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![Wordpress Plugin Installs](https://img.shields.io/wordpress/plugin/installs/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![PayPal donate button](https://img.shields.io/badge/donate-paypal-blue.svg?style=flat-square)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H6AM3N8GGMTQS&source=url)

## English

Jump to the [german](#deutsch) version.

A WordPress plugin for easy integration of [fussball.de widgets](http://training-service.fussball.de/vereinsmitarbeiter/pressesprecherin/artikel/?tx_meinfussball_pi1[meinfussball]=1911&cHash=8e54ad110b258ac9679d70637b4ff796#!/).

## Installation

1. Install the Fussball.de Widget either via the WordPress.org plugin directory, or by uploading the files to your server.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. You can use the plugin in several ways. As a shortcode, WordPress widget and since WordPress version 5 also as an integrated Gutenberg block.
   1. In wordpress versions below 5 use the shortcode like:
      `[fubade api="{32-digit API}" notice="{description}" fullwidth={iframe in fullwidth} devtools={print devtools}]`\
      e.g. `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullwidth=true devtools=false]`
   1. In versions since 5.0, you can use the Gutenberg block. You can find it under the widgets or with the search pattern `fubade`.
   1. Even the usual WordPress widgets are possible.

## How to use

### How should I write the shortcode?

> `[fubade api="{32-digit API}" notice="{description}" fullwidth={iframe in fullwidth} devtools={print devtools}]`\
> e.g. like:\
> `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullwidth=true devtools=false]`

### What is the `api` as `{32-digit API}`?

> Here the 32-digit ID must be entered from the official Fußball.de-Widget.\
> **The API is required.**

### What is the `notice` as `{description}`?

> The description can be entered according to your own wishes.\
> **The NOTICE is optional and can be omitted.**

### What is the `fullwidth` as `{iframe in fullwidth}`?

> The IFRAME WIDTH can be set to the full width of 100% to the parent element.\
> As values are only `true` or `1` possible.\
> The default value ist `false` or rather `0`.\
> **The IFRAME WIDTH is optional and can be omitted.**

### What is the `devtools` as `{print devtools}`?

> The PRINT DEVTOOLS can help the creator to get debugging information.\
> As values are only `true` or `1` possible.\
> The default value ist `false` or rather `0`.\
> **The PRINT DEVTOOLS is optional and can be omitted.**

### Where can I get the official ID?

> You can get the required ID when you are at fussball.de at your widgets (<https://www.fussball.de/account.admin.widgets>). In the overview of your widget you find the point `Website-Schlüssel`. This is the needed string.

### What can I do if the plugin does not work?

> The first clue should always be the [official support forum at wordpress.org](https://wordpress.org/support/plugin/include-fussball-de-widgets) or the [Issues section on Github](https://github.com/ITS-Boehm/include-fussball-de-widgets/issues).\
> \
> Likewise and often the wrong quotes are used. It is essential to use the normal `"` sign.\
> \
> The curly braces from my examples above should only show placeholders. These are also included, which is not correct.

Jump to the [english](#english) version.

## Deutsch

Jump to the [english](#english) version.

Ein WordPress-Plugin für die einfache Integration der [fussball.de Widgets](http://training-service.fussball.de/vereinsmitarbeiter/pressesprecherin/artikel/?tx_meinfussball_pi1[meinfussball]=1911&cHash=8e54ad110b258ac9679d70637b4ff796#!/).

## Installation

1. Installiere das Fussball.de Widget entweder über das WordPress.org-Plugin-Verzeichnis oder indem Du die Dateien auf Deinen Server hochlädst.
1. Aktiviere das Plugin über das 'Plugins'-Menü in WordPress.
1. Du kannst das Plugin auf mehrere Arten verwenden. Als Shortcode, WordPress Widget und seit der WordPress-Version 5 auch als integrierter Gutenberg-Block.
   1. Verwende in den WordPress-Versionen unter 5 den folgenden Shortcode:
      `[fubade api="{32-digit API}" notice="{Hinweis}" fullwidth={iframe in voller Breite} devtools={Ausgabe der DevTools}]`\
      z.B. `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullwidth=true devtools=false]`
   1. In den Versionen seit 5.0 kannst Du den Gutenberg-Block verwenden. Du findest es unter den Widgets oder mit dem Suchmuster `fubade`.
   1. Auch die gewohnten WordPress widgets sind möglich.

## Wie benutzt Du das Plugin?

### Wie soll ich den Shortcode schreiben?

> `[fubade api="{32-digit API}" notice="{Hinweis}" fullwidth={iframe in voller Breite} devtools={Ausgabe der DevTools}]`\
> also z.B. so:\
> `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullwidth=true devtools=false]`

### Was ist die `api` als `{32-stellige API}`?

> Hier muss die 32-stellige ID (der Website-Schlüssel) aus dem offiziellen Fußball.de-Widget eingegeben werden.\
> **Die API ist erforderlich.**

### Was ist der `notice` als `{Hinweis}`?

> Die Beschreibung kann nach eigenen Wünschen eingegeben werden.\
> **HINWEIS ist optional und kann weggelassen werden.**

### Was ist die `fullwidth` als `{iframe in voller Breite}`?

> Die IFRAME IN VOLLER BREITE kann für das übergeordnete Element auf die volle Breite von 100% eingestellt werden.\
> Als Werte sind nur `true` oder `1` möglich.\
> Der Standardwert ist `false` bzw. `0`.\
> **IFRAME IN VOLLER BREITE ist optional und kann weggelassen werden.**

### Was ist das `devtools` als `{Ausgabe der DevTools}`?

> Die PRINT DEVTOOLS können dem Ersteller helfen, Debugging-Informationen abzurufen.\
> Als Werte sind nur `true` oder `1` möglich.\
> Der Standardwert ist `false` bzw. `0`.\
> **AUSGABE DER DEVTOOLS ist optional und kann weggelassen werden.**

### Wo kann ich den Website-Schlüssel bekommen?

> Den erforderlichen Ausweis erhältst Du bei fussball.de in Deinen Widgets (<https://www.fussball.de/account.admin.widgets>). In der Übersicht Deines Widgets findest Du den Punkt `Website-Schlüssel`. Dies ist die benötigte Zeichenfolge.

### Was kann ich machen wenn das Plugin nicht funktioniert?

> Der erste Anhaltspunkt sollte immer das [offizielle Support-Forum auf wordpress.org](https://wordpress.org/support/plugin/include-fussball-de-widgets) oder auch der [Problembereich auf Github](https://github.com/ITS-Boehm/include-fussball-de-widgets/issues) sein.\
> \
> Gerne und oft werden auch die falschen Anführungszeichen verwendet. Hier muss unbedingt das normale `"`-Zeichen verwendet werden.\
> \
> Die geschweiften Klammern aus meinen Beispielen weiter oben sollen nur Platzhalter anzeigen. Auch diese werden gerne mal mit eingefügt, was nicht korrekt ist.
