<?php

// PUBLIC ENTITY
$public_entity1_id = $db->insert('public_entity', [
  'title' => 'user 1',
  'description' => 'I am the user 2',
  'profil_picture' => '/img/default_profil_picture_public_entity.png',
  'banner_picture' => '/img/default_banner_picture_public_entity.png'
]);
$public_entity2_id = $db->insert('public_entity', [
  'title' => 'user 2',
  'description' => 'I am the user 2',
  'profil_picture' => '/img/default_profil_picture_public_entity.png',
  'banner_picture' => '/img/default_banner_picture_public_entity.png'
]);
$public_entity3_id = $db->insert('public_entity', [
  'title' => 'user 3',
  'description' => 'I am the user 3',
  'profil_picture' => '/img/default_profil_picture_public_entity.png',
  'banner_picture' => '/img/default_banner_picture_public_entity.png'
]);
$public_entity4_id = $db->insert('public_entity', [
  'title' => 'user 4',
  'description' => 'I am the user 4',
  'profil_picture' => '/img/default_profil_picture_public_entity.png',
  'banner_picture' => '/img/default_banner_picture_public_entity.png'
]);
$public_entity5_id = $db->insert('public_entity', [
  'title' => 'user 5',
  'description' => 'I am the user 5',
  'profil_picture' => '/img/default_profil_picture_public_entity.png',
  'banner_picture' => '/img/default_banner_picture_public_entity.png'
]);
$public_entity6_id = $db->insert('public_entity', [
  'title' => 'user 6',
  'description' => 'I am the user 6',
  'profil_picture' => '/img/default_profil_picture_public_entity.png',
  'banner_picture' => '/img/default_banner_picture_public_entity.png'
]);


// USER
$user1_id = $db->insert('user', [
  'public_entity_id' => $public_entity1_id,
  'password_hash' => 'g9gf89FJIhfg4',
  'confidence_level' => 1
]);
$user2_id = $db->insert('user', [
  'public_entity_id' => $public_entity2_id,
  'password_hash' => 'g9gf89FJIhfg4312',
  'confidence_level' => 2
]);
$user3_id = $db->insert('user', [
  'public_entity_id' => $public_entity3_id,
  'password_hash' => 'g9gf32189FJIhfg4312',
  'confidence_level' => 4
]);
$user4_id = $db->insert('user', [
  'public_entity_id' => $public_entity4_id,
  'password_hash' => 'g9gf32189FJIhfg4312',
  'confidence_level' => 4
]);
$user5_id = $db->insert('user', [
  'public_entity_id' => $public_entity5_id,
  'password_hash' => 'gfgdsg2456456543',
  'confidence_level' => 4
]);
$user6_id = $db->insert('user', [
  'public_entity_id' => $public_entity6_id,
  'password_hash' => 'gfgd54323',
  'confidence_level' => 3
]);


// PUBLIC ENTITY ADMIN
$public_entity1_admin_id = $db->insert('public_entity_admin', [
  'user_id' => $user1_id,
  'public_entity_id' => $public_entity1_id,
  'is_public' => 1
]);
$public_entity2_admin_id = $db->insert('public_entity_admin', [
  'user_id' => $user2_id,
  'public_entity_id' => $public_entity2_id,
  'is_public' => 1
]);
$public_entity3_admin_id = $db->insert('public_entity_admin', [
  'user_id' => $user3_id,
  'public_entity_id' => $public_entity3_id,
  'is_public' => 1
]);
$public_entity4_admin_id = $db->insert('public_entity_admin', [
  'user_id' => $user4_id,
  'public_entity_id' => $public_entity4_id,
  'is_public' => 1
]);
$public_entity5_admin_id = $db->insert('public_entity_admin', [
  'user_id' => $user5_id,
  'public_entity_id' => $public_entity5_id,
  'is_public' => 1
]);
$public_entity6_admin_id = $db->insert('public_entity_admin', [
  'user_id' => $user6_id,
  'public_entity_id' => $public_entity6_id,
  'is_public' => 1
]);

// PUBLIC ENTITY USER
$public_entity1_user_id = $db->insert('public_entity_user', [
  'user_id' => $user1_id,
  'public_entity_id' => $public_entity1_id,
  'is_public' => 1,
  'percent' => 100,
]);
$public_entity2_user_id = $db->insert('public_entity_user', [
  'user_id' => $user2_id,
  'public_entity_id' => $public_entity2_id,
  'is_public' => 1,
  'percent' => 100,
]);
$public_entity3_user_id = $db->insert('public_entity_user', [
  'user_id' => $user3_id,
  'public_entity_id' => $public_entity3_id,
  'is_public' => 1,
  'percent' => 100,
]);
$public_entity4_user_id = $db->insert('public_entity_user', [
  'user_id' => $user4_id,
  'public_entity_id' => $public_entity4_id,
  'is_public' => 1,
  'percent' => 100,
]);
$public_entity5_user_id = $db->insert('public_entity_user', [
  'user_id' => $user5_id,
  'public_entity_id' => $public_entity5_id,
  'is_public' => 1,
  'percent' => 100,
]);
$public_entity6_user_id = $db->insert('public_entity_user', [
  'user_id' => $user6_id,
  'public_entity_id' => $public_entity6_id,
  'is_public' => 1,
  'percent' => 100,
]);



// GROUP
$group_anonymous_id = $db->insert('group', [
  'title' => 'main group',
  'description' => 'main group'
]);


// DEBATE
$debate1_id = $db->insert('debate', [
  'user_id' => $user1_id,
  'public_entity_id' => $public_entity1_id,
  'group_id' => $group_anonymous_id,
  'is_public' => 1,
  'title' => 'Initiative pour les vaches à cornes',
  'description' => "L’initiative populaire « Pour la dignité des animaux de rente agricoles (initiative pour les vaches à cornes) » a été déposée en 2016 par la communauté d’intérêts en faveur des vaches à cornes. Elle vise à augmenter de nouveau le nombre de vaches et de chèvres à cornes dans l’agriculture. Elle veut éviter que les agriculteurs choisissent d’élever des animaux sans cornes pour des motifs purement économiques. L’élevage d’animaux à cornes entraînant des coûts plus élevés, la Confédération devrait soutenir financièrement les détenteurs de vaches, de taureaux reproducteurs, de chèvres et de boucs reproducteurs, tant que les animaux adultes portent leurs cornes. Écorner les jeunes animaux sous anesthésie locale resterait autorisé."
]);
$debate2_id = $db->insert('debate', [
  'user_id' => $user2_id,
  'public_entity_id' => $public_entity2_id,
  'group_id' => $group_anonymous_id,
  'is_public' => 0,
  'title' => 'second debate title',
  'description' => 'seconde debate description'
]);


// DEBATE VOTE
$debate_vote1_id = $db->insert('debate_vote', [
  'user_id' => $user1_id,
  'debate_id' => $debate1_id,
  'public_entity_id' => $public_entity1_id,
  'side' => 1
]);
$debate_vote2_id = $db->insert('debate_vote', [
  'user_id' => $user2_id,
  'debate_id' => $debate1_id,
  'public_entity_id' => $public_entity2_id,
  'side' => -1
]);
$debate_vote3_id = $db->insert('debate_vote', [
  'user_id' => $user3_id,
  'debate_id' => $debate1_id,
  'public_entity_id' => $public_entity3_id,
  'side' => 1
]);
$debate_vote4_id = $db->insert('debate_vote', [
  'user_id' => $user4_id,
  'debate_id' => $debate1_id,
  'public_entity_id' => $public_entity4_id,
  'side' => 0
]);
$debate_vote5_id = $db->insert('debate_vote', [
  'user_id' => $user5_id,
  'debate_id' => $debate1_id,
  'public_entity_id' => $public_entity5_id,
  'side' => 0
]);
$debate_vote6_id = $db->insert('debate_vote', [
  'user_id' => $user6_id,
  'debate_id' => $debate1_id,
  'public_entity_id' => $public_entity6_id,
  'side' => 1
]);


// DEBATE ARGUMENT
$argument1_id = $db->insert('argument', [
  'user_id' => $user1_id,
  'debate_id' => $debate1_id,
  'public_entity_id' => $public_entity1_id,
  'group_id' => $group_anonymous_id,
  'side' => 1,
  'parent_argument_id' => 0,
  'is_public' => 1,
  'title' => 'Un petit ajout à la Constitution',
  'description' => "L’initiative ne fait qu’ajouter une phrase courte et claire à l’article 104, alinéa 3, lettre b, de la Constitution : « (...) ce faisant, elle [la Confédération] veille en particulier à ce que les détenteurs de vaches, de taureaux reproducteurs, de chèvres et de boucs reproducteurs soient soutenus financièrement tant que les animaux adultes portent leurs cornes. » Cet ajout a été rendu nécessaire par le fait que rien n’a bougé jusqu’ici et que notre projet de loi n’a pas été accepté."
]);
$argument2_id = $db->insert('argument', [
  'user_id' => $user2_id,
  'debate_id' => $debate1_id,
  'public_entity_id' => $public_entity2_id,
  'group_id' => $group_anonymous_id,
  'side' => 1,
  'parent_argument_id' => 0,
  'is_public' => 1,
  'title' => "Pas d’interdiction – la liberté de choix",
  'description' => "Pour y remédier, il faut compenser équitablement les dépenses supplémentaires dues à l’élevage de bovins ou de caprins avec leurs cornes. Il ne s’agit pas d’une interdiction de l’écornage, mais d’une incitation qui laisse le libre choix à l’éleveur. Nous avons dû faire huit ans de démarches administratives pour en arriver là. Et en fin de compte, nous avons déposé une initiative avec 119 626 signatures valables."
]);
$argument3_id = $db->insert('argument', [
  'user_id' => $user3_id,
  'debate_id' => $debate1_id,
  'public_entity_id' => $public_entity3_id,
  'group_id' => $group_anonymous_id,
  'side' => 0,
  'parent_argument_id' => 0,
  'is_public' => 1,
  'title' => 'La neutralité est primordiale!',
  'description' => "La Suisse est neutre et mon opinion dans ce débat l'est tout autant. Je ne m'abaisserai point à choisir un camps, quand bien même il s'agit de décider de l'existance des cornes de nos bovins bien aimés ;)"
]);
$argument4_id = $db->insert('argument', [
  'user_id' => $user4_id,
  'debate_id' => $debate1_id,
  'public_entity_id' => $public_entity4_id,
  'group_id' => $group_anonymous_id,
  'side' => -1,
  'parent_argument_id' => 0,
  'is_public' => 1,
  'title' => 'Responsabilité entrepreneuriale',
  'description' => "C’est l’agriculteur lui-même qui est le mieux placé pour décider s’il veut détenir des animaux avec ou sans cornes. C’est lui qui connaît le mieux les animaux et la place disponible. La Confédération n’a pas à restreindre sa liberté entrepreneuriale en lui offrant une contribution pour la détention de vaches ou de chèvres portant leurs cornes. Ce serait aller à l’encontre de la politique agricole, qui vise à renforcer l’autodétermination entrepreneuriale des agriculteurs."
]);
