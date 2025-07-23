<?php

namespace core\database\dao;

use core\database\Connection;
use PDO;

abstract class AbstractDao
{
  protected PDO $connection;
  protected string $table;
  protected string $entity;

  public function __construct()
  {
    $this->connection = Connection::getConnection();
  }
}
