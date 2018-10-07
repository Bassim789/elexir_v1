<?php
function startsWith($haystack, $needle){
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}
function endsWith($haystack, $needle){
    $length = strlen($needle);
    if ($length == 0) return true;
    return (substr($haystack, -$length) === $needle);
}
function clean_str($str){
    return trim(trim($str, "\n"), ',');
}
function action($action){
    return isset($_GET['action']) && $_GET['action'] === $action;
}
function send($data){
    die(json_encode($data));
}
function send_error($msg){
    send(['error' => $msg]);
}