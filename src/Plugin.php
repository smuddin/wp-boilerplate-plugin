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

    public static function get_dir( string $append_path = '', bool $is_file = false ): string
    {
        return self::build_path( WP_PLUGIN_DIR, $append_path, $is_file );
    }

    public static function get_uri( string $append_uri = '', bool $is_file = false ): string
    {
        return self::build_path( WP_PLUGIN_URL, $append_uri, $is_file );
    }

    private static function build_path( string $base, string $path, bool $is_file ): string
    {
        $base = trailingslashit( $base . '/' . self::DOMAIN );
        $path = ltrim( $path, '/' );
        $full = $base . $path;

        return $is_file ? $full : trailingslashit( $full );
    }
}
