<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

session_start();
require_once __DIR__."/../modules/db/DB.php";
require_once __DIR__."/../modules/utils.php";
$db = new DB('main', $debug = false);
