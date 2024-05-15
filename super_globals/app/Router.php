<?php

declare(strict_types=1);

namespace App;

loadClass("src/Exceptions/RouteNotFoundException");

class Router
{
  private array $routes;

  public function register(string $route, callable|array $action, string $method): self
  {
    $lcMethod = strtolower($method);
    $this->routes[$lcMethod][$route] = $action;

    return $this;
  }

  public function get(string $route, callable|array $action): self
  {
    return $this->register($route, $action, "get");
  }

  public function post(string $route, callable|array $action): self
  {
    return $this->register($route, $action, "post");
  }
  // Parse the request URI and call the appropriate action
  public function resolve(string $requestUri, string $requestMethod)
  {
    $lcRequestMethod = strtolower($requestMethod);
    $route = explode("?", $requestUri)[0];
    $action = $this->routes[$lcRequestMethod][$route] ?? null;

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
