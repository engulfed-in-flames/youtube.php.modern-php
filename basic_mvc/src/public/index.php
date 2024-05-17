<?php

use App\Exceptions\RouteNotFoundException;
use App\View;

require_once dirname(__DIR__) . "/helper.php";

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

define("STORAGE_PATH", __DIR__ . "/../storage");
define("VIEW_PATH", __DIR__ . "/../views");

spl_autoload_register(function ($class) {
  $baseDir = dirname(__DIR__);
  $path = $baseDir . DIRECTORY_SEPARATOR . lcfirst(str_replace("\\", "/", $class)) . ".php";

  if (file_exists($path)) {
    require_once $path;
  }
});

try {
  $router = new App\Router();

  // $router->register("/", function () {
  //   echo "Home";
  // });

  $router
    ->get("/", [App\Controllers\HomeController::class, "index"])
    ->get("/download", [App\Controllers\HomeController::class, "download"])
    ->post("/upload", [App\Controllers\HomeController::class, "upload"])
    ->get("/invoices", [App\Controllers\InvoiceController::class, "index"])
    ->get("/invoices/create", [App\Controllers\InvoiceController::class, "create"])
    ->post("/invoices/create", [App\Controllers\InvoiceController::class, "store"]);

  // session_start must be called before any output (including rendering).
  // If output_buffering turned on in php.ini, some cases will work without calling session_start. 
  // By default, output_buffering must be turned off.

  // session_start() create a new session or resume the existing session.
  // You can check session id in Application's Cookies tab. 

  echo $router->resolve($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);
} catch (RouteNotFoundException) {
  // HTTP Header must be sent before any output.
  // header("HTTP/1.1 404 Not Found");
  http_response_code(404);

  echo View::make("error/404");
}
