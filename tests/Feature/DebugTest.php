<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('debug errors', function () {
    $response = $this->from(route('products.create'))
        ->post(route('products.store'), ['name' => '', 'price' => 'abc']);

    $response->assertStatus(302);
    dump('after post: ' . json_encode(session()->get('errors')?->getMessages()));

    $next = $this->get(route('products.create'));
    dump('view errors: ' . json_encode($next->viewData('errors')?->getMessages()));
    dump('session errors: ' . json_encode(session()->get('errors')?->getMessages()));
    $next->assertOk();
});
