<?php

require_once dirname(__DIR__) . "/helper.php";

spl_autoload_register(function ($class) {
  $baseDir = dirname(__DIR__);
  $path = $baseDir . DIRECTORY_SEPARATOR . lcfirst(str_replace("\\", "/", $class)) . ".php";

  if (file_exists($path)) {
    require_once $path;
  }
});

$router = new App\Router();

// $router->register("/", function () {
//   echo "Home";
// });

$router
  ->register("/", [App\Classes\Home::class, "index"])
  ->register("/invoices", [App\Classes\Invoice::class, "index"])
  ->register("/invoices/create", [App\Classes\Invoice::class, "create"]);

echo $router->resolve($_SERVER["REQUEST_URI"]);
