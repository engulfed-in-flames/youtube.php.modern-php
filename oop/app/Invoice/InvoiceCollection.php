<?php

namespace Invoice;

use Invoice\Invoice;

class InvoiceCollection implements \Iterator
{
  private array $invoices = [];

  public function __construct(Invoice ...$invoices)
  {
    $this->invoices = $invoices;
  }


  public function addInvoice(Invoice $invoice)
  {
    $this->invoices[] = $invoice;
  }

  public function current(): mixed
  {
    echo __METHOD__ . "<br/>";

    return current($this->invoices);
  }

  public function next(): void
  {
    echo __METHOD__ . "<br/>";

    next($this->invoices);
  }

  public function key(): mixed
  {
    echo __METHOD__ . "<br/>";

    return key($this->invoices);
  }

  public function valid(): bool
  {
    echo __METHOD__ . "<br/>";

    return $this->current() !== false;
  }

  public function rewind(): void
  {
    echo __METHOD__ . "<br/>";

    reset($this->invoices);
  }
}
