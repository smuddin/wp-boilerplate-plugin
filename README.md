# WordPress boilerplate plugin
Class based WordPress starter plugin. Accumulate best practices in developing WordPress plugin.

1. Rename the main plugin file from `my-plugin.php` to your plugin's slug.
2. Search and replace the following texts: `my-plugin`, `My Plugin`, `MyPlugin`, `myPlugin`
3. Rename `languages/my-plugin.pot` file to match your plugin's slug.
4. Remove `"files": ["includes/template-functions.php"]` line `composer.json` file and `includes/template-functions.php` file if you don't have non-class files or any file outside `src` folder.
5. Run `composer install` command
6. Final check in `src/Loader.php` and `src/Plugin.php` file for any error.
7. Check required plugin list in `src/Plugin.php` file and update the array accoringly.
8. Remove template folder, if you don't have WC template.
