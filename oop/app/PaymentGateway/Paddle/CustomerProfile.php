<?php

declare(strict_types=1);

namespace PaymentGateway\Paddle;

class CustomerProfile
{
  private string $name;

  public function __construct($name)
  {
    $this->name = $name;
  }

  public function __get($prop)
  {
    if (property_exists($this, $prop)) return $this->$prop;

    return null;
  }
}
