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

$variants = $coversAndWallets->map(function ($product) {
  return $product['variants'];
});

dd($variants);

$prices = Collection::make([]);

foreach ($coversAndWallets->toArray() as $product) {
  foreach ($product['variants'] as $variant) {
    $prices[] = $variant['price'];
  }
}

$totalCost = $prices->sum();

dd($totalCost);
// 462.0
