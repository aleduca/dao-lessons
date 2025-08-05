<?php

use app\database\dao\UserDao;

require '../vendor/autoload.php';

$userDao = new UserDao;
$user = $userDao->findById(8);
$user->firstName = 'Alexandre';
$user->lastName = 'Cardoso';
$user->email = 'email@email.com.br';

$userDao->update($user);

dd($user);
