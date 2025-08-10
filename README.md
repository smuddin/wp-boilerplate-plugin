# WordPress boilerplate plugin
Class based WordPress starter plugin. Accumulate best practices in developing WordPress plugin.

1. Rename the main plugin file from `my-plugin.php` to your plugin's slug.
2. Search and replace the following texts: `my-plugin`, `My Plugin`, `MyPlugin`
3. Rename `languages/my-plugin.pot` file to match your plugin's slug.
4. Run `composer install` command
5. Final check in `src/Loader.php` and `src/Plugin.php` file for any error.
6. Check required plugin list in `src/Plugin.php` file and update the array accoringly.
