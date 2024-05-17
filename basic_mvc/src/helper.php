<?php

/**
 * @param string $path "path/to/view/from/root" without ".php"
 * @return void
 */
function load($path)
{
  $cleanPath = str_replace("\\", DIRECTORY_SEPARATOR, $path);
  $fullPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . $cleanPath . ".php");

  if (file_exists($fullPath)) {
    require_once $fullPath;
  }
}

function inspect(mixed $data): void
{
  echo "<pre>";
  var_dump($data);
  echo "</pre>";
}
