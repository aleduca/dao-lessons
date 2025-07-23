<?php

namespace core\database;

use PDO;

class Connection
{
  public static function getConnection(): PDO
  {
    return new PDO(
      'mysql:host=localhost;dbname=blog_ci;charset=utf8mb4',
      'root',
      '',
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]
    );
  }
}
