<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

session_start();
require_once "DB.php";
$db = new DB('main');

include_once "create_tables.php";
include_once "insert_data.php";

echo 'init db done';