<?php
require_once 'start_public_api.php';
require_once API_ROOT_PATH.'modules/Debate.php';

if(action('get_basic_info')){
  $debate = new Debate($_POST['debate_id'], $user);
  $debate->get_db_data();
  if(!$debate->data) send_error('no debate data found');
  $debate->anonymize();
  $debate->add_nb_vote_and_percent();
  $debate->add_arguments();
  $debate->add_user_own_vote();
  send($debate->data);
}

if(action('add_new_argument')){
  $side_num = 0;
  if($_POST['side'] != 'nothing'){
    $side_num = Debate::get_side_num($_POST['side']);
  }
  $argument_id = $db->insert('argument', [
    'user_id' => $user->id,
    'public_entity_id' => $user->public_entity['id'],
    'debate_id' => $_POST['debate_id'],
    'group_id' => 1,
    'side' => $side_num,
    'parent_argument_id' => $_POST['parent_argument_id'],
    'is_public' => 1,
    'title' => $_POST['title'],
    'description' => $_POST['description']
  ]);
  send(['test' => 'ok', 'post' => $_POST]);
}

if(action('select_vote')){
  $vote_side = $_POST['vote_side'];
  $vote_value = 'no vote';
  if($vote_side == 'pro'){
    $vote_value = 1;
  } else if ($vote_side == 'neutral') {
    $vote_value = 0;
  } else if ($vote_side == 'con') {
      $vote_value = -1;
  }
  $db->delete_where(
    'debate_vote', 
    ' user_id = '.$user->id.'
      and debate_id = '.intval($_POST['debate_id'])
  );
  if($vote_side != 'nothing'){
    $debate_vote_id = $db->insert('debate_vote', [
      'user_id' => $user->id,
      'debate_id' => intval($_POST['debate_id']),
      'public_entity_id' => $user->public_entity_id,
      'side' => $vote_value
    ]);
    send(['res' => 'ok', 'debug' => 'ooook']);
  }
  send(['res' => 'ok', 'debug' => $vote_side, 'debug_vote_value' => $vote_value]);
}

if(action('delete_argument')){
  $db->delete_where(
    'argument', 
    ' user_id = '.$user->id.'
      and id = '.intval($_POST['argument_id'])
  );
  send(['test' => 'ok', 'post' => $_POST]);
}



send_error('no action found');