<?php

namespace Pierrecdevs\App;

use ArrayAccess;
use ArrayIterator;
use Closure;
use Countable;
use IteratorAggregate;
use Traversable;

class Collection implements ArrayAccess, Countable, IteratorAggregate
{
  protected $items = [];

  public function __construct($items = [])
  {
    $this->items = $items;
  }

  // #region IteratorAggregate
  public function getIterator(): Traversable
  {
    return new ArrayIterator($this->items);
  }
  // #endregion

  // #region Countable
  public function count(): int
  {
    return count($this->items);
  }
  // #endregion

  // #region ArrayAccess
  public function offsetExists(mixed $offset): bool
  {
    return array_key_exists($offset, $this->items);
  }

  public function offsetGet(mixed $offset): mixed
  {
    return $this->items[$offset];
  }

  public function offsetSet(mixed $offset, mixed $value): void
  {
    if ($offset == null) {
      $this->items[] = $value;
    } else {
      $this->items[$offset] = $value;
    }
  }

  public function offsetUnset(mixed $offset): void
  {
    unset($this->items[$offset]);
  }
  // #endregion

  public function map(Closure $callback)
  {
    return new static(array_map($callback, $this->items));
  }

  public function filter(Closure $callback)
  {
    return new static(array_filter($this->items, $callback));
  }

  public static function make(mixed $items = [])
  {
    return new static($items);
  }

  public function toArray()
  {
    return $this->items;
  }

  public function contains(mixed $needle): bool
  {
    return in_array($needle, $this->items);
  }

  public function reduce(Closure $callback, mixed $initial = null): mixed
  {
    return new static(array_reduce($this->items, $callback, $initial));
  }

  public function sum(): int | float
  {
    return array_sum($this->items);
  }
}
