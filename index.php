<?php
/**
 *
 */
define('ROOT_PATH', __DIR__);
if (isset($_GET['debug'])) {
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
}
require "Library/Init";
Run\Init::RunInit();