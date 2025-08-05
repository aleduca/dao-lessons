<?php

namespace core\database\dao;

use core\database\Connection;
use core\database\entities\AbstractEntity;
use core\database\EntityManager;
use Exception;
use PDO;

/**
 * @template TEntity of AbstractEntity
 */
abstract class AbstractDao
{
  protected PDO $connection;
  protected string $table;
  protected string $entity;
  protected EntityManager $entityManager;

  public function __construct()
  {
    $this->connection = Connection::getConnection();
    $this->entityManager = new EntityManager;
  }

  /**
   * @return TEntity[]|null
   */
  public function findAll(string $fields = '*'): ?array
  {
    $sql = "SELECT {$fields} from {$this->table}";
    $select = $this->connection->query($sql);
    $data = $select->fetchAll();
    return $this->entityManager->mapToEntity($this->entity, $data);
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

    $entity = $this->entityManager->mapToEntity($this->entity, $data);

    $this->entityManager->snapshotEntityManager->takeSnapshot($entity);

    return $entity;
  }

  /**
   * @return TEntity|null
   */
  public function findById(int $id, string $fields = '*'): ?AbstractEntity
  {
    return $this->findBy('id', $id, $fields);
  }

  public function insert(AbstractEntity|array $arrayOrEntity): AbstractEntity
  {
    $data = $this->entityManager->normalizeDataToArray($arrayOrEntity);

    $fields = implode(',', array_keys($data));
    $placeholders = ':' . implode(',:', array_keys($data));
    $sql = "INSERT into {$this->table}({$fields}) values({$placeholders})";
    $prepare = $this->connection->prepare($sql);
    $prepare->execute($data);

    $lastInsertedId = $this->connection->lastInsertId();

    return $this->findById($lastInsertedId);
  }

  public function update(AbstractEntity $entity)
  {
    if (!$this->entityManager->snapshotEntityManager->snapshotTaken()) {
      throw new Exception('To update use find method');
    }

    $properties = $this->entityManager->snapshotEntityManager->propertiesChanged($entity);
    dd($properties);
  }
}
