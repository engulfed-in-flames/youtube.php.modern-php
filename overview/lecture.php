<?php

declare(strict_types=1);
require_once "helpers.php";
///// Error Control Operators (@) /////
// NOT Recommended

$data = @file("foo.txt"); // '@' suppresses error.

// Short-circuit Evaluation
// Instead of using 'and', 'or', 'xor', use short-circuit evaluation
// Be careful to use 'and', 'or', 'xor' because they have the lowest precedence. 

$x = true;
$y = false;
$z = $x and $y;

echo (string) $z;

///// Match ///// 
// Same with switch statement
// Just return the match value, not falling through
// More strict comparison(===)
// Cannot have multiple statements.
$paymentStatusDisplay = match ($paymentStatus) {
  1 => "Paid",
  2, 3 => "Payment Declined",
  0 => "Pending Payment",
  default => "Unknown Payment Status"
};

///// Tickable Statements //////
// NOT Recommended. Tickable Statements are not often used.
function onTick()
{
  echo "Tick<br />";
}

register_tick_function("onTick");

declare(ticks=3);


///// Strict Mode /////
declare(strict_types=1);

///// Function /////
function foo(): ?int
{
  return null;
}

// NOT Recommended
function sum1(int|float $x, ...$numbers): int|float
{
  $sum = $x;
  foreach ($numbers as $number) {
    $sum += $number;
  }
  return $sum;
}

// Rest parameter allows to define type, but array doesn't
function sum2(int|float ...$numbers): int|float
{
  $sum = 0;
  foreach ($numbers as $number) {
    $sum += $number;
  }
  return $sum;
}


function sum3(int|float ...$numbers): int|float
{
  return array_sum($numbers);
}

///// Lambda Function /////
$var1 = 1;
$sum = function (int|float ...$numbers) use (&$var1): int|float {
  $var1++;
  return array_sum($numbers);
};

echo "<br/>" . $var1;

///// Callback Function /////
// Type 1.
$arr1 = [1, 2, 3, 4];
$double = function (int|float $el): int|float {
  return 2 * $el;
};

$result = array_map($double, $arr1);
inspect($result);

// Type 2.
// closure type argument must be anonymous function.
// callable type argument takes any type of function.
$doubleSum = function (closure $callback, int|float ...$numbers): int|float {
  return $callback(array_sum($numbers));
};

$result = $doubleSum($double, 1, 2, 3, 4);

echo "<br/>" . $result;

///// Arrow Function /////
// Cleaner version of anonymous function

$arr1 = [5, 6, 7, 8];
$result = array_map(fn ($number) => $number * $number, $arr1);
inspect($result);

///// Date & Time /////
$currentTime =  time();
$oneDay = 24 * 60 * 60;
$tomorrow = $currentTime + $oneDay;
$yesterday = $currentTime - $oneDay;
$fiveDaysAfter = $currentTime + 5 * $oneDay;

echo "<br/>" . date_default_timezone_get();
// date_default_timezone_set("Asia/Tokyo");
date_default_timezone_set("UTC"); // UTC is recommended for management

echo "<br/>" . date("md/d/Y g:ia", $fiveDaysAfter);

// echo mktime(0, 0, 0, 4, 10, null); ❌ NOT Recommended
$result = date("m/d/y g:ia", strtotime("2024-04-11 09:00"));
echo date("m/d/y g:ia", strtotime("tomorrow"));
echo date("m/d/y g:ia", strtotime("yesterday"));


inspect(date_parse_from_format("md/d/Y g:ia", $result));

///// Array Methods /////
$items1 = [
  "a" => 1,
  "b" => 2,
  "c" => 3,
  "d" => 4,
  "e" => 5,
  "f" => 6,
  "g" => 7,
];

inspect(array_chunk($items, 2, true));

// array_combine($keyArray, $valueArray); Match the number of elements
// array_filter(array $array, callable|null $callback = null, int $mode = 0): array
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$evens = array_filter($arr, fn ($n) => $n % 2 === 0);
$evens = array_values($even);
echo "<br/>" . $evens;

$evenKeys = array_filter($arr, fn ($n) => $n % 2 === 0, ARRAY_FILTER_USE_KEY);
$evenKeys = array_values($evenKeys);
echo "<br/>" . $evenKeys;

// array_keys, array_values
// array_map
$arr = [1, 2, 3];
$arr2 = [4, 5, 6];

// When multiple array are used, keys aren't preserved.
$result = array_map(fn ($el1, $el2) => $el1 * $el2, $arr, $arr2);

// array_merge
$arr = [
  'a' => 1,
  'b' => 2,
  'c' => 3,
];
$arr2 = [
  'a' => 6,
  'd' => 4,
  'e' => 5,
];

// Overriding takes place
$result = array_merge($arr, $arr2);

// array_reduce : almost same with 'reduce' of JS
// array_search cf) in_array
// array_diff, array_diff_assoc

// asort
echo "<br/>" . asort($arr);
echo "<br/>" . ksort($arr2);
echo "<br/>" . usort($array, fn ($a, $b) => $a <=> $b);
echo "<br/>" . usort($array, fn ($a, $b) => $b <=> $a);

[$a,, $c] = $arr;
echo "<br/>" . $a . ", " . $c;


///// Error Handling /////
// error_log();

function errorHandler(int $type, string $msg, ?string $file = null, ?int $line = null)
{
  echo $type . ": " . $msg . " in " . $file . " on line " . $line;
  exit;
}

set_error_handler("errorHandler", E_ALL); // Some error like Parse error cannot be handled.
error_reporting(E_ALL & ~E_WARNING);


///// File System /////
$dir = scandir(__DIR__);
inspect($dir);
inspect(is_dir($dir[1]));
mkdir("foo/bar", recursive: true);
rmdir("foo");

if (file_exists("foo.txt")) {
  echo filesize("foo.txt");
} else {
  echo "NOT Found";
}

// copy, rename, unlink, fget, fgetcsv, file_get_contents, file_put_contents

echo "<h2>////////// OOP //////////</h2><br/>";

(function () {
  class Customer
  {

    public function __construct(
      public string $name,
      public int $id,
    ) {
    }
  }

  class Transaction
  {

    public function __construct(
      private float $amount = 0,
      private string $description = "",
      // private ?string $description = null,
      public ?Customer $customer = null,
    ) {
      // echo $amount;
    }

    public function getCustomer()
    {
      return $this->customer;
    }
  }

  // Null Safe Operator
  $transaction = new Transaction(1200, "TEST");
  echo $transaction?->customer?->id;
  echo $transaction->customer->id ?? "foo";
  // echo $transaction->getCustomer()->id ?? "foo"; ❌ Null Coalescing does NOT work with method.
  echo $transaction->getCustomer()?->id; // Short circuiting
  // $transaction->getCustomer()?->id = 10; // ❌ Does NOT work;
  // Also do NOT use null safe operator for the method that must be executed.
})();
