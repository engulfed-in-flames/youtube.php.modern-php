<?php
function loadApp(): void
{
  $file = "App";
  $filePath = buildFilePath("app", $file);
  $errorMessage = "File NOT found : {$filePath}";

  requireFile($filePath, [], $errorMessage);
}

function buildFilePath(string $type, string $file): string
{
  $folders = [
    "view" => "views",
    "config" => "config",
    "app" => "app",
  ];

  if (!array_key_exists($type, $folders)) {
    throw new InvalidArgumentException("Folder type {$type} doesn't exist.");
  }

  $folderName = $folders[$type];
  return buildDirPath("app", $folderName) . DIRECTORY_SEPARATOR . $file . ".php";
}

function buildDirPath(string ...$dirs): string
{
  $root = __DIR__;
  array_unshift($dirs, $root);
  $dirPath = implode(DIRECTORY_SEPARATOR, $dirs);
  // `realpath` prevents directory traversal attack.
  return realpath($dirPath) ? realpath($dirPath) . DIRECTORY_SEPARATOR : $dirPath;
}

function includeFile(string $filePath, array $data = [], string $errorMessage = "File Not Found"): void
{
  if (!file_exists($filePath)) return;

  extract($data);
  include_once $filePath;
}

function requireFile(string $filePath, array $data = [], string $errorMessage = "File NOT found"): void
{
  if (!file_exists($filePath)) {
    throw new RuntimeException("{$errorMessage} : {$filePath}");
  }

  extract($data);
  require_once $filePath;
}
function inspect(mixed $data): void
{
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}
