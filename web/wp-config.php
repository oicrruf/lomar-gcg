<?php
/**
 * Bedrock WordPress configuration bootstrapper.
 * This replaces the standard wp-config.php; actual config lives in config/application.php.
 */

$root_dir    = dirname(__DIR__);
$webroot_dir = $root_dir . '/web';

require_once $root_dir . '/vendor/autoload.php';
require_once $root_dir . '/config/application.php';

require_once ABSPATH . 'wp-settings.php';
