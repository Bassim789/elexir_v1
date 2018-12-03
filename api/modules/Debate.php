<?php
require_once API_ROOT_PATH.'modules/Anonymizer.php';

class Debate{
  function __construct($id, $user){
    $this->user = $user;
    $this->id = intval($id);
    $this->sides = ['pro', 'neutral', 'con'];
    $this->sides_num = [1, 0, -1];
  }
  static function get_side_num($side){
    return str_replace(['pro', 'neutral', 'con'], [1, 0, -1], $side);
  }
  function get_side_name($side_num){
    return $this->sides[array_search($side_num, $this->sides_num)];
  }
  function get_db_data(){
    $this->data = $GLOBALS['db']->get_one('debate', $this->id);
    $this->data['cookies'] = $_COOKIE;
  }
  function anonymize(){
    $this->data = Anonymizer::remove_user_id($this->data);
  }
  function add_nb_vote_and_percent(){
    foreach ($this->sides as $side) $this->set_nb_vote($side);
    $this->set_nb_vote_total();
    foreach ($this->sides as $side) $this->set_percent_vote($side);
    $this->set_max_vote_percent();
    foreach ($this->sides as $side) $this->set_percent_relative_vote($side);
  }
  function set_nb_vote($side){
    $this->data['nb_vote_'.$side] = $GLOBALS['db']->count('debate_vote', 
      'WHERE debate_id = '.$this->id.' AND side = '.Debate::get_side_num($side)
    );
  }
  function set_nb_vote_total(){
    $this->data['nb_vote_total'] = 0;
    foreach ($this->sides as $side) $this->data['nb_vote_total'] += $this->data['nb_vote_'.$side];
  }
  function set_percent_vote($side){
    $nb_vote = $this->data['nb_vote_'.$side];
    $total = $this->data['nb_vote_total'];
    $this->data['percent_vote_'.$side] = round($nb_vote / max(1, $total) * 100, 1);
  }
  function set_percent_relative_vote($side){
    $percent = $this->data['percent_vote_'.$side] / max($this->max_vote_percent, 1) * 100;
    $this->data['percent_relative_vote_'.$side] = $percent;
  }
  function set_max_vote_percent(){
    $this->max_vote_percent = 0;
    foreach ($this->sides as $side){
      if($this->data['percent_vote_'.$side] > $this->max_vote_percent){
        $this->max_vote_percent = $this->data['percent_vote_'.$side];
      }
    }
  }
  function add_arguments(){
    foreach ($this->sides as $side) $this->add_side_arguments($side);
  }
  function add_side_arguments($side){
    $this->data['sides'][$side]['name'] = $side;
    $arguments = $GLOBALS['db']->get_all('argument', 
      'WHERE debate_id = '.$this->id.' AND side = '.Debate::get_side_num($side).' order by id desc'
    );
    if(!$arguments) return $arguments = [];
    foreach ($arguments as $i => $argument) {
      $public_entity = $GLOBALS['db']->get_one('public_entity', $argument['public_entity_id'], 'id');
      $arguments[$i]['user_name'] = $public_entity['title'];
      $arguments[$i]['profil_picture'] = $public_entity['profil_picture'];
      $arguments[$i]['is_own_argument'] = $argument['user_id'] == $this->user->id;
    }
    $this->data['sides'][$side]['arguments'] = Anonymizer::remove_user_id_from_list($arguments);
  }
  function add_user_own_vote(){
    $vote = $GLOBALS['db']->get_all('debate_vote', 'where debate_id = '.$this->id.' and user_id = '.$this->user->id);
    if($vote){
      $this->data['user_own_vote'] = $this->get_side_name($vote[0]['side']);
    } else {
      $this->data['user_own_vote'] = 'nothing';
    }
  }
}