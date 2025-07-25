<?php

namespace core\database\dao;

use core\database\Connection;
use core\database\entities\AbstractEntity;
use core\database\EntityMapper;
use PDO;

abstract class AbstractDao
{
  protected PDO $connection;
  protected string $table;
  protected string $entity;
  protected EntityMapper $entityMapper;

  public function __construct()
  {
    $this->connection = Connection::getConnection();
    $this->entityMapper = new EntityMapper;
  }

  public function findAll(string $fields = '*'): ?array
  {
    $sql = "SELECT {$fields} from {$this->table}";
    $select = $this->connection->query($sql);
    $data = $select->fetchAll();
    return $this->entityMapper->mapToEntity($this->entity, $data);
  }

  public function findBy(string $field, mixed $value, string $fields = '*'): ?AbstractEntity
  {
    $sql = "SELECT {$fields} from {$this->table} where {$field} = :{$field}";
    $prepare = $this->connection->prepare($sql);
    $prepare->execute([
      $field => $value
    ]);
    $data = $prepare->fetch();
    return $this->entityMapper->mapToEntity($this->entity, $data);
  }

  public function findById(int $id, string $fields = '*'): ?AbstractEntity
  {
    return $this->findBy('id', $id, $fields);
  }
}
