<nav>
    {{-- Enllaç a la pàgina d'inici --}}
    <a href="{{ route('home') }}">Inici</a>
    
    {{-- Enllaç a Equips (La pàgina on ets) --}}
    <a href="{{ route('equips.index') }}">Llistat d'Equips</a>
    
    {{-- Enllaç a Estadis (Fase 1) --}}
    <a href="{{ route('estadis.index') }}">Llistat d'Estadis</a>
    <a href="{{ route('jugadores.index') }}">Llistat de jugadores</a>
    {{-- 
    LÍNIES COMENTADES PER EVITAR FUTURS ERRORS:
    Fins que no creïs les rutes 'contacte' i 'productes',
    les mantenim comentades.
    --}}
    
    </nav>