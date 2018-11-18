<?php
class Session{
  function __construct(){
    $is_new_session_token = false;
    $session_token = false;
    if(isset($_COOKIE['session_token'])){
      $session_token = $_COOKIE['session_token'];
    }
    if(isset($_GET['session_token'])){
      $session_token = $_GET['session_token'];
    }

    if(!$session_token){
      $session_token = $this->create_new_session();
      $is_new_session_token = true;
    }
    $data = $GLOBALS['db']->get_one('user_session', $session_token, 'token');
    if(!$data){
      $session_token = $this->create_new_session();
      $is_new_session_token = true;
      $data = $GLOBALS['db']->get_one('user_session', $session_token, 'token');
    }
    $data['is_new_session_token'] = $is_new_session_token;
    $data['session_token'] = $session_token;
    $this->data = $data;
  }
  function create_new_session(){
    $token = bin2hex(random_bytes(20));
    $user_id = $GLOBALS['db']->insert('user', [
      'name' => 'user_'.rand(1,9999),
      'password_hash' => '',
      'confidence_level' => 1
    ]);
    $GLOBALS['db']->insert('user_session', [
      'user_id' => $user_id,
      'token' => $token,
      'data' => serialize(['user_id' => $user_id]),
      'timestamp_last_access' => time()
    ]);
    return $token;
  }
  function get_data(){
    return $this->data;
  }
}