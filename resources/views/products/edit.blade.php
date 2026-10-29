<x-layout title="Rediģēt produktu">
    <h2>Rediģēt produktu: {{ $product->name }}</h2>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        @include('products.form')
        <button type="submit">Atjaunināt</button>
    </form>

    <a href="{{ route('products.index') }}">Atpakaļ</a>
</x-layout> 