<?php

use app\database\dao\UserDao;

require '../vendor/autoload.php';

$userDao = new UserDao;
$user = $userDao->findById(8, 'firstName,lastName,email');

dd($user);
