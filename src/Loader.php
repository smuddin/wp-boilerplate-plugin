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
        if ( ! $this->check_required_plugins() ) {
            return;
        }

        // Load text domain for translations
        load_plugin_textdomain( Plugin::get_domain(), false, Plugin::get_domain() . '/languages/' );

        new PluginFeature();
    }

    private function check_required_plugins()
    {
        if ( $this->is_required_plugins_active() ) {
            return true;
        }

        $required_plugins[] = [
            'name' => 'WooCommerce',
            'file' => 'woocommerce/woocommerce.php',
            'url' => 'https://wordpress.org/plugins/woocommerce/',
            'button' => __( 'Activate WooCommerce', Plugin::get_domain() ),
            'is_active' => class_exists('\WooCommerce') && class_exists('\WC_AJAX'),
        ];

        $action_buttons = '';
        if ( current_user_can( 'activate_plugins' ) ) {
            foreach ( $required_plugins as $plugin ) {
                $action_button = '';
                if ( ! $plugin['is_active'] ) {
                    $action_button = admin_url( 'plugins.php?action=activate&plugin=' . urlencode( $plugin['file'] ) );
                    $action_button = wp_nonce_url( $action_button, 'activate-plugin_' . $plugin['file'] );
                    $action_button = '<a href="' . esc_url( $action_button ) . '" class="button-primary">' . $plugin['button'] . '</a>';
                }
                $action_buttons .= ' ' . $action_button;
            }
        }

        $plugin_lists = [];
        foreach ( $required_plugins as $plugin ) {
            if ( ! $plugin['is_active'] ) {
                $plugin_lists[] = '<strong><a href="' . esc_url( $plugin['url'] ) . '" target="_blank">' . $plugin['name'] . '</a></strong>';
            }
        }
        
        $plugin_links = implode( ', ', $plugin_lists );
        $plugin_links = count( $required_plugins ) > 1 ? $plugin_links . ' plugins' : $plugin_links . ' plugin';

        ?>
        <div class="notice notice-error">
            <p>
            <?php
                printf( 
                    __( '<strong>%s</strong> plugin requires %s installed & activated. Please activate the required plugin in order the <strong>%s</strong> plugin to work. %s', Plugin::get_domain() ),
                    Plugin::get_name(),
                    $plugin_links,
                    Plugin::get_name(),
                    $action_buttons
                );
            ?>
            </p>
        </div>
        <?php
        
        return false;
    }

    private function is_required_plugins_active()
    {
        $is_active = true;
        $plugins['woocommerce'] = class_exists('\WooCommerce') && class_exists('\WC_AJAX');

        foreach ( $plugins as $plugin ) {
            if ( $plugin === false ) {
                $is_active = false;
                break;
            }
        }

        return $is_active;
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
