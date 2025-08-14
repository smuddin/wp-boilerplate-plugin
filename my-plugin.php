<?php
/**
 * Plugin Name:       My Plugin
 * Plugin URI:        https://github.com/smuddin/woocommerce-bookstore
 * Description:       Write a proper description of your plugin here.
 * Version:           1.0.1
 * Author:            SM Uddin
 * Author URI:        https://arifuddin.xyz/
 * Requires Plugins:  woocommerce
 * Requires at least: 6.0
 * Tested up to:      6.5
 * Requires PHP:      8.1
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       my-plugin
 * Domain Path:       /languages
 * Tags:              WooCommerce, bookstore, online-store
 */

use Smuddin\MyPlugin\Plugin;

defined( 'ABSPATH' ) || exit;

// require autoloader
require_once __DIR__ . '/vendor/autoload.php';

register_activation_hook( __FILE__, [ Smuddin\MyPlugin\Loader::class, 'activate' ] );
register_deactivation_hook( __FILE__, [ Smuddin\MyPlugin\Loader::class, 'deactivate' ] );
register_uninstall_hook( __FILE__, [ Smuddin\MyPlugin\Loader::class, 'uninstall' ] );

Plugin::run();
