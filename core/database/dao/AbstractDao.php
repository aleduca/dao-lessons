<?php

namespace core\database\dao;

use core\database\Connection;
use core\database\entities\AbstractEntity;
use core\database\EntityMapper;
use PDO;

/**
 * @template TEntity of AbstractEntity
 */
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

  /**
   * @return TEntity[]|null
   */
  public function findAll(string $fields = '*'): ?array
  {
    $sql = "SELECT {$fields} from {$this->table}";
    $select = $this->connection->query($sql);
    $data = $select->fetchAll();
    return $this->entityMapper->mapToEntity($this->entity, $data);
  }

  /**
   * @return TEntity|null
   */
  public function findBy(string $field, mixed $value, string $fields = '*'): ?AbstractEntity
  {
    $sql = "SELECT {$fields} from {$this->table} where {$field} = :{$field}";
    $prepare = $this->connection->prepare($sql);
    $prepare->execute([
      $field => $value
    ]);
    $data = $prepare->fetch();

    if (!$data) {
      return null;
    }

    return $this->entityMapper->mapToEntity($this->entity, $data);
  }

  /**
   * @return TEntity|null
   */
  public function findById(int $id, string $fields = '*'): ?AbstractEntity
  {
    return $this->findBy('id', $id, $fields);
  }

  private function toArray(AbstractEntity|array $arrayOrEntity)
  {
    if ($arrayOrEntity instanceof AbstractEntity) {
      return $arrayOrEntity->toArray();
    }
    $arrayOrEntity['password'] = password_hash($arrayOrEntity['password'], PASSWORD_DEFAULT);
    return $arrayOrEntity;
  }

  public function insert(AbstractEntity|array $arrayOrEntity): AbstractEntity
  {
    $data = $this->toArray($arrayOrEntity);
    $fields = implode(',', array_keys($data));
    $placeholders = ':' . implode(',:', array_keys($data));
    $sql = "INSERT into {$this->table}({$fields}) values({$placeholders})";
    $prepare = $this->connection->prepare($sql);
    $prepare->execute($data);

    $lastInsertedId = $this->connection->lastInsertId();

    return $this->findById($lastInsertedId);
  }
}
