<?php

declare(strict_types=1);

// If you include data in a certain namespace, you cannot access to that data in global scope.
namespace App\PaymentGateway\Paddle;

use App\Enums\Status;

class Transaction
{
  // Should be resticted to open class members
  private Status $status;
  public static int $count = 0;

  public function __construct()
  {
    self::$count++;
    $this->setStatus(Status::PENDING->value);
  }

  // You can access the private field of the different instance of the same class type in this way.
  public function copyFrom(Transaction $transaction)
  {
    var_dump($transaction->status);
  }

  // Getter and Setter are not always recommended. Do NOT just create getter and setter. Sometimes, they break encapsulation.
  public function setStatus(string $status): self
  {
    if (!(Status::tryFrom($status))) {
      throw new \InvalidArgumentException("Invalid status");
    }
    $this->status = Status::from($status);

    return $this;
  }

  /**
   * @param CustomerProfile[] $arr // Type hint
   */
  public function foo(array $arr)
  {
    foreach ($arr as $obj) {
      $obj->name;
    }
  }
}


/* 
Transaction ver.1
class Transaction
{

  public const STATUS_PAID = "paid"; // In the case of 'const', 'public' keyword is recommended.
  public const STATUS_PENDING = "pending";
  public const STATUS_DECLINED = "declined";

  // Lookup
  public const ALL_STATUES = [
    self::STATUS_PAID => "Paid",
    self::STATUS_PENDING => "pending",
    self::STATUS_DECLINED => "Declined",
  ];


  // public function __construct(
  //   private float $amount = 0,
  //   private string $description = "",
  //   public ?CustomerProfile $customer = null,
  // ) {
  // }

  public function __construct(
    private string $status
  ) {
    $this->setStatus("pending");
  }

  // public function getCustomer()
  // {
  //   return $this->customer;
  // }

  public function setStatus(string $status): self
  {
    if (!isset(self::ALL_STATUES[$status])) {
      throw new \InvalidArgumentException("Invalid status");
    }
    $this->status = $status;

    return $this;
  }
}

*/
