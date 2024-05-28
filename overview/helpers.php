<?php
function loadApp(): void
{
  $file = "App";
  $filePath = buildFilePath("app", $file);
  $errorMessage = "File NOT found : {$filePath}";

  requireFile($filePath, [], $errorMessage);
}

function loadConfig(): void
{
  $file = "config";
  $filePath = buildFilePath("config", $file);
  $errorMessage = "Config NOT found : {$filePath}";

  requireFile($filePath, [], $errorMessage);
};

function loadView(string $file, array $data = []): void
{
  $filePath = buildFilePath("view", $file);
  $errorMessage = "View NOT found : {$filePath}";

  requireFile($filePath, $data, $errorMessage);
};

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

function formatDollarAmount(int|float $amount): string
{
  $isNegative = $amount < 0;
  return ($isNegative ? "-" : "") . "$" . number_format(abs($amount), 2);
}

function formatDate(string $date): string
{
  return date("M j, Y", strtotime($date));
}

function inspect(mixed $data): void
{
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}
