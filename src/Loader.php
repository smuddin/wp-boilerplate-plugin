<?php

namespace Smuddin\MyPlugin;

defined( 'ABSPATH' ) || exit;

class Loader
{
    public function __construct()
    {
        // add your necessary hooks and filters here
        add_action( 'init', [ $this, 'register_assets' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );

        add_action( 'plugins_loaded', [ $this, 'load' ] );
    }

    public function load()
    {
        // Load text domain for translations
        load_plugin_textdomain( Plugin::get_domain(), false, Plugin::get_domain() . '/languages/' );
    }

    public function register_assets()
    {
        wp_register_style( Plugin::get_domain() . '-admin', Plugin::get_uri( 'assets/css/admin-style.css' ), [], Plugin::get_version() );
    }

    public function enqueue_assets()
    {
        wp_enqueue_style( Plugin::get_domain() . '-admin' );
    }
}
