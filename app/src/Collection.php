<?php

namespace Pierrecdevs\App;

use Closure;

class Collection
{
  protected $items;

  public function __construct($items)
  {
    $this->items = $items;
  }

  public function filter(Closure $callback)
  {
    return new static(array_filter($this->items, $callback));
  }

  public static function make($items)
  {
    return new static($items);
  }

  public function toArray()
  {
    return $this->items;
  }

  public function contains($needle)
  {
    return in_array($needle, $this->items);
  }
}
