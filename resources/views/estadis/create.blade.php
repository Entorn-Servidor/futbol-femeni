@extends('layouts.app')

@section('title', 'Afegir Nou Estadi')

@section('content')
    <h2>Afegir Nou Estadi ➕</h2>

    <p><a href="{{ route('estadis.index') }}" style="color: #007bff; text-decoration: none;">← Tornar a la llista</a></p>

    <form method="POST" action="{{ route('estadis.store') }}" class="card" style="max-width: 600px;">
        @csrf

        {{-- Missatge d'error de validació general (opcional) --}}
        @if ($errors->any())
            <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
                Si us plau, revisa els errors del formulari.
            </div>
        @endif

        <div style="margin-bottom: 15px;">
            <label for="nom">Nom:</label><br>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required style="width: 100%; padding: 8px;">
            @error('nom')
                <p style="color: red; font-size: 0.9em;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="ciutat">Ciutat:</label><br>
            <input type="text" id="ciutat" name="ciutat" value="{{ old('ciutat') }}" required style="width: 100%; padding: 8px;">
            @error('ciutat')
                <p style="color: red; font-size: 0.9em;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="capacitat">Capacitat:</label><br>
            <input type="number" id="capacitat" name="capacitat" value="{{ old('capacitat') }}" required min="0" style="width: 100%; padding: 8px;">
            @error('capacitat')
                <p style="color: red; font-size: 0.9em;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="equip_principal">Equip Principal:</label><br>
            <input type="text" id="equip_principal" name="equip_principal" value="{{ old('equip_principal') }}" required style="width: 100%; padding: 8px;">
            @error('equip_principal')
                <p style="color: red; font-size: 0.9em;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Guardar Estadi</button>
    </form>
@endsection