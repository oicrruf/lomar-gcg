<?php

use Roots\WPConfig\Config;
use function Env\env;

$webroot_dir = $root_dir . '/web';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable($root_dir);
if (file_exists($root_dir . '/.env')) {
    $dotenv->load();
    $dotenv->required(['WP_HOME', 'WP_SITEURL']);
    if (!env('DATABASE_URL')) {
        $dotenv->required(['DB_NAME', 'DB_USER', 'DB_PASSWORD']);
    }
}

define('WP_ENV', env('WP_ENV') ?: 'production');

if ($dsn = env('DATABASE_URL')) {
    $parts = parse_url($dsn);
    Config::define('DB_NAME', ltrim($parts['path'], '/'));
    Config::define('DB_USER', $parts['user'] ?? '');
    Config::define('DB_PASSWORD', $parts['pass'] ?? '');
    Config::define('DB_HOST', isset($parts['port']) ? $parts['host'] . ':' . $parts['port'] : $parts['host']);
} else {
    Config::define('DB_NAME', env('DB_NAME'));
    Config::define('DB_USER', env('DB_USER'));
    Config::define('DB_PASSWORD', env('DB_PASSWORD'));
    Config::define('DB_HOST', env('DB_HOST') ?: 'localhost');
}

Config::define('DB_CHARSET', 'utf8mb4');
Config::define('DB_COLLATE', '');
$table_prefix = env('DB_PREFIX') ?: 'wp_';

Config::define( 'WP_REDIS_HOST', env( 'REDIS_HOST' ) ?? '127.0.0.1' );
Config::define( 'WP_REDIS_PORT', (int) ( env( 'REDIS_PORT' ) ?? 6379 ) );
Config::define( 'WP_REDIS_DISABLED', (bool) ( env( 'WP_REDIS_DISABLED' ) ?? false ) );

Config::define('WP_HOME', env('WP_HOME'));
Config::define('WP_SITEURL', env('WP_SITEURL') ?: env('WP_HOME') . '/wp');

Config::define('WP_CONTENT_DIR', $webroot_dir . '/app');
Config::define('WP_CONTENT_URL', Config::get('WP_HOME') . '/app');

Config::define('AUTH_KEY',         env('AUTH_KEY'));
Config::define('SECURE_AUTH_KEY',  env('SECURE_AUTH_KEY'));
Config::define('LOGGED_IN_KEY',    env('LOGGED_IN_KEY'));
Config::define('NONCE_KEY',        env('NONCE_KEY'));
Config::define('AUTH_SALT',        env('AUTH_SALT'));
Config::define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
Config::define('LOGGED_IN_SALT',   env('LOGGED_IN_SALT'));
Config::define('NONCE_SALT',       env('NONCE_SALT'));

Config::define('AUTOMATIC_UPDATER_DISABLED', true);
Config::define('DISABLE_WP_CRON', env('DISABLE_WP_CRON') ?: false);
Config::define('DISALLOW_FILE_EDIT', true);
Config::define('DISALLOW_FILE_MODS', true);

$env_config = __DIR__ . '/environments/' . WP_ENV . '.php';
if (file_exists($env_config)) {
    require_once $env_config;
}

Config::apply();
// Debug constants are defined in environment config

if (!defined('ABSPATH')) {
    define('ABSPATH', $webroot_dir . '/wp/');
}
