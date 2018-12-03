<?php
class User{
  function __construct($user_id){
    $this->id = $user_id;
    $this->db = $GLOBALS['db'];
  }
  function set_data(){
    $db_data = $this->db->get_one('user', $this->id);
    $this->public_entity_id = $db_data['public_entity_id'];
    $this->confidence_level = $db_data['confidence_level'];
    $this->get_user_public_entities();
    $this->get_user_public_entity();
  }
  function get_user_public_entities(){
    $public_entities_admin = $this->db->get_all(
      'public_entity_admin', 
      'where user_id = '.$this->id
    );
    $public_entities = [];
    foreach ($public_entities_admin as $public_entity_admin) {
      $public_entities_db = $this->db->get_all(
        'public_entity', 
        'where id = '.$public_entity_admin['public_entity_id']
      );
      foreach ($public_entities_db as $public_entity_db) {
        $public_entities[] = $public_entity_db;
      }
    }
    $this->public_entities = $public_entities;
  }
  function get_user_public_entity(){
    foreach ($this->public_entities as $public_entity) {
      if($public_entity['id'] == $this->public_entity_id){
        $this->public_entity = $public_entity;
      }
    }
  }
}