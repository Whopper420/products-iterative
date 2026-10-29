
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Produkti')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <h1>Produktu pārvaldība</h1>
        <nav>
            <a href="{{ route('products.index') }}">Produkti</a>
            <a href="{{ route('products.create') }}">Pievienot produktu</a>
        </nav>
    </header>

    <main class="container">
        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @yield('content')
    </main>
</body>
</html>
