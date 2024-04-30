<?php

// Inheritance
// Keyword: Signature rule (Constructor is exceptional)

/* 
Inheritance is not always good if it is overused or misused. (Generally good)
It breaks encapsulation, because is has fully access public, protected class members of parent.
Also, the child class might have useless class member of parent.
> Inheritance creates tight coupling between parent & child classes.

One solution for this is overriding to throw Exception when that useless class member is used. (NOT Recommended)


*/

namespace App\Toaster;

// final class or final method cannot be modified or overrided
// Fundamentally, final modifier is used for preventing inheritance .
final class ToasterPro extends Toaster
{
  // Cannot override private properties of parent class.
  // Also cannot change the modifier.
  protected int $size = 4;

  // If you override constructor, the class doesn't call the parent constructor by default.
  // public function __construct()
  // {
  //   $this->size = 4;
  // }

  public function addSlice(string $slice): void
  {
    // parent::addSlice($slice);
  }


  public function toastBagel()
  {
    foreach ($this->slices as $i => $slice) {
      echo ($i + 1) . ": Toasting " . $slice . "with bagels option.";
    }
  }
}
