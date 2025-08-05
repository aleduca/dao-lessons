<?php

namespace core\database;

use core\database\entities\AbstractEntity;
use ReflectionClass;

class SnapshotEntityManager
{
  protected array $snapshot = [];

  public function takeSnapshot(AbstractEntity $entity)
  {
    $reflectionClas = new ReflectionClass($entity);
    $properties = $reflectionClas->getProperties();
    foreach ($properties as $property) {
      $name = $property->getName();
      $value = $property->getValue($entity);
      $this->snapshot[$name] = $value;
    }
  }

  public function propertiesChanged(AbstractEntity $entity)
  {
    $propertiesChanged = [];

    foreach ($this->snapshot as $property => $oldValue) {
      if (!property_exists($entity, $property) || $property === 'id') {
        continue;
      }

      $newValue = $entity->{$property};

      if ($oldValue !== $newValue) {
        $propertiesChanged[$property] = $newValue;
      }
    }

    return $propertiesChanged;
  }

  public function clearSnapshot()
  {
    $this->snapshot = [];
  }

  public function getSnapshot()
  {
    return $this->snapshot;
  }

  public function snapshotTaken(): bool
  {
    return !empty($this->snapshot);
  }
}
