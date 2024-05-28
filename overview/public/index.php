<?php

declare(strict_types=1);
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "helpers.php";

loadConfig();
loadApp();

$files = getFiles(FILES_PATH);
$transactions = [];

foreach ($files as $file) {
  $transactions = array_merge($transactions, getTransactions($file, "extractTransaction"));
}

$totals = calculateTotals($transactions);

$data = [
  "transactions" => $transactions,
  "totals" => $totals
];

loadView("transactions", $data);
