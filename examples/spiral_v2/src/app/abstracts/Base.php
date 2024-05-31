<?php

abstract class Base
{
  /** クラス変数への直接アクセスを禁止する。*/
  public function __get($key): void
  {
    throw new BadFunctionCallException("Getter is NOT allowed.");
  }

  /** クラス変数への直接アクセスを禁止する。*/
  public function __set($key, $value): void
  {
    throw new BadFunctionCallException("Setter is NOT allowed.");
  }
}
