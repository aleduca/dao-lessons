<?php

namespace core\database;

use core\database\entities\AbstractEntity;

/**
 * @template TEntity of AbstractEntity
 */
class EntityManager
{
  /**
   * @param class-string<TEntity> $entity
   * @param array $data
   * @return TEntity|TEntity[]
   */
  public function mapToEntity(string $entity, array $data)
  {
    if ($this->isSingleArray($data)) {
      return new $entity(function ($entityInstance) use ($data) {
        /** @var AbstractEntity $entityInstance */
        $entityInstance->normalizeArrayToEntity($data);
      });
    }

    return array_map(function ($data) use ($entity) {
      return new $entity(function ($entityInstance) use ($data) {
        /** @var AbstractEntity $entityInstance */
        $entityInstance->normalizeArrayToEntity($data);
      });
    }, $data);
  }

  /**
   * @param array $data
   * @return bool
   */
  private function isSingleArray(array $data): bool
  {
    return !isset($data[0]);
  }

  /**
   * @param TEntity|array $arrayOrEntity
   * @return array
   */
  public function normalizeDataToArray(AbstractEntity|array $arrayOrEntity): array
  {
    if ($arrayOrEntity instanceof AbstractEntity) {
      return $arrayOrEntity->entityToArray();
    }
    if (isset($arrayOrEntity['password'])) {
      $arrayOrEntity['password'] = password_hash($arrayOrEntity['password'], PASSWORD_DEFAULT);
    }
    return $arrayOrEntity;
  }
}
