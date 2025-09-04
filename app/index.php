<?php

require_once 'vendor/autoload.php';

function load_json(string $path)
{
  return json_decode(file_get_contents(__DIR__ . '/' . $path), true);
}

$products = collect(load_json('data/products.json')['products']);

$coversAndWallets = $products->filter(function ($product) {
  return collect(['Slim Cover', 'MagSafe Wallet'])->contains($product['product_type']);
});

$variants = $coversAndWallets->map(function ($product) {
  return $product['variants'];
})->flatten(1);


$prices = $variants->map(function ($variant) {
  return $variant['price'];
});

$totalCost = $prices->sum();

dd($totalCost);
// 462.0
