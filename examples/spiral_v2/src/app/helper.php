<?php
//  参考
//  クラスの読み込みと例外処理について
// 
//  PHPのAutoloadとは、クラスと該当するファイルの読み込み自動的に行う機能です。
//  Autoload機能はPHPにて基本の中で基本ですが、SpiralではAutoload機能の使用を禁止しております。
//  Autoloadの代わりに、ここでは自作関数を使用してクラスの読み込みを行います。
//  念頭に置くべきことは、元々Autoload機能用いてクラス読み込みに失敗した時、絶対に例外処理をしてはいけません。
//  詳しくは、以下のリンクを参照してください。
// 
//  link: https://www.php-fig.org/psr/psr-4/

/**
 * 環境に応じた環境変数を取得する。
 * 
 * @param string $env 環境 (dev, prod)
 * @return array $config
 */
function get_config($env)
{
  $cleanEnv = strtolower($env);
  $path = __DIR__ . "/config/config." . $cleanEnv . ".php";

  if (!file_exists($path)) {
    throw new LogicException("The {$cleanEnv} config file is NOT found.");
  }

  $config = require $path;

  return $config;
}

/**
 * クラスを読み込む
 * 
 * @param string $type クラスの種類 (module, library, abstract, interface, exception)
 * @param string $class クラス名
 * @return void
 * @throws LogicException
 */
function load($type, $class)
{
  $path = process_path($type, $class);

  if (!file_exists($path)) {
    throw new LogicException("The {$type} '{$class}' is NOT found.");
  }

  require_once $path;
}

/**
 * クラスのパスを生成する。
 * 
 * @param string $type クラスの種類 (module, library, abstract, interface, exception)
 * @param string $class クラス名
 * @return string
 * @throws LogicException
 */
function process_path($type, $class)
{
  $clean_type = strtolower($type);
  $clean_class = ucfirst($class);

  return match ($clean_type) {
    "module" => __DIR__ . "/modules/" . $clean_class . ".php",
    "manager" => __DIR__ . "/modules/managers/" . $clean_class . ".php",
    "library" => __DIR__ . "/libraries/" . $clean_class . ".php",
    "exception" => __DIR__ . "/exceptions/" . $clean_class . ".php",
    "trait" => __DIR__ . "/traits/" . $clean_class . ".php",
    "abstract" => __DIR__ . "/abstracts/" . $clean_class . ".php",
    "interface" => __DIR__ . "/interfaces/" . $clean_class . ".php",
    default => throw new LogicException("The type '{$type}' is NOT found."),
  };
}

function inspect(mixed $data): void
{
  echo "<pre>";
  var_dump($data);
  echo "</pre>";
}
