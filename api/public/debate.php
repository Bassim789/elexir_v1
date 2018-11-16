<?php
require_once 'start_public_api.php';
require_once API_ROOT_PATH.'modules/Debate.php';

if(action('get_basic_info')){
  $debate = new Debate($_GET['debate_id']);
  $debate->get_db_data();
  if(!$debate->data) send_error('no debate data found');
  $debate->anonymize();
  $debate->add_nb_vote_and_percent();
  $debate->add_arguments();   
  send($debate->data);
}

if(action('add_new_argument')){
  $argument1_id = $db->insert('argument', [
    'user_id' => 1,
    'debate_id' => $_POST['debate_id'],
    'public_entity_id' => $public_entity_anonymous_id,
    'group_id' => $group_anonymous_id,
    'side' => 0,
    'parent_argument_id' => $_POST['parent_argument_id'],
    'is_public' => 1,
    'title' => $_POST['title'],
    'description' => $_POST['description']
  ]);
  send(['test' => 'ok', 'post' => $_POST]);
}

send_error('no action found');