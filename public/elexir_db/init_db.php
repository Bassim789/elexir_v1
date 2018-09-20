<?php
session_start();
require_once("DB.php");
$db = new DB('main');

// Create clean tables
 
$db->create_clean_table('user', "
	password_hash VARCHAR(255),
	cookie_auto_login VARCHAR(255),
	confidence_level INT(1),
	INDEX(cookie_auto_login)
");
$db->create_clean_table('user_email', "
	user_id INT(15),
	email VARCHAR(255),
	INDEX(user_id)
");
$db->create_clean_table('user_phone', "
	user_id INT(15),
	phone VARCHAR(31),
	INDEX(user_id)
");


$db->create_clean_table('debate', "
	user_id INT(15),
	public_entity_id INT(15),
	group_id INT(15),
	is_public INT(1),
	title VARCHAR(255),
	description VARCHAR(2047),
	INDEX(user_id),
	INDEX(public_entity_id),
	INDEX(group_id),
	INDEX(is_public)
");
$db->create_clean_table('debate_vote', "
	user_id INT(15),
	debate_id INT(15),
	public_entity_id INT(15),
	value INT(1),
	INDEX(user_id),
	INDEX(public_entity_id),
	INDEX(debate_id),
	INDEX(value)
");


$db->create_clean_table('opinion', "
	user_id INT(15),
	debate_id INT(15),
	public_entity_id INT(15),
	group_id INT(15),
	opinion_parent_id INT(15),
	is_public INT(1),
	title VARCHAR(255),
	description VARCHAR(2047),
	INDEX(user_id),
	INDEX(debate_id),
	INDEX(public_entity_id),
	INDEX(group_id),
	INDEX(is_public)
");
$db->create_clean_table('opinion_vote', "
	user_id INT(15),
	opinion_id INT(15),
	public_entity_id INT(15),
	value INT(1),
	INDEX(user_id),
	INDEX(public_entity_id),
	INDEX(opinion_id),
	INDEX(value)
");


echo 'clean tables created<br><br>';

 

// Insert data

$user1_id = $db->insert('user', [
	'password_hash' => '53415kl5nk3',
	'cookie_auto_login' => 'g9gf89FJIhfg4',
	'confidence_level' => 1
]);
$user2_id = $db->insert('user', [
	'password_hash' => '53415kl5nk3321',
	'cookie_auto_login' => 'g9gf89FJIhfg4312',
	'confidence_level' => 2
]);
$user3_id = $db->insert('user', [
	'password_hash' => '5343215kl5nk3321',
	'cookie_auto_login' => 'g9gf32189FJIhfg4312',
	'confidence_level' => 4
]);


$debate1_id = $db->insert('debate', [
	'user_id' => $user1_id,
	'public_entity_id' => 0,
	'group_id' => 0,
	'is_public' => 1,
	'title' => 'first debate title',
	'description' => 'first debate description'
]);
$debate2_id = $db->insert('debate', [
	'user_id' => $user2_id,
	'public_entity_id' => 0,
	'group_id' => 0,
	'is_public' => 0,
	'title' => 'second debate title',
	'description' => 'seconde debate description'
]);


$debate_vote1_id = $db->insert('debate_vote', [
	'user_id' => $user1_id,
	'debate_id' => $debate1_id,
	'public_entity_id' => 0,
	'value' => 1
]);
$debate_vote2_id = $db->insert('debate_vote', [
	'user_id' => $user2_id,
	'debate_id' => $debate1_id,
	'public_entity_id' => 0,
	'value' => 0
]);


echo 'data inserted<br><br>';
