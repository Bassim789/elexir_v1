<?php

// USER
$db->create_clean_table('user', "
  public_entity_id
  password_hash VARCHAR(255)
  confidence_level INT(1)
");
$db->create_clean_table('user_email', "
  user_id
  email VARCHAR(255)
");
$db->create_clean_table('user_phone', "
  user_id
  phone VARCHAR(31)
");
$db->create_clean_table('user_passport', "
  user_id
  is_identity_card INT(1) INDEX
  is_passport INT(1) INDEX
  doc_num INT(31) INDEX
  avs_num INT(31) INDEX
");
$db->create_clean_table('user_social_media_account', "
  user_id
  account_type VARCHAR(31) INDEX
  account_num INT(31) INDEX
");
$db->create_clean_table('user_log_action', "
  name VARCHAR(255)
");
$db->create_clean_table('user_log', "
  user_id
  user_log_action_id
  object_1_id INT(15) INDEX
  object_2_id INT(15) INDEX
  object_3_id INT(15) INDEX
  timestamp INT(15) INDEX
");
$db->create_clean_table('user_session', "
  user_id
  token VARCHAR(63)
  data TEXT NOT NULL
  browser VARCHAR(255)
  device VARCHAR(255)
  os VARCHAR(255)
  ip VARCHAR(63)
  country VARCHAR(63)
  region VARCHAR(63)
  first_url VARCHAR(63)
  is_user_info_set INT(1) INDEX
  timestamp_creation INT(15) INDEX
  timestamp_last_access INT(15) INDEX
");


// PUBLIC ENTITY
$db->create_clean_table('public_entity', "
  title VARCHAR(255)
  description VARCHAR(2047)
  profil_picture VARCHAR(255)
  banner_picture VARCHAR(255)
");
$db->create_clean_table('public_entity_admin', "
  user_id
  public_entity_id
  is_public INT(1) INDEX
");
$db->create_clean_table('public_entity_user', "
  user_id
  public_entity_id
  is_public INT(1) INDEX
  percent INT(3)
");


// GROUP
$db->create_clean_table('group', "
  title VARCHAR(255)
  description VARCHAR(2047)
  is_public INT(1) INDEX
  profil_picture VARCHAR(255)
  banner_picture VARCHAR(255)
");
$db->create_clean_table('group_admin', "
  user_id
  group_id
  is_public INT(1) INDEX
");
$db->create_clean_table('group_user', "
  user_id
  group_id
  is_public INT(1) INDEX
");
$db->create_clean_table('group_public_entity', "
  group_id
  public_entity_id
");


// DEBATE
$db->create_clean_table('debate', "
  user_id
  public_entity_id
  group_id
  is_public INT(1) INDEX
  title VARCHAR(255)
  description VARCHAR(2047)
  banner_picture VARCHAR(255)
");
$db->create_clean_table('debate_vote', "
  user_id
  debate_id
  public_entity_id
  side INT(1) INDEX
");


// Argument
$db->create_clean_table('argument', "
  user_id
  debate_id
  public_entity_id
  group_id
  parent_argument_id INT(15) INDEX
  is_public INT(1) INDEX
  side INT(1) INDEX
  title VARCHAR(255)
  description VARCHAR(2047)
");
$db->create_clean_table('argument_vote', "
  user_id
  argument_id
  public_entity_id
  side INT(1) INDEX
");


// ELECTION
$db->create_clean_table('election', "
  user_id
  group_id
  public_entity_id
  is_public INT(1) INDEX
  title VARCHAR(255)
  description VARCHAR(2047)
");
$db->create_clean_table('election_debate', "
  election_id
  debate_id
");

