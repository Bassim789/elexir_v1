<?php
require_once API_ROOT_PATH.'modules/Anonymizer.php';

class Debate{
  function __construct($id){
    $this->id = intval($id);
    $this->sides = ['pro', 'neutral', 'con'];
    $this->sides_num = [1, 0, -1];
  }
  function get_side_num($side){
    return str_replace($this->sides, $this->sides_num, $side);
  }
  function get_db_data(){
    $this->data = $GLOBALS['db']->get_one('debate', $this->id);
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
      'WHERE debate_id = '.$this->id.' AND side = '.$this->get_side_num($side)
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
      'WHERE debate_id = '.$this->id.' AND side = '.$this->get_side_num($side)
    );
    if(!$arguments) return $arguments = [];
    $this->data['sides'][$side]['arguments'] = Anonymizer::remove_user_id_from_list($arguments);
    
  }
}