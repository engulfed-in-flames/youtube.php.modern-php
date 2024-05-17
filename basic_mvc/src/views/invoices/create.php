<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice | Create</title>
</head>

<body>
  <form action="/invoices/create" method="post">
    <div>
      <label>Amount</label>
      <input type="text" name="amount" placeholder="Amount">
    </div>
    <button type="submit">Create</button>
  </form>
</body>

</html>