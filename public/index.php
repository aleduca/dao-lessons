<?php

use app\database\dao\UserDao;
use app\database\entities\UserEntity;

require '../vendor/autoload.php';

$userDao = new UserDao;
$user = $userDao->findAll();

$userEntity = new UserEntity();
$userEntity->setFirstName('alexandre');
$userEntity->created_at = new DateTimeImmutable();

dd($userEntity->getCreated_at()->format('d/m/Y H:i:s'));
