<?php

declare(strict_types=1);

namespace App;

loadClass("src/Exceptions/RouteNotFoundException");

class Router
{
  private array $routes;

  public function register(string $route, callable|array $action): self
  {
    $this->routes[$route] = $action;

    return $this;
  }

  // Parse the request URI and call the appropriate action
  public function resolve(string $uri)
  {
    $route = explode("?", $uri)[0];
    $action = $this->routes[$route] ?? null;

    if (is_callable($action)) {
      // If there is a return value, return it
      return call_user_func($action);
    }

    if (is_array($action)) {
      [$class, $method] = $action;

      if (class_exists($class)) {
        $class = new $class();

        if (method_exists($class, $method)) {
          // Specifying the arguments is better than passing individual arguments
          return call_user_func_array([$class, $method], []);
        }
      }
    }

    http_response_code(404);
    throw new Exceptions\RouteNotFoundException();
  }
}
