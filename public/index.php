<?php

use app\database\dao\UserDao;

require '../vendor/autoload.php';

$userDao = new UserDao;
$user = $userDao->findById(341);

$updated = $userDao->delete($user);

dd($updated);
