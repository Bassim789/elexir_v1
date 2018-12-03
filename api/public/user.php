<?php
require_once 'start_public_api.php';

if(action('get')){
  $sessions = $db->get_all('user_session', 'where user_id = '.$user->id);
  send([
    'id' => $user->id,
    'confidence_level' => $user->confidence_level,
    'is_new_cookie_token' => $session_data['is_new_cookie_token'],
    'cookie_token' => $session_data['cookie_token'],
    'public_entity_id' => $user->public_entity['id'],
    'is_user_info_set' => $session_data['is_user_info_set'],
    'sessions' => $sessions,
    'public_entities' => $user->public_entities,
  ]);
}

if(action('set_device_info')){
  if($session_data['is_user_info_set']){
    send(['is_user_info_set' => true]);
  }

  $is_user_info_set = false;
  $browser = $_POST['user_agent_info']['browser'];
  $device = $_POST['user_agent_info']['device'];
  $os = $_POST['user_agent_info']['os'];
  $ip = $_POST['ip'];

  $res = request('http://api.ipstack.com/'.$ip.'?access_key=53676bfa4b74a34129bf924dcdfc5b66');
  $res_data = json_decode($res, true);
  if(isset($res_data['country_name'])) $is_user_info_set = true;
 
  $session->set_device_info([
    'browser' => $browser['name'].': '.$browser['version'],
    'device' => $device['vendor'].': '.$device['model'].'; '.$device['type'],
    'os' => $os['name'].': '.$os['version'],
    'ip' => $ip,
    'country' => $res_data['country_name'],
    'region' => $res_data['region_name'],
    'is_user_info_set' => $is_user_info_set ? 1 : 0
  ]);

  send([
    'is_user_info_set' => $is_user_info_set
  ]);
}

if(action('change_name')){
  $db->update('public_entity', ['title' => $_POST['new_name']], 'id', $user->public_entity['id']);
  send_ok();
}

if(action('upload_profil_picture')){
  $uploaddir = API_ROOT_PATH.'../elexir-app/static';
  $img_name = '/img/uploads/'.'img_'.rand(0, 99999999999).'.'.explode('image/', $_FILES['userfile']['type'])[1];
  if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$img_name)) {
    $db->update('public_entity', ['profil_picture' => $img_name], 'id', $user->public_entity['id']);
    send([
      'res' => 'ok',
      '$_files' => $_FILES,
      'profil_picture' => $img_name
    ]);
  } else {
     send([
      'res' => 'error',
      '$_files' => $_FILES
    ]);
  }
}

send_error('no action found');