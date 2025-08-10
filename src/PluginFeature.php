<?php

namespace Smuddin\MyPlugin;

defined('ABSPATH') || exit;

class PluginFeature
{
    public function __construct()
    {
        add_filter( 'woocommerce_locate_template', [ $this, 'load_template' ], 10, 3 );
        add_action( 'some_action', [ $this, 'use_template_file' ] );
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
