<?php

namespace core\database\entities;

use DateTimeImmutable;

abstract class AbstractEntity
{
  public function __construct(?callable $callback = null)
  {
    if (!is_null($callback)) {
      $callback($this);
    }
  }

  public function normalizer(array $data)
  {
    foreach ($data as $property => $value) {
      if (property_exists($this, $property)) {
        if (in_array($property, ['created_at', 'updated_at'])) {
          $value = new DateTimeImmutable($value);
        }
        $method = 'set' . ucfirst($property);
        $this->{$method}($value);
      }
    }
  }
}
