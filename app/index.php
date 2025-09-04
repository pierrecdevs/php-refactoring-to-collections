<?php

require_once 'vendor/autoload.php';

function load_json(string $path)
{
  return json_decode(file_get_contents(__DIR__ . '/' . $path), true);
}

$products = load_json('data/products.json')['products'];

$totalCost = 0;

foreach ($products as $product) {
  if ($product['product_type'] == 'Slim Cover' || $product['product_type'] == 'MagSafe Wallet') {
    foreach ($product['variants'] as $variant) {
      $totalCost += $variant['price'];
    }
  }
}

dd($totalCost);
// 462.0
