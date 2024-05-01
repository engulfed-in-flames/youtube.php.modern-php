<?php

namespace Finance;

class DebtCollectionService
{
  public function collectDebt(DebtCollector $collector) // Use interface as type! (Polymorphism)
  {
    $owedAmount = mt_rand(100, 1000);
    $collectedAmount = $collector->collect($owedAmount);

    echo "Collected $" . $collectedAmount . " out of $" . $owedAmount . "<br/>";
  }
}
