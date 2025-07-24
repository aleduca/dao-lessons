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

  public function findAll(string $fields = '*'): array
  {
    $sql = "SELECT {$fields} from {$this->table}";
    $select = $this->connection->query($sql);
    return $select->fetchAll();
  }

  public function findBy(string $field, mixed $value, string $fields = '*'): array
  {
    $sql = "SELECT {$fields} from {$this->table} where {$field} = :{$field}";
    $prepare = $this->connection->prepare($sql);
    $prepare->execute([
      $field => $value
    ]);
    return $prepare->fetch();
  }

  public function findById(int $id, string $fields = '*')
  {
    return $this->findBy('id', $id, $fields);
  }
}
