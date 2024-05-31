<?php

interface SessionManagerInterface
{
  public static function start(): void;
  public static function has(string $key): bool;
  public static function get(string $key): mixed;
  public static function set(string $key, mixed $value): void;
  public static function remove(string $key): void;
  public static function clear(): void;
}
