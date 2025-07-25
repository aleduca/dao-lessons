<?php

namespace core\database;

class EntityMapper
{
  public function mapToEntity(string $entity, array $data)
  {
    if ($this->isSingleArray($data)) {
      return new $entity(function ($entityInstance) use ($data) {
        $entityInstance->normalizer($data);
      });
    }

    return array_map(function ($data) use ($entity) {
      return new $entity(function ($entityInstance) use ($data) {
        $entityInstance->normalizer($data);
      });
    }, $data);
  }

  private function isSingleArray(array $data): bool
  {
    return !isset($data[0]);
  }
}
