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
            <p class="site-logo">TEST LOGO</p>
            <h1>Produktu pārvaldība</h1>
        </header>

        <aside class="left-sidebar" aria-label="Sānjoslas navigācija">
            <h2>Izvēlne</h2>
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="{{ route('products.index') }}">Visi produkti</a>
                    </li>
                    <li>
                        <a href="{{ route('products.create') }}">Jauns produkts</a>
                    </li>
                </ul>
            </nav>
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
            <p class="ad">TEST REKLĀMA: Šeit būsvas īpaša produktu reklamācijas!</p>
        </aside>

        <footer class="site-footer">
            <p>&copy; {{ date('Y') }} TEST COPYRIGHT — Produktu pārvaldība</p>
        </footer>

    </div>

</body>
</html>
