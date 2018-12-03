<?php
class Session{
  function __construct(){
    $is_new_cookie_token = false;
    $cookie_token = false;

    if(isset($_GET['cookie_token'])){
      $cookie_token = $_GET['cookie_token'];
    }
    if(isset($_POST['cookie_token'])){
      $cookie_token = $_POST['cookie_token'];
    }

    if(!$cookie_token){
      if(!isset($_POST['from_nuxt_server_init'])) send(['error' => 'no cookie_token']);
      $cookie_token = $this->create_new_session();
      $is_new_cookie_token = true;
    }

    $data = $GLOBALS['db']->get_one('user_session', $cookie_token, 'token');
    if(!$data){
      if(!isset($_POST['from_nuxt_server_init'])){
        send(['error' => 'no session found for cookie_token: '.$cookie_token]);
      }
      $cookie_token = $this->create_new_session();
      $is_new_cookie_token = true;
      $data = $GLOBALS['db']->get_one('user_session', $cookie_token, 'token');
    }
    $data['is_new_cookie_token'] = $is_new_cookie_token;
    $data['cookie_token'] = $cookie_token;
    $this->data = $data;
    $this->update_session();
  }
  function create_new_session(){
    $public_entity_id = $GLOBALS['db']->insert('public_entity', [
      'title' => 'user_'.rand(100000, 999999),
      'description' => 'Bonjour, bienvenue sur mon profil...',
      'profil_picture' => '/img/default_profil_picture_public_entity.png',
      'banner_picture' => '/img/default_banner_picture_public_entity.png'
    ]);
    $user_id = $GLOBALS['db']->insert('user', [
      'public_entity_id' => $public_entity_id,
      'password_hash' => '',
      'confidence_level' => 1
    ]);
    $public_entity_admin_id = $GLOBALS['db']->insert('public_entity_admin', [
      'user_id' => $user_id,
      'public_entity_id' => $public_entity_id,
      'is_public' => 1
    ]);
    $public_entity_user_id = $GLOBALS['db']->insert('public_entity_user', [
      'user_id' => $user_id,
      'public_entity_id' => $public_entity_id,
      'is_public' => 1,
      'percent' => 100,
    ]);
    $token = bin2hex(random_bytes(20));
    $GLOBALS['db']->insert('user_session', [
      'user_id' => $user_id,
      'token' => $token,
      'data' => serialize(['user_id' => $user_id]),
      'first_url' => $_POST['first_url'],
      'is_user_info_set' => 0,
      'timestamp_last_access' => time(),
      'timestamp_creation' => time(),
    ]);
    return $token;
  }
  function update_session(){
    $data = ['timestamp_last_access' => time()];
    $GLOBALS['db']->update('user_session', $data, 'id', $this->data['id']);
  }
  function set_device_info($data){
    $GLOBALS['db']->update('user_session', $data, 'id', $this->data['id']);
  }
  function get_data(){
    return $this->data;
  }
}