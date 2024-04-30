<?php

// MAGIC METHOD

namespace App\Invoice;

use BadMethodCallException;
use Exception;

/**
 * @property-read  $amount
 */
class Invoice
{
  public function __construct(
    private float $amout
  ) {
  }

  /** @throws Exception Cannot allow to set class member outside the class */
  public function __set(string $prop, mixed $value): void
  {
    throw new BadMethodCallException("NOT allowed method ('" . __FUNCTION__ . "')");
  }

  // Called when class methods are executed
  public function __call(string $method, array $args)
  {
    if (method_exists($this, $method)) {
      call_user_func_array([$this, $method], $args);

      return;
    }
    throw new BadMethodCallException("The method '" . $method . "' does NOT exist");
  }

  // Call when static methods are executed
  public static function __callStatic(string $method, array $args)
  {
    if (method_exists(static::class, $method)) {
      call_user_func_array([static::class, $method], $args);

      return;
    }
    throw new BadMethodCallException("The static method '" . $method . "' does NOT exist");
  }
}

class ProcessInvoice
{
  public function __invoke()
  {
    echo "For keeping single responsibility principle";
    // It makes sense when the class has only single feature.
  }
}
