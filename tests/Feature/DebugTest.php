<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('debug errors', function () {
    $response = $this->from(route('products.create'))
        ->post(route('products.store'), ['name' => '', 'quantity' => -5, 'status' => 'bogus']);

    $response->assertStatus(302);

    $next = $this->get(route('products.create'));
    $next->assertOk();
});
