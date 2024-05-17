<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class HomeController
{
  // public static function index() ❓ Do NOT want this method to be static.
  public function index(): View
  {
    // Store cookies
    // Cookie must be modified before any output.
    // Should NOT store sensitive information in cookies.
    // setcookie(
    //   "name",
    //   "John Doe",
    //   time() + (24 * 60 * 60),
    //   "/"
    // );

    // Delete cookies
    // You can delete a cookie by setting the expiration time to a past time.
    // setcookie(
    //   "name",
    //   "John Doe",
    //   time() - (24 * 60 * 60),
    //   "/"
    // );

    return View::make("index");
  }


  public function download()
  {
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=invoice.pdf");

    readfile(STORAGE_PATH . DIRECTORY_SEPARATOR . "invoice.pdf");
  }

  public function upload()
  {
    // echo "<pre>";
    // print_r($_FILES);
    // print_r(pathinfo($_FILES["receipt"]["tmp_name"]));
    // echo "</pre>";

    $filePath = STORAGE_PATH . DIRECTORY_SEPARATOR . $_FILES["receipt"]["name"];

    move_uploaded_file($_FILES["receipt"]["tmp_name"], $filePath);

    header("Location: /");
    exit;
    // Make sure not to execute any code after redirecting.
  }
}
