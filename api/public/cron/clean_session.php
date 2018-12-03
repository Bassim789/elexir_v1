<?php
require_once './start_cron.php';

$sessions_to_delete = $db->get_all(
  'user_session',
  'where is_user_info_set = 0 
    and UNIX_TIMESTAMP() - timestamp_creation > 60'
);

if(!$sessions_to_delete) die('no session to delete');

foreach ($sessions_to_delete as $session_to_delete){
  $user_id = $session_to_delete['user_id'];
  echo 'delete user_id: '.$user_id.'<br>';
  $public_entities_to_delete = $db->get_all('public_entity_admin', 'where user_id = '.$user_id);
  if(!$public_entities_to_delete) continue;
  foreach ($public_entities_to_delete as $public_entity_to_delete){
    $public_entity_admins = $db->get_all(
      'public_entity_admin', 
      'where public_entity_id = '.$public_entity_to_delete['public_entity_id']
    );
    if(count($public_entity_admins) == 1){
      $db->delete('public_entity', 'id', $public_entity_to_delete['public_entity_id']);
    }
  }
  $db->delete('user', 'id', $user_id);
}

die('done');