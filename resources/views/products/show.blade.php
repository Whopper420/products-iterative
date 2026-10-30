<x-layout :title="$product->name">
    <h2>{{ $product->name }}</h2>

    <p>Apraksts: {{ $product->description ?: 'Nav apraksta' }}</p>
    <p>Daudzums: {{ $product->quantity }}</p>
    @if ($product->expiration_date)
        <p>Derīgs līdz: {{ $product->expiration_date->toDateString() }}</p>
    @endif
    <p>Statuss: {{ $product->status }}</p>

    <a href="{{ route('products.edit', $product) }}">Rediģēt</a>
    <a href="{{ route('products.index') }}">Atpakaļ uz sarakstu</a>
</x-layout>