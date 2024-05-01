<?php

namespace Toaster;

// In "has a" relationship, better to use composition.
class FancyOven
{
  public function __construct(private ToasterPro $toaster)
  {
  }

  public function fry()
  {
  }

  public function toast()
  {
    $this->toaster->toast();
  }

  public function toastBagel()
  {
    $this->toaster->toastBagel();
  }
}
