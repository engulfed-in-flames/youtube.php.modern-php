<?php

declare(strict_types=1);

namespace Database;

// 1. Database with singleton pattern
// 2. ✅ DI is the best way to implement class.
// 3. If you want to class creator, then use factory class pattern.
class Database
{
  public static ?Database $instance = null;

  // Cannot directly initiate instance
  private function __construct(public array $config)
  {
  }

  public static function getInstance(array $config): self
  {
    if (self::$instance === null) {
      self::$instance = new Database($config);
    }

    return self::$instance;
  }
}
