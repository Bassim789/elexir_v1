<?php

// USER
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


// PUBLIC ENTITY
$public_entity_anonymous_id = $db->insert('public_entity', [
    'title' => 'anonymous public entity',
    'description' => 'anonymous public entity'
]);


// GROUP
$group_anonymous_id = $db->insert('group', [
    'title' => 'main group',
    'description' => 'main group'
]);


// DEBATE
$debate1_id = $db->insert('debate', [
    'user_id' => $user1_id,
    'public_entity_id' => $public_entity_anonymous_id,
    'group_id' => $group_anonymous_id,
    'is_public' => 1,
    'title' => 'first debate title',
    'description' => 'first debate description'
]);
$debate2_id = $db->insert('debate', [
    'user_id' => $user2_id,
    'public_entity_id' => $public_entity_anonymous_id,
    'group_id' => $group_anonymous_id,
    'is_public' => 0,
    'title' => 'second debate title',
    'description' => 'seconde debate description'
]);


// DEBATE VOTE
$debate_vote1_id = $db->insert('debate_vote', [
    'user_id' => $user1_id,
    'debate_id' => $debate1_id,
    'public_entity_id' => $public_entity_anonymous_id,
    'value' => 1
]);
$debate_vote2_id = $db->insert('debate_vote', [
    'user_id' => $user2_id,
    'debate_id' => $debate1_id,
    'public_entity_id' => $public_entity_anonymous_id,
    'value' => -1
]);
$debate_vote3_id = $db->insert('debate_vote', [
    'user_id' => $user3_id,
    'debate_id' => $debate1_id,
    'public_entity_id' => $public_entity_anonymous_id,
    'value' => 1
]);


// DEBATE OPINION
$opinion1_id = $db->insert('opinion', [
    'user_id' => $user1_id,
    'debate_id' => $debate1_id,
    'public_entity_id' => $public_entity_anonymous_id,
    'group_id' => $group_anonymous_id,
    'value' => 1,
    'opinion_parent_id' => 0,
    'is_public' => 1,
    'title' => 'my first opinion',
    'description' => 'my first opinion description'
]);
$opinion2_id = $db->insert('opinion', [
    'user_id' => $user2_id,
    'debate_id' => $debate1_id,
    'public_entity_id' => $public_entity_anonymous_id,
    'group_id' => $group_anonymous_id,
    'value' => 1,
    'opinion_parent_id' => 0,
    'is_public' => 1,
    'title' => 'my second opinion',
    'description' => 'my second opinion description'
]);




