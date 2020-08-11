<?php

use App\Product;

test('has products', function() {
    assertEquals(20, Product::count());
});

test('has a title, description, and price', function() {
    $product = Product::first();

    assertNotEmpty($product->title);
    assertNotEmpty($product->description);
    assertNotEmpty($product->price);
});

test ('has search', function() {
    $response = Product::search();

    assertEquals($response->count(), Product::count());
});