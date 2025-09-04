<?php

require_once 'vendor/autoload.php';

$shifts = [
  'DevOps_Steve_A730',
  'Sales_B9',
  'Support_Nathan_K8',
  'J13',
  'Warehouse_B2',
  'Fibre_Dave_A7',
];

$shiftIds = collect($shifts)->map(function ($shift) {
  /* Method 1:
  /* if (strrpos($shift, '_') === false) { */
  /*   return $shift; */
  /* } */
  /* $underscorePos = strrpos($shift, '_'); */
  /* $substringOffset = $underscorePos + 1; */
  /* return substr($shift, $substringOffset); */

  /* Method 2: */
  /* $parts = explode('_', $shift); */
  /* return end($parts); */
  return collect(explode('_', $shift))->last();
});

var_dump($shiftIds->all());
exit;
$shiftIds = [
  'A730',
  'B9',
  'K8',
  'J13',
  'B2',
  'A7'
];
