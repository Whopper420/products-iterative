
<x-layout title="Produktu saraksts">
    <h2>Produktu saraksts</h2>

    <a href="{{ route('products.create') }}">+ Pievienot produktu</a>

    @forelse ($products as $product)
        <article class="product">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <p>Daudzums: {{ $product->quantity }}</p>

            <a href="{{ route('products.show', $product) }}">Apskatīt</a>
            <a href="{{ route('products.edit', $product) }}">Rediģēt</a>

            <form action="{{ route('products.destroy', $product) }}"
                  method="POST"
                  onsubmit="return confirm('Vai tiešām dzēst produktu?')">
                @csrf
                @method('DELETE')
                <button type="submit">Dzēst</button>
            </form>
        </article>
    @empty
        <p>Produktu vēl nav.</p>
    @endforelse
</x-layout>
