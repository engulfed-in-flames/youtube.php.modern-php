<?php

declare(strict_types=1);

load("interface", "SessionManagerInterface");

/**
 * セッション操作用のカスタムハンドラー
 * 
 * PHPビルトイン`SessionHanlder`とは完全に異なるカスタムセッションハンドラーです。
 * SprialにてPHPビルトイン`SessionHanlder`の使用を禁止されています。
 * 
 * @implements SessionManagerInterface
 */
class SessionManager implements SessionManagerInterface
{
  /** セッションを開始 */
  public static function start(): void
  {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }
  }

  /** セッションのキーが存在、かつ、その値が`null`でなければ、`true`を返す */
  public static function has(string $key): bool
  {
    return isset($_SESSION[$key]);
  }

  /** セッションの値を取得 */
  public static function get(string $key): mixed
  {
    return self::has($key) ? $_SESSION[$key] : null;
  }

  /** セッションにキー値を設定 */
  public static function set(string $key, mixed $value): void
  {
    $_SESSION[$key] = $value;
  }

  /** セッションからキー値を削除 */
  public static function remove(string $key): void
  {
    unset($_SESSION[$key]);
  }

  /** セッションを初期化 */
  public static function clear(): void
  {
    $_SESSION = [];
  }
}
