<?php

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

