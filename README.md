<!-- markdownlint-disable MD024 -->

# Include Fussball.de Widgets

[![WordPress plugin](https://img.shields.io/wordpress/plugin/v/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![WordPress](https://img.shields.io/wordpress/plugin/tested/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![WordPress Plugin Downloads](https://img.shields.io/wordpress/plugin/dt/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![WordPress Plugin Installs](https://img.shields.io/wordpress/plugin/installs/include-fussball-de-widgets.svg?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![WordPress Plugin Rating](https://img.shields.io/wordpress/plugin/rating/include-fussball-de-widgets?style=flat-square)](https://wordpress.org/plugins/include-fussball-de-widgets)
[![Test CI](https://img.shields.io/github/actions/workflow/status/mheob/include-fussball-de-widgets/test.yml?style=flat-square&logo=github&label=Test%20CI)](https://github.com/mheob/include-fussball-de-widgets/actions/workflows/test.yml)

[![GitHub Sponsor](https://img.shields.io/badge/Sponsors-333333.svg?style=flat-square&logo=github&logoColor=white)](https://github.com/sponsors/mheob)
[![PayPal donate button](https://img.shields.io/badge/Paypal-Donate-_.svg?style=flat-square&color=003087&logo=paypal)](https://www.paypal.me/mheob)
[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-ff813f.svg?style=flat-square&logo=buy%20me%20a%20coffee&logoColor=white)](https://www.buymeacoffee.com/mheob)
[![Ko-Fi](https://img.shields.io/badge/Ko--Fi-ffffff?style=flat-square&logo=ko-fi)](https://ko-fi.com/mheob)

## English

Jump to the [german](#deutsch) version.

A WordPress plugin for the easy integration of the
[fussball.de widgets](https://training-service.fussball.de/vereinsmitarbeiter/pressesprecherin/artikel/?tx_meinfussball_pi1%5Bmeinfussball%5D=1911#!/).

Integrate the fussball.de widgets with the help of one of the three helpers

- the classic [shortcode](https://developer.wordpress.org/plugins/shortcodes/),
- as [WordPress widget](https://wordpress.org/documentation/article/manage-wordpress-widgets/),
- or as [Gutenberg Block](https://wordpress.org/documentation/article/block-based-widgets-editor/).

All three variants are supported. For the "old" widgets from [fussball.de](https://fussball.de) and the new type from
[next.fussball.de](https://next.fussball.de). The integration process is almost identical for both types.

## Installation

1. Install the Fussball.de widget either via the WordPress.org plugin directory or by uploading the files to your server.
1. Activate the plugin via the 'Plugins' menu in WordPress.
1. You can use the plugin in several ways. As a shortcode, WordPress widget and also as an integrated Gutenberg block.
   1. Use the following shortcode
      1. For the old version\
         `[fubade api="{32-digit API}" notice="{Note}" fullWidth={iframe in full width} devtools={output of DevTools}]`\
         e.g. `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullWidth=true devtools=false]`
      1. For the new variant\
         `[fubade api="{36-digit data-id}" type="{data-type}" notice="{note}" fullWidth={iframe in full width} devtools={output of DevTools}]`\
         e.g. `[fubade api="299e1496-abcd-abcd-1234-8880c7270477" notice="Standings U19" fullWidth=true devtools=false]`
   1. Use the Gutenberg block with the search pattern `/fubade`.
   1. The usual WordPress widgets are also possible.

## How to use the plugin

### Where can I get the website key (old version)

You can get the required key from fussball.de in your widgets (<https://www.fussball.de/account.admin.widgets>). In the overview
of your widget you will find the item `Website key`. This is the required character string.

### Where do I get the necessary information (new variant)

You can obtain the required data from next.fussball.de in your widgets (<https://next.fussball.de/widgets>). There you click on
the button "to widget". Then click on "Show code" in the left column. The lower code block contains the necessary information. For
example like this:

```html
<div class="soccer_widget" data-id="299e1496-abcd-abcd-1234-8880c7270477" data-type="table" />
```

### How should I write the shortcode (old variant)

`[fubade api="{32-digit API}" notice="{Note}" fullWidth={iframe in full width} devtools={output of the DevTools}]`\
e.g. like this:\
`[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullWidth=true devtools=false]` The fields `notice`,
`fullWidth` and `devtools` are optional and do not have to be set.

### How should I write the shortcode (new variant)

`[fubade api="{36-digit data-id}" type="{data-type}" notice="{notice}" fullWidth={iframe in full width} devtools={output of the DevTools}]`\
e.g.`[fubade api="299e1496-abcd-abcd-1234-8880c7270477" notice="Standings U19" fullWidth=true devtools=false]`
The fields `notice`, `fullWidth` and `devtools` are optional and do not have to be set.

### What is the `api` (old: `{32-digit API}`)

The 32-digit ID (the website key) from the official Fußball.de widget must be entered here. **The API is required.**

### What is the `api` (new: `{36-digit data-id}`)

The 36-digit ID (found as `data-id`) from the official Fußball.de widget must be entered here. **The API is required.**

### What is the `type` (only new: `{data-type}`)

The 36-digit ID (found as `data-id`) from the official Fußball.de widget must be entered here. **The TYPE is only available for
the new widget. It is required there.**

### What is `classes` as space-separated `{CSS classes}`?

You can add your own CSS classes to each widget to design it manually. For example, a fixed height or something similar can be
set.\
**The CSS CLASSES are optional and can be omitted.**

### What is the `notice` as `{note}`?

The description can be entered according to your own wishes.\
**NOTE is optional and can be omitted.**

### What is the `fullWidth` as `{iframe in full width}`

The IFRAME IN FULL WIDTH can be set to the full width of 100% for the parent element.\
Only `true` or `1` are possible as values.\
The default value is `false` or `0`.\
**IFRAME IN FULL WIDTH is optional and can be omitted.**

### What is the `devtools` as `{output of the DevTools}`?

The PRINT DEVTOOLS can help the creator to retrieve debugging information.\
Only `true` or `1` are possible as values.\
The default value is `false` or `0`.\
**DEVTOOLS output is optional and can be omitted.**

### What can I do if the plugin does not work

The first point of reference should always be the
[official support forum on wordpress.org](https://wordpress.org/support/plugin/include-fussball-de-widgets) or also the
[problem area on GitHub](https://github.com/mheob/include-fussball-de-widgets/issues).

The wrong quotation marks are also often used. The normal `"` character must be used here.

The curly brackets from my examples above should only indicate placeholders. These are also often inserted with which is not
correct.

## Deutsch

Jump to the [english](#english) version.

Ein WordPress-Plugin für die einfache Integration der
[fussball.de widgets](https://training-service.fussball.de/vereinsmitarbeiter/pressesprecherin/artikel/?tx_meinfussball_pi1%5Bmeinfussball%5D=1911#!/).

Binde die fussball.de widgets mit der Hilfe von einem der drei Helfern ein

- der klassische [shortcode](https://developer.wordpress.org/plugins/shortcodes/),
- als [WordPress widget](https://wordpress.org/documentation/article/manage-wordpress-widgets/),
- oder als [Gutenberg Block](https://wordpress.org/documentation/article/block-based-widgets-editor/).

Alle drei Varianten werden unterstützt. Und zwar für die "alten" Widgets von [fussball.de](https://fussball.de) und die neue Art
von [next.fussball.de](https://next.fussball.de). Die Einbindung läuft für beide Arten fast komplett identisch ab.

## Installation

1. Installiere das Fussball.de Widget entweder über das WordPress.org-Plugin-Verzeichnis oder indem Du die Dateien auf Deinen
   Server hochlädst.
1. Aktiviere das Plugin über das 'Plugins'-Menü in WordPress.
1. Du kannst das Plugin auf mehrere Arten verwenden. Als Shortcode, WordPress Widget und auch als integrierter Gutenberg-Block.
   1. Verwende folgenden Shortcode
      1. für die alte Variante\
         `[fubade api="{32-digit API}" notice="{Hinweis}" fullWidth={iframe in voller Breite} devtools={Ausgabe der DevTools}]`\
         z.B. `[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullWidth=true devtools=false]`
      1. für die neue Variante\
         `[fubade api="{36-digit data-id}" type="{data-type}" notice="{Hinweis}" fullWidth={iframe in voller Breite} devtools={Ausgabe der DevTools}]`\
         z.B. `[fubade api="299e1496-abcd-abcd-1234-8880c7270477" notice="Standings U19" fullWidth=true devtools=false]`
   1. Verwende den Gutenberg-Block mit dem Suchmuster `/fubade`.
   1. Auch die gewohnten WordPress Widgets sind möglich.

## Wie benutzt Du das Plugin

### Wo kann ich den Website-Schlüssel bekommen (alte Variante)

Den erforderlichen Schlüssel erhältst Du bei fussball.de in Deinen Widgets (<https://www.fussball.de/account.admin.widgets>). In
der Übersicht Deines Widgets findest Du den Punkt `Website-Schlüssel`. Dies ist die benötigte Zeichenfolge.

### Wo bekommen ich die notwendigen Informationen her (neue Variante)

Die erforderlichen Daten erhältst Du bei next.fussball.de in Deinen Widgets (<https://next.fussball.de/widgets>). Dort klickst Du
auf den Button "zum widget". Dann in der linken Spalte auf "code anzeigen". Im unteren Codeblock stehen die notwendigen
Informationen. Zum Beispiel so:

```html
<div class="soccer_widget" data-id="299e1496-abcd-abcd-1234-8880c7270477" data-type="table" />
```

### Wie soll ich den Shortcode schreiben (alte Variante)

`[fubade api="{32-digit API}" notice="{Hinweis}" fullWidth={iframe in voller Breite} devtools={Ausgabe der DevTools}]`\
also z.B. so:\
`[fubade api="020EXXXXXG000000VS54XXXXXSGIXXME" notice="Standings U19" fullWidth=true devtools=false]` Die Felder `notice`,
`fullWidth` und `devtools` sind optional und müssen nicht gesetzt werden.

### Wie soll ich den Shortcode schreiben (neue Variante)

`[fubade api="{36-digit data-id}" type="{data-type}" notice="{Hinweis}" fullWidth={iframe in voller Breite} devtools={Ausgabe der DevTools}]`\
z.B.`[fubade api="299e1496-abcd-abcd-1234-8880c7270477" notice="Standings U19" fullWidth=true devtools=false]`
Die Felder `notice`, `fullWidth` und `devtools` sind optional und müssen nicht gesetzt werden.

### Was ist die `api` (alt: `{32-stellige API}`)

Hier muss die 32-stellige ID (der Website-Schlüssel) aus dem offiziellen Fußball.de-Widget eingegeben werden.\
**Die API ist erforderlich.**

### Was ist die `api` (neu: `{36-stellige data-id}`)

Hier muss die 36-stellige ID (zu finden als `data-id`) aus dem offiziellen Fußball.de-Widget eingegeben werden.\
**Die API ist erforderlich.**

### Was ist der `type` (nur neu: `{data-type}`)

Hier muss die 36-stellige ID (zu finden als `data-id`) aus dem offiziellen Fußball.de-Widget eingegeben werden.\
**Den TYPE gibt es nur bei den neuen Widget. Dort ist er erforderlich.**

### Was ist `classes` als Leerzeichen getrennte `{CSS-Klassen}`

Zu jedem Widget können eigene CSS Klassen hinzugefügt werden, um es manuell zu gestalten.\
Zum Beispiel kann so eine feste Höhe oder etwas ähnliches eingestellt werden.\
**Die CSS KLASSEN sind optional und können weggelassen werden.**

### Was ist der `notice` als `{Hinweis}`

Die Beschreibung kann nach eigenen Wünschen eingegeben werden.\
**HINWEIS ist optional und kann weggelassen werden.**

### Was ist die `fullWidth` als `{iframe in voller Breite}`

Die IFRAME IN VOLLER BREITE kann für das übergeordnete Element auf die volle Breite von 100% eingestellt werden.\
Als Werte sind nur `true` oder `1` möglich.\
Der Standardwert ist `false` bzw. `0`.\
**IFRAME IN VOLLER BREITE ist optional und kann weggelassen werden.**

### Was ist das `devtools` als `{Ausgabe der DevTools}`

Die PRINT DEVTOOLS können dem Ersteller helfen, Debugging-Informationen abzurufen.\
Als Werte sind nur `true` oder `1` möglich.\
Der Standardwert ist `false` bzw. `0`.\
**AUSGABE DER DEVTOOLS ist optional und kann weggelassen werden.**

### Was kann ich machen wenn das Plugin nicht funktioniert

Der erste Anhaltspunkt sollte immer das
[offizielle Support-Forum auf wordpress.org](https://wordpress.org/support/plugin/include-fussball-de-widgets) oder auch der
[Problembereich auf GitHub](https://github.com/mheob/include-fussball-de-widgets/issues) sein.

Gerne und oft werden auch die falschen Anführungszeichen verwendet. Hier muss unbedingt das normale `"`-Zeichen verwendet werden.

Die geschweiften Klammern aus meinen Beispielen weiter oben sollen nur Platzhalter anzeigen. Auch diese werden gerne mal mit
eingefügt, was nicht korrekt ist.
