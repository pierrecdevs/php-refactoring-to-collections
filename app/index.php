<?php

require_once 'vendor/autoload.php';

function load_json(string $path)
{
  return json_decode(file_get_contents(__DIR__ . '/' . $path), true);
}

$products = collect(load_json('data/products.json')['products']);

$totalCost = $products
  ->filter(function ($product) {
    return collect(['Slim Cover', 'MagSafe Wallet'])->contains($product['product_type']);
  })
  ->flatMap(function ($product) {
    return $product['variants'];
  })
  ->pluck('price')
  ->sum();

dd($totalCost);
// 462.0
