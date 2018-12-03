<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
define('API_ROOT_PATH', __DIR__.'/../../');
require_once API_ROOT_PATH.'modules/db/DB.php';
require_once API_ROOT_PATH.'modules/utils.php';
$db = new DB('main', $debug = false);