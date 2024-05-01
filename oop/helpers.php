<?php
function loadApp(string $file = ""): void
{
  $filePath = buildDirPath("app") . $file . ".php";
  $errorMessage = "App file NOT found : {$filePath}";
  requireFile($filePath, [], $errorMessage);
}

function loadConfig(string $file = ""): void
{
  $filePath = buildDirPath("app", "config") . $file . ".php";
  $errorMessage = "Config file NOT found : {$filePath}";
  requireFile($filePath, [], $errorMessage);
};

function loadView(string $file = "", array $data = []): void
{
  $filePath = buildDirPath("app", "views") . $file . ".php";
  $errorMessage = "View file NOT found : {$filePath}";
  requireFile($filePath, $data, $errorMessage);
};

function buildDirPath(string ...$dirs): string
{
  $root = __DIR__;
  array_unshift($dirs, $root);
  $dirPath = implode(DIRECTORY_SEPARATOR, $dirs) . DIRECTORY_SEPARATOR;
  // `realpath` prevents directory traversal attack.
  return realpath($dirPath) ? realpath($dirPath) . DIRECTORY_SEPARATOR : $dirPath;
}

function requireFile(string $filePath, array $data = [], string $errorMessage = "File NOT found"): void
{
  if (file_exists($filePath)) {
    extract($data);
    require_once $filePath;
  } else {
    throw new Exception("{$errorMessage} : {$filePath}");
  }
}

function formatDollarAmount(int|float $amount): string
{
  $isNegative = $amount < 0;
  return ($isNegative ? "-" : "") . "$" . number_format(abs($amount), 2);
}

function  formatDate(string $date): string
{
  return date("M j, Y", strtotime($date));
}

function inspect(mixed $data): void
{
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}
