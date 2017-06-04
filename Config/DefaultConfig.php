<?php
define('APP_DEBUG', false);
define("APP_PATH", "./Application");
define('SITE_ROOT', str_replace('\\', '/', __DIR__));
defined('DATA_PATH') or define('DATA_PATH', SITE_ROOT . 'Cache/Smarty/data');