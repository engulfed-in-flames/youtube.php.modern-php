<?php

namespace Finance;

// Interface is meta data that class needs to has or implements

// Interface can extend more than one interface.
// ex) interface DebtCollector extends foo, bar

// interface cannot have varaible but constant
interface DebtCollector
{
  public const CUSTOM_CONSTANT = 1; // Cannot be overriden.

  public function __construct();
  public function collect(float $owedAmount): float;
}
