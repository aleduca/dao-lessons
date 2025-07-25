<?php

use app\database\dao\UserDao;

require '../vendor/autoload.php';

$userDao = new UserDao;
$user = $userDao->findAll();

dd($user);
