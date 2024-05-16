<?php

declare(strict_types=1);

namespace App\Classes;

class Home
{
  // public static function index() ❓ Do NOT want this method to be static.
  public function index()
  {
    // Cookie must be modified before any output.
    // Should NOT store sensitive information in cookies.
    setcookie(
      "name",
      "John Doe",
      time() + (24 * 60 * 60),
      "/"
    );

    // You can delete a cookie by setting the expiration time to a past time.
    // setcookie(
    //   "name",
    //   "John Doe",
    //   time() - (24 * 60 * 60),
    //   "/"
    // );


    return "Home";
  }
}
