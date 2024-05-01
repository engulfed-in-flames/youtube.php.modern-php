<?php

namespace Finance;

// Can implement more than one interface.
class CollectionAgency implements DebtCollector
{
  public function __construct()
  {
  }

  public function collect(float $owedAmount): float
  {
    $guaranteed = $owedAmount * 0.5;

    return mt_rand((int) $guaranteed, (int) $owedAmount);
  }
}
