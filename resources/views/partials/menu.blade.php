<nav>
    {{-- Enllaç a la pàgina d'inici --}}
    <a href="{{ route('home') }}">Inici</a>
    
    {{-- Enllaç a Equips (La pàgina on ets) --}}
    <a href="{{ route('equips.index') }}">Llistat d'Equips</a>
    
    {{-- Enllaç a Estadis (Fase 1) --}}
    <a href="{{ route('estadis.index') }}">Llistat d'Estadis</a>
    
    {{-- 
    LÍNIES COMENTADES PER EVITAR L'ERROR:
    Aquestes rutes ('contacte.create' i 'productes.index') 
    no estan definides al teu projecte de GitHub i causen l'error.
    Les hem comentat (desactivat).
    --}}
    
    </nav>