<?php

declare(strict_types=1);

function getFiles(string $dirPath): array
{
  $files = [];

  foreach (scandir($dirPath) as $file) {
    if (is_dir($file)) continue;

    $files[] = $dirPath . $file;
  }
  return $files;
}

function getTransactions(string $filePath, ?callable $transactionHandler = null): array
{
  if (!file_exists($filePath)) trigger_error("The file path({$filePath}) " . "does not exist" . E_USER_ERROR);

  $file = fopen($filePath, "r");

  fgetcsv($file); // Discard the first line

  $transactions = [];
  while (($transaction = fgetcsv($file)) !== false) {
    if (is_callable($transactionHandler)) {
      $transaction = $transactionHandler($transaction);
    }
    $transactions[] = $transaction;
  }

  fclose($file);
  return $transactions;
}

function extractTransaction(array $transactionRow): array
{
  [$date, $checkNumber, $description, $amount] = $transactionRow;
  $amount = (float) str_replace(["$", ","], "", $amount); // RegExp overkill

  return [
    "date" => $date,
    "checkNumber" => $checkNumber,
    "description" => $description,
    "amount" => $amount
  ];
}

function calculateTotals(array $transactions): array
{
  $totals = [
    "netTotal" => 0,
    "totalIncome" => 0,
    "totalExpense" => 0
  ];

  foreach ($transactions as $transaction) {
    $amount = $transaction["amount"];

    $totals["netTotal"] += $amount;
    if ($amount >= 0) {
      $totals["totalIncome"] += $amount;
    } else {
      $totals["totalExpense"] += $amount;
    }
  }

  return $totals;
}
