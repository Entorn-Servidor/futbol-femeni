<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futbol Femení - @yield('title', 'Inici')</title>
    
    {{-- Carrega els estils CSS del teu projecte (guias.css) --}}
    @vite(['resources/css/app.css','resources/js/app.js']) 

</head>
<body>
    <header>
        <div class="container">
            <h1>Futbol Femení App</h1>
            
            {{-- Inclou el menú de navegació --}}
            @include('partials.menu')
        </div>
    </header>

    <main class="container">
        {{-- Aquí s'injectarà el contingut de 'estadis.index', 'equips.index', etc. --}}
        @yield('content')
    </main>

    <footer>
        <div class="container" style="text-align: center; color: #6c757d; margin-top: 50px; border-top: 1px solid #e9ecef; padding-top: 10px;">
            <p>&copy; {{ date('Y') }} La Meva Aplicació. Tots els drets reservats.</p>
        </div>
    </footer>
</body>
</html>