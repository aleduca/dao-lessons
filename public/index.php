<?php

use app\database\dao\UserDao;
use app\database\entities\UserEntity;

require '../vendor/autoload.php';

$userDao = new UserDao;
$user = $userDao->findById(8);
dd($user);


dd($userEntity->getCreated_at()->format('d/m/Y H:i:s'));
