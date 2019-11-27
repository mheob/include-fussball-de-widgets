# Changelog

All notable changes to this project will be documented in this file.

## [Unreleased]

### Changed

- Refactor "null ===" to exclamation mark syntax.
- Reformat code, so that the coding standards can be better adhered to and thus a faster development is possible.
- Integrate more test, to prevent possible error.

## [3.0.5] - 2019-10-13

### Fixed

- Due to problems with the WordPress REST API the SourceLogger is deactivated until further notice.

## [3.0.4] - 2019-10-08

### Added

- Error handling during generation of iframe.
- Highlighting of errors by displaying an alert box.

### Fixed

- IFDW\Utils\Host::cleanHost() must be of the type string, null given.

## [3.0.3] - 2019-09-24

### Fixed

- Loading issue when generating the widget via the gutenberg blocks.

## [3.0.2] - 2019-09-23

### Fixed

- Add Fusion-Tabs as the same as Divi-Tabs.

## [3.0.1] - 2019-09-19

### Fixed

- Warning: Use of undefined constant INTL_IDNA_VARIANT_UTS46

## [3.0.0] - 2019-09-16

### Added

- A fussball.de widget can be generated in the WordPress widget area (Appearance -> Widgets).
- Tabs from theme Divi-Theme are now supported.
- Borlabs-Cookie support for loading the plugin as an opt-in setting.
- A donation link to cover my expenses a bit.

### Changed

- _IMPORTANT_ Set the required PHP version up to 7.2.
- Redesign the whole structure and use OOP from now on.
- Initialization of the fussball.de iframe from now on in PHP instead of JavaScript.

### Fixed

- Logging issues have been resolved.

## [2.2.2] - 2019-06-20

### Fixed

- Load the fubade-api in the footer.

## [2.2.1] - 2019-06-09

### Fixed

- The inline styles height and width are removed to prevent complications with the themes.

## [2.2.0] - 2019-06-05

### Fixed

- The widget will now also appear in IE and in the Edge if the domain uses non-ASCII characters (such as ä, ö, ü).

### Added

- The Plugin is tested up to wordpress version 5.2.
- Preparations for easier debugging.

### Changed

- Redefined the file structure for using WebPack in the development.
- Using the newest javascript features (ES6) for easier development.
- Cleanup the php code for a better performance.
- Update readme files for better plugin usage instructions.

## [2.1.1] - 2019-03-25

### Fixed

- Fix a bug in the IE11, when the fullwidth was not set.

## [2.1.0] - 2019-03-03

### Added

- Support for setting up the width of the widget to 100% to of their parent element.
- This changelog.
- The ToDo.md file.

## [2.0.3] - 2019-01-27

### Fixed

- Fix an issue, that the Internet Explorer 11 can't load plugin.

## [2.0.2] - 2018-11-28

### Added

- Local language files. For the Gutenberg Block they aren't in GlotPress.

## [2.0.1] - 2018-11-24

### Fixed

- Fix the "Fatal error: Call to undefined function register_block_type()".

## [2.0.0] - 2018-11-24

### Added

- Using as Gutenberg Block.
- The Plugin is tested up to wordpress version 5.0.

### Changed

- No more input for the ID is needed. It will generate automatically at now.
- Redesign the whole structure.

## [1.6.1] - 2018-03-26

### Fixed

- If the ID is numeric only, a string will added in front.

## [1.6.0] - 2018-03-17

### Fixed

- Clean up the ID in the shortcode by using only chars, digits and underscores. This prevents some possible errors.
- Fix a typo on the loading text.

## [1.5.5] - 2018-02-06

### Changed

- Some minor code reformations for a better performance.

### Added

- The Plugin is tested up to wordpress version 4.9.4.

## [1.5.4] - 2018-01-17

### Added

- The Plugin is tested up to wordpress version 4.9.2.

## [1.5.3] - 2017-11-13

### Added

- The Plugin is tested up to wordpress version 4.9.

## [1.5.2] - 2017-11-01

### Added

- The Plugin is tested up to wordpress version 4.8.3.

## [1.5.1] - 2017-08-30

### Fixed

- Fix the "uncaught ReferenceError: fubade is not defined".

## [1.5.0] - 2017-08-26

### Added

- From now on several widgets on a page are possible.

### Changed

- The FAQ are now with much more accurate descriptions.

## [1.4.0] - 2017-08-23

### Fixed

- Fix a wrong sequence in the layout of the scripts.

## [1.3.0] - 2017-08-23

### Fixed

- Fix some typos.

## [1.2.0] - 2017-08-23

### Fixed

- Fix some typos.

## [1.1.0] - 2017-08-23

### Fixed

- Fix some typos.

## 1.0.0 - 2017-08-22

- Initial release.

[unreleased]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v3.0.5...HEAD
[3.0.5]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v3.0.4...v3.0.5
[3.0.4]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v3.0.3...v3.0.4
[3.0.3]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v3.0.2...v3.0.3
[3.0.2]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v3.0.1...v3.0.2
[3.0.1]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v3.0.0...v3.0.1
[3.0.0]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v2.2.2...v3.0.0
[2.2.2]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v2.2.1...v2.2.2
[2.2.1]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v2.2.0...v2.2.1
[2.2.0]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v2.1.1...v2.2.0
[2.1.1]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v2.1.0...v2.1.1
[2.1.0]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v2.0.3...v2.1.0
[2.0.3]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v2.0.2...v2.0.3
[2.0.2]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v2.0.1...v2.0.2
[2.0.1]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v2.0.0...v2.0.1
[2.0.0]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.6.1...v2.0.0
[1.6.1]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.6...v1.6.1
[1.6.0]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.5.5...v1.6
[1.5.5]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.5.4...v1.5.5
[1.5.4]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.5.3...v1.5.4
[1.5.3]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.5.2...v1.5.3
[1.5.2]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.5.1...v1.5.2
[1.5.1]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.5...v1.5.1
[1.5.0]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.5...v1.5
[1.4.0]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.3...v1.4
[1.3.0]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.2...v1.3
[1.2.0]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.1...v1.2
[1.1.0]: https://github.com/ITS-Boehm/include-fussball-de-widgets/compare/v1.0...v1.1
