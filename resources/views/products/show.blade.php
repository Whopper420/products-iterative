<x-layout :title="$product->name">
    <h2>{{ $product->name }}</h2>

    <p>Apraksts: {{ $product->description ?: 'Nav apraksta' }}</p>
    <p>Cena: {{ number_format($product->price, 2) }} €</p>

    <a href="{{ route('products.edit', $product) }}">Rediģēt</a>
    <a href="{{ route('products.index') }}">Atpakaļ uz sarakstu</a>
</x-layout>