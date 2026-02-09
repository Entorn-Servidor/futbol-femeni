@props(['nom', 'estadi', 'titols', 'escut', 'jugadores', 'descripcio'])

<div class="equip border rounded-lg shadow-md p-4 bg-white">
    <h1>{{ $nom }}</h1>
    <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
    <p><strong>Estadi:</strong> {{ $estadi }}</p>
    <p><strong>Títols:</strong> {{ $titols }}</p>
    <div class="descripcio-ia p-4 bg-gray-100 rounded mt-4">
        <h3 class="font-bold">Descripció (IA):</h3>
        <p>{{ $descripcio }}</p>
    </div>
</div>
