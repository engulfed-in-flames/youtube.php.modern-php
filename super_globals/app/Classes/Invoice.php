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
    $html = <<<HTML
      <form action="/invoices/create" method="post">
        <div>
          <label>Amount</label>
          <input type="text" name="amount" placeholder="Amount">
        </div>
        <button type="submit">Create</button>
      </form>
    HTML;

    return $html;
  }

  public function store()
  {
    $amount = $_POST["amount"];
  }
}
