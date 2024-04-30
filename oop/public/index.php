<?php

declare(strict_types=1);

require_once "../helpers.php";

// When you use or access a class, php will check the class exists or not. If class doesn't exists,
// before throwing any errors, php looks for any reigstered autoloader functions and runs them one by one.
spl_autoload_register(function ($class) {
  // var_dump("Autoloader 1");
  $path = realpath(__DIR__ . "/../" . lcfirst(str_replace("\\", "/", $class)) . ".php");

  if (file_exists($path)) {
    require_once $path;
  }
});

// spl_autoload_register(function ($_) {
//   var_dump("Autoloader 2");
// }, prepend: true);

use App\PaymentGateway\Paddle\Transaction;

$paddleTransaction = new Transaction();

inspect(Transaction::class); // Print fully qualified class name
inspect($paddleTransaction::class); // Print fully qualified class name

inspect($paddleTransaction::$count); // Not associated with a certain instance. Globally accessible.
inspect(Transaction::$count);

/*
// In most cases, you don't need to worry about this.
// Reflection API
$reflectedProperty = new ReflectionProperty(Transaction::class, "amount");
$reflectedProperty->setAccessible(true);

// $reflectedProperty->setValue($transaction, 125);
inspect($reflectedProperty->getValue($transaction));
*/

echo "Inheritance" . "<br/>";

use App\Toaster;

$toasterPro = new Toaster\ToasterPro();

$toasterPro->addSlice("bread");
$toasterPro->addSlice("bread");
$toasterPro->addSlice("bread");
// $toasterPro->toast();
$toasterPro->toastBagel();


echo "Interface" . "<br/>";

use App\Finance;

$collector = new Finance\CollectionAgency();
$service = new Finance\DebtCollectionService();

echo $collector->collect(100) . "<br/>";
echo $service->collectDebt($collector)  . "<br/>";

echo "Magic Method" . "<br/>";

use App\Invoice;

$invoice = new Invoice\Invoice(20);
