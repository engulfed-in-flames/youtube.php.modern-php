<?php

declare(strict_types=1);

require_once "../helpers.php";

// When you use or access a class, php will check the class exists or not. If class doesn't exists,
// before throwing any errors, php looks for any reigstered autoloader functions and runs them one by one.
spl_autoload_register(function ($class) {
  // var_dump("Autoloader 1");

  // $prefix = "Foo\\Bar\\"; // project-specific namespace
  // $baseDir = realpath(__DIR__ . "/../app") . "\\";
  $baseDir = dirname(__DIR__) . "/app/";
  $path = $baseDir . lcfirst(str_replace("\\", "/", $class)) . ".php";

  if (file_exists($path)) {
    require_once $path;
  }
});

// spl_autoload_register(function ($_) {
//   var_dump("Autoloader 2");
// }, prepend: true);

use PaymentGateway\Paddle\Transaction;

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

use Toaster\ToasterPro;

$toasterPro = new ToasterPro();

$toasterPro->addSlice("bread");
$toasterPro->addSlice("bread");
$toasterPro->addSlice("bread");
// $toasterPro->toast();
$toasterPro->toastBagel();

echo "Interface" . "<br/>";

use Finance as F;

$collector = new F\CollectionAgency();
$service = new F\DebtCollectionService();

echo $collector->collect(100) . "<br/>";
echo $service->collectDebt($collector)  . "<br/>";

echo "Magic Method" . "<br/>";

use Invoice\Invoice;

$invoice = new Invoice(25, "Hello, PHP!");

// How to clone an original object?
// $invoiceClone = clone $invoice;
// or Using `clone` magic methid.

// echo serialize($invoice) . "<br/>"; // NEVER EVER serialize untrusted data.
// echo unserialize(serialize($invoice)) . "<br/>";

// Do NOT use Serializable interface. It will be deprcated.
// Instead, use `sleep` & `wakeup` magic method.
echo serialize($invoice) . "<br/>";
