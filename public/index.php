<?php

use app\database\dao\UserDao;

require '../vendor/autoload.php';

$userDao = new UserDao;
$user = $userDao->findById(14);
$user->firstName = 'Alexandre';
$user->lastName = 'Cardoso';
$user->email = 'email2@email.com.br';

$updated = $userDao->update($user);

dd($updated);
