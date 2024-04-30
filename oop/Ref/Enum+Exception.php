<?php

declare(strict_types=1);

/**
 * This is a sample
 * How to use Enum to create a custom exception cases
 * PHP 8.1^
 */

enum MyExceptionCase
{
  case InvalidMethod;
  case InvalidProperty;
  case Timeout;
}

class MyException extends Exception
{
  function __construct(private MyExceptionCase $case)
  {
    match ($case) {
      MyExceptionCase::InvalidMethod      =>    parent::__construct("Bad Request - Invalid Method", 400),
      MyExceptionCase::InvalidProperty    =>    parent::__construct("Bad Request - Invalid Property", 400),
      MyExceptionCase::Timeout            =>    parent::__construct("Bad Request - Timeout", 400)
    };
  }
}

// Testing my custom exception class
try {
  throw new MyException(MyExceptionCase::InvalidMethod);
} catch (MyException $myE) {
  echo $myE->getMessage();  // Bad Request - Invalid Method
}
