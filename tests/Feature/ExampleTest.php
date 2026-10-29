<?php

test('the root url redirects to the product list', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('products.index'));
});
