<?php

namespace Smuddin\MyPlugin;

defined( 'ABSPATH' ) || exit;

final class Plugin
{
    public const NAME    = 'My Plugin';
    public const VERSION = '1.0.1';
    public const DOMAIN  = 'my-plugin';

    private function __construct() {}
    private function __clone() {}
    public function __wakeup() 
    {
        throw new \Exception('Cannot unserialize Plugin class.');
    }

    public static function run(): void
    {
        new Loader();
    }

    public static function get_name(): string
    {
        return self::NAME;
    }

    public static function get_version(): string
    {
        return self::VERSION;
    }

    public static function get_domain(): string
    {
        return self::DOMAIN;
    }

    public static function get_dir( string $append_dir = '' ): string
    {
        $base = trailingslashit( WP_PLUGIN_DIR . '/'. self::DOMAIN );
        $append = ltrim( $append_dir, '/' );

        return $base . $append;
    }

    public static function get_uri( string $append_uri = '' ): string
    {
        $base = trailingslashit( WP_PLUGIN_URL . '/'. self::DOMAIN );
        $append = ltrim( $append_uri, '/' );
        
        return $base . $append;
    }
}
