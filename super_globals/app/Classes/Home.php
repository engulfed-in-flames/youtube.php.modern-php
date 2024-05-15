<?php

declare(strict_types=1);

namespace App\Classes;

class Home
{
  // public static function index() ❓ Do NOT want this method to be static.
  public function index()
  {
    setcookie(
      "name",
      "John Doe",
      time() + 3600,
      "/"
    );

    return "Home";
  }
}
