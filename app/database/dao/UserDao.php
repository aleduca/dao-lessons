<?php

namespace app\database\dao;

use app\database\entities\UserEntity;
use core\database\dao\AbstractDao;

class UserDao extends AbstractDao
{
  protected string $table = 'users';
  protected string $entity = UserEntity::class;
}
