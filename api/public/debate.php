<?php
require_once "start_public_api.php";

function remove_user_id($item){
    if(isset($item['user_id'])) unset($item['user_id']);
    return $item;
}

function remove_user_id_from_list($items){
    $new_item_list = [];
    foreach ($items as $item) $new_item_list[] = remove_user_id($item);
    return $new_item_list;
}

function get_debate_opinions($debate_id){
    $opinions = $GLOBALS['db']->get_all('opinion', 'WHERE debate_id = '.intval($debate_id));
    $opinions = remove_user_id_from_list($opinions);
    return $opinions;
}

if(action('get_basic_info')){
    $debate_id = intval($_GET['debate_id']);
    $debate = $db->get_one('debate', $debate_id);
    if(!$debate) send_error('no debate found');
    $debate = remove_user_id($debate);
    $debate['nb_vote_pro'] = $db->count('debate_vote', 'WHERE debate_id = '.$debate_id.' AND value = 1');
    $debate['nb_vote_neutral'] = $db->count('debate_vote', 'WHERE debate_id = '.$debate_id.' AND value = 0');
    $debate['nb_vote_con'] = $db->count('debate_vote', 'WHERE debate_id = '.$debate_id.' AND value = -1');    
    $debate['opinions'] = get_debate_opinions($debate_id);
    send($debate);
}

send([
    'error' => 'no action found'
]);