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
function send_ok(){
    send(['res' => 'ok']);
}
function request($url, $params = []){
    $params_str = '';
    foreach ($params as $key => $value){
        $params_str .= $key.'='.urlencode($value).'&';
    }
    $params_str = trim($params_str, '&');
    $curl = curl_init();
    curl_setopt_array($curl, [
       CURLOPT_RETURNTRANSFER => 1,
       CURLOPT_URL => $url,
       CURLOPT_SSL_VERIFYHOST => 0,
       CURLOPT_SSL_VERIFYPEER => false,
       CURLOPT_POST => 1,
       CURLOPT_POSTFIELDS => $params_str
    ]);
    $res = curl_exec($curl);
    curl_close($curl);
    return $res;
}