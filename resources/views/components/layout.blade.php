@props(['title' => 'Produkti'])

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="page-layout">

        <header class="site-header">
            <h1>Produktu pārvaldība</h1>

            <nav aria-label="Galvenā navigācija">
                <a href="{{ route('products.index') }}">Produkti</a>
                <a href="{{ route('products.create') }}">Pievienot produktu</a>
            </nav>
        </header>

        <aside class="left-sidebar" aria-label="Sānjoslas navigācija">
            <h2>Izvēlne</h2>
            <ul>
                <li>
                    <a href="{{ route('products.index') }}">Visi produkti</a>
                </li>
                <li>
                    <a href="{{ route('products.create') }}">Jauns produkts</a>
                </li>
            </ul>
        </aside>

        <main class="main-content">
            @if (session('success'))
                <p class="success" role="status">{{ session('success') }}</p>
            @endif

            {{ $slot }}
        </main>

        <aside class="right-sidebar" aria-label="Papildu informācija">
            <h2>Informācija</h2>
            <p>Šeit var ievietot papildu informāciju par produktiem.</p>
        </aside>

        <footer class="site-footer">
            <p>&copy; {{ date('Y') }} Produktu pārvaldība</p>
        </footer>

    </div>

</body>
</html>
