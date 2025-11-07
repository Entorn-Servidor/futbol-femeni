@extends('layouts.app')

@section('title', 'Llista d\'Estadis')

@section('content')
    <h2>Llista d'Estadis 🏟️</h2>

    <p><a href="{{ route('estadis.create') }}" style="color: #007bff; text-decoration: none;">+ Nou Estadi</a></p>

    {{-- Missatge Flash de Sessió --}}
    @if (session('success'))
        <div class="card" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if (count($estadis) > 0)
        <table border="1" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #343a40; color: white;">
                    <th style="padding: 10px;">ID</th>
                    <th style="padding: 10px;">Nom</th>
                    <th style="padding: 10px;">Ciutat</th>
                    <th style="padding: 10px;">Capacitat</th>
                    <th style="padding: 10px;">Equip Principal</th>
                </tr>
            </thead>
            <tbody>
                {{-- Ús del Component Blade --}}
                @foreach ($estadis as $estadi)
                    <x-estadi-card :estadi="$estadi"/>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hi ha estadis registrats.</p>
    @endif
@endsection