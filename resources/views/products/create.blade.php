<x-layout title="Jauns produkts">
    <h2>Jauns produkts</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        @include('products.form')
        <button type="submit">Saglabāt</button>
    </form>

    <a href="{{ route('products.index') }}">Atpakaļ</a>
</x-layout>