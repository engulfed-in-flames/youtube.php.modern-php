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
  ->get("/", [App\Classes\Home::class, "index"])
  ->get("/invoices", [App\Classes\Invoice::class, "index"])
  ->get("/invoices/create", [App\Classes\Invoice::class, "create"])
  ->post("/invoices/create", [App\Classes\Invoice::class, "store"]);

// session_start must be called before any output (including rendering).
// If output_buffering turned on in php.ini, some cases will work without calling session_start. 
// By default, output_buffering must be turned off.

// session_start() create a new session or resume the existing session.
// You can check session id in Application's Cookies tab. 
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

echo $router->resolve($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);
