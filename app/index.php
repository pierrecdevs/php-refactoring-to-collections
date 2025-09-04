<?php

use Pierrecdevs\App\Collection;

require_once 'vendor/autoload.php';

function load_json(string $path)
{
  return json_decode(file_get_contents(__DIR__ . '/' . $path), true);
}

$products = Collection::make(load_json('data/products.json')['products']);

$coversAndWallets = $products->filter(function ($product) {
  return Collection::make(['Slim Cover', 'MagSafe Wallet'])->contains($product['product_type']);
});

$totalCost = 0;

foreach ($coversAndWallets->toArray() as $product) {
  foreach ($product['variants'] as $variant) {
    $totalCost += $variant['price'];
  }
}

dd($totalCost);
// 462.0
