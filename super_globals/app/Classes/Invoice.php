<?php

declare(strict_types=1);

namespace App\Classes;

class Invoice
{
  public function index()
  {
    return "Invoice Home";
  }

  public function create(): string
  {
    return "Create Invoice";
  }
}
