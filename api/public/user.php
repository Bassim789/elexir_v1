<?php
require_once 'start_public_api.php';

if(action('get')){
  $session_data = $session->get_data();
  $user = $db->get_one('user', $session_data['user_id']);
  send([
    'id' => $user['id'],
    'name' => $user['name'],
    'is_new_session_token' => $session_data['is_new_session_token'],
    'session_token' => $session_data['session_token'],
    'get_value' => $_GET,
    'cookie_value' => $_COOKIE
  ]);
}

send_error('no action found');