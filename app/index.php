<?php

require_once 'vendor/autoload.php';

function binaryToDecimal($binary)
{
  return collect(str_split($binary))
    ->reverse()
    ->values()
    ->map(function ($column, $exponent) {
      return $column * (2 ** $exponent);
    })->sum();
}

var_dump(binaryToDecimal("100110101"));
