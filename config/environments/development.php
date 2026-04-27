<?php

use Roots\WPConfig\Config;
use function Env\env;

Config::define('WP_DEBUG', true);
Config::define('WP_DEBUG_LOG', true);
Config::define('WP_DEBUG_DISPLAY', env('WP_DEBUG_DISPLAY') ?: false);
Config::define('SAVEQUERIES', true);
Config::define('SCRIPT_DEBUG', true);
Config::define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
Config::define('DISALLOW_FILE_MODS', false);
