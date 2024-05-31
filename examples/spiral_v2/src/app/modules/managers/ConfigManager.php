<?php

declare(strict_types=1);

load("interface", "ConfigManagerInterface");

/**
 * 設定変数を操作・管理するためのクラス
 * 
 * @implements ConfigManagerInterface
 */
class ConfigManager implements ConfigManagerInterface
{
  private static array $config;

  public static function load(array $config): void
  {
    self::$config = $config;
  }

  public static function get_db_id(string $db): string
  {
    if (!isset(self::$config["db"][$db])) {
      throw new InvalidArgumentException("DB ID is NOT found");
    }

    return self::$config["db"][$db];
  }

  public static function get_page_id(string ...$keys): string
  {
    $current = self::$config["page"];

    foreach ($keys as $key) {
      if (is_array($current) && isset($current[$key])) {
        $current = $current[$key];
      } else {
        throw new InvalidArgumentException("Page ID is NOT found");
      }
    }

    return $current;
  }

  public static function get_asset_path(string $type): string
  {
    if (!isset(self::$config["path"]["asset"][$type])) {
      throw new InvalidArgumentException("Asset path is NOT found");
    }

    return self::$config["path"]["asset"][$type];
  }
}
