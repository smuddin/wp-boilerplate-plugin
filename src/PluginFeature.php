<?php

namespace Smuddin\MyPlugin;

defined('ABSPATH') || exit;

class PluginFeature
{
    public function __construct()
    {
        add_action( 'init', [ $this, 'register_assets' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        
        add_filter( 'woocommerce_locate_template', [ $this, 'load_template' ], 10, 3 );
        add_action( 'some_action', [ $this, 'use_template_file' ] );
    }

    public function register_assets()
    {
        wp_register_style( Plugin::get_domain() . '-admin', Plugin::get_uri( 'assets/css/admin-style.css' ), [], Plugin::get_version() );
    
        $params = [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'i18n' => [
                'text_postcode' => esc_html__( 'Change postcode', Plugin::get_domain() ),
            ],
        ];

        wp_localize_script( Plugin::get_domain() . '-admin', Plugin::get_domain() . '_params', $params );
    }

    public function enqueue_assets()
    {
        wp_enqueue_style( Plugin::get_domain() . '-admin' );
    }

    public function use_template_file()
    {
        wc_get_template( 
			'sample-file.php', 
			[ 
				'var-1' => 'Hello',
				'var-2' => 'World',
			]
		);
    }

    public function load_template( $template, $template_name, $template_path )
    {
        $plugin_path = Plugin::get_dir( 'templates' );
        $theme_template = locate_template( $template_path . $template_name );

        if ( ! $theme_template && file_exists( $plugin_path . $template_name ) ) {
            $template = $plugin_path . $template_name;
        }

        return $template;
    }
}
