<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the product index page lists products', function () {
    $products = Product::factory()->count(3)->create();

    $response = $this->get(route('products.index'));

    $response->assertOk()
        ->assertSee($products->pluck('name')->all());
});

test('every product view uses the shared layout with vite assets and the holy grail grid', function () {
    $product = Product::factory()->create();

    $pages = [
        route('products.index'),
        route('products.create'),
        route('products.show', $product),
        route('products.edit', $product),
    ];

    foreach ($pages as $page) {
        $response = $this->get($page);

        $response->assertOk()
            ->assertSee('<link rel="stylesheet"', false)
            ->assertSee('<script type="module"', false)
            ->assertSee('class="page-layout"', false)
            ->assertSee('<header class="site-header"', false)
            ->assertSee('<nav', false)
            ->assertSee('<aside class="left-sidebar"', false)
            ->assertSee('<main class="main-content"', false)
            ->assertSee('<aside class="right-sidebar"', false)
            ->assertSee('<footer class="site-footer"', false);
    }
});

test('the create form posts to the named store route', function () {
    $this->get(route('products.create'))
        ->assertOk()
        ->assertSee(route('products.store'), false);
});

test('a product can be stored', function () {
    $payload = [
        'name' => 'Tastatūra',
        'quantity' => 10,
        'description' => 'Mehāniska tastatūra',
        'expiration_date' => '2027-01-01',
        'status' => 'active',
    ];

    $response = $this->post(route('products.store'), $payload);

    $this->assertDatabaseHas('products', ['name' => 'Tastatūra']);

    $product = Product::firstWhere('name', 'Tastatūra');

    $response->assertRedirect(route('products.show', $product));
});

test('storing a product requires valid data', function () {
    $response = $this->from(route('products.create'))
        ->post(route('products.store'), [
            'name' => '',
            'quantity' => -5,
            'status' => 'bogus',
        ]);

    $response->assertRedirect(route('products.create'))
        ->assertSessionHasErrors(['name', 'quantity', 'status']);

    $this->assertDatabaseCount('products', 0);
});

test('the show page displays a single product', function () {
    $product = Product::factory()->create([
        'name' => 'Dators',
        'quantity' => 5,
        'status' => 'active',
    ]);

    $this->get(route('products.show', $product))
        ->assertOk()
        ->assertSee('Dators');
});

test('the edit form is prefilled with the product', function () {
    $product = Product::factory()->create(['name' => 'Pele']);

    $this->get(route('products.edit', $product))
        ->assertOk()
        ->assertSee('value="Pele"', false);
});

test('a product can be updated', function () {
    $product = Product::factory()->create();

    $response = $this->put(route('products.update', $product), [
        'name' => 'Atjaunots produkts',
        'quantity' => 20,
        'description' => 'Mainīts apraksts',
        'expiration_date' => '2027-06-01',
        'status' => 'inactive',
    ]);

    $response->assertRedirect(route('products.index'));

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Atjaunots produkts',
    ]);
});

test('a product can be deleted', function () {
    $product = Product::factory()->create();

    $response = $this->delete(route('products.destroy', $product));

    $response->assertRedirect(route('products.index'));
    $this->assertDatabaseMissing('products', ['id' => $product->id]);
});

test('the stylesheet loaded through vite defines the holy grail grid', function () {
    $css = file_get_contents(resource_path('css/app.css'));

    expect($css)
        ->toContain('display: grid')
        ->toContain('grid-template-areas')
        ->toContain('"header header header"')
        ->toContain('"left   main   right"')
        ->toContain('"footer footer footer"')
        ->and(file_get_contents(resource_path('js/app.js')))->toContain('Products CRUD');
});

test('a failed validation shows red text so the stylesheet is visibly applied', function () {
    $response = $this->from(route('products.create'))
        ->post(route('products.store'), ['name' => '', 'quantity' => -5, 'status' => 'bogus']);

    $response->assertSessionHasErrors(['name', 'quantity', 'status']);

    $this->get(route('products.create'))
        ->assertOk()
        ->assertSee('<p class="error">', false);

    expect(file_get_contents(resource_path('css/app.css')))
        ->toContain('.error {')
        ->toContain('color: #dc2626');
});

test('route model binding returns 404 for an unknown product', function () {
    $this->get(route('products.show', 999999))->assertNotFound();
    $this->get(route('products.edit', 999999))->assertNotFound();
});
