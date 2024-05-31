<?php

interface ConfigManagerInterface
{
  public static function load(array $config): void;
  public static function get_db_id(string $db): string;
  public static function get_page_id(string ...$keys): string;
  public static function get_asset_path(string $type): string;
}
