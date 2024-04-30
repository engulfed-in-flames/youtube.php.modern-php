<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css" />
  <title>Transactions</title>
</head>

<body>
  <div class="container">
    <table class="stripped overflow-auto">
      <thead>
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Check #</th>
          <th scope="col">Description</th>
          <th scope="col">Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($transactions)) : ?>
          <?php foreach ($transactions as $transaction) : ?>
            <tr>
              <td scope="row"><?= formatDate($transaction["date"]) ?></td>
              <td><?= htmlspecialchars($transaction["checkNumber"]) ?></td>
              <td><?= htmlspecialchars($transaction["description"]) ?></td>
              <td>
                <?php
                $color = $transaction["amount"] > 0 ? "green" : ($transaction["amount"] < 0 ? "red" : "none");
                if ($color !== "none") : ?>
                  <span style="color: <?= $color ?>;">
                    <?= formatDollarAmount($transaction["amount"]) ?>
                  </span>
                <?php else : ?>
                  <?= formatDollarAmount($transaction["amount"]) ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach ?>
        <?php endif ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3">Total Income:</th>
          <td><?= formatDollarAmount($totals['totalIncome']) ?? 0 ?></td>
        </tr>
        <tr>
          <th colspan="3">Total Expense:</th>
          <td><?= formatDollarAmount($totals['totalExpense']) ?? 0 ?></td>
        </tr>
        <tr>
          <th colspan="3">Net Total:</th>
          <td><?= formatDollarAmount($totals['netTotal']) ?? 0 ?></td>
        </tr>
      </tfoot>
    </table>
  </div>

</body>

</html>