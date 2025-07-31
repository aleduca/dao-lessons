<?php

use app\database\dao\UserDao;
use app\database\entities\UserEntity;

require '../vendor/autoload.php';

$userEntity = new UserEntity();
$userEntity->firstName = 'Alexandre';
$userEntity->lastName = 'Cardoso';
$userEntity->email = 'email9@email.com.br';
$userEntity->password = '123';

$userDao = new UserDao;
$created = $userDao->insert($userEntity);

dd($created);
