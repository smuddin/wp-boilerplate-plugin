# 📄 Changelog

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](https://semver.org/) and follows the [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) standard.

---

## [1.0.0] = 2025-08-12

### Added
- Added index.php file in main directory to prevent directory listing.

---

## [0.1.0] — 2025-08-10

### Added
- Initial commit with basic plugin header and file structure
- Added `composer.json` file for `PSR-4` autoloading. Use `composer install`.
- Added `my-plugin.php` file as main plugin file. Rename the file as necessary.
- Added `src/Plugin.php` file to define plugin related properties in one place. The `Plugin` class mainly uses static properties. Use it like this, `Plugin::get_name()`. No need for initialization.
- Added `Loader.php` file to bootstrap the plugin.
- Localization support with `.pot` file
- Added check for required plugins and format notice with activation link.
- Added template-function.php file.
- Added template folder for WooCommerce style template files that can be override in themes.
- Added sample JS file which uses OOP JS to make global scope clean and avoid conflict.
- Added PluginFeature.php file to demonstrate commmon functions.