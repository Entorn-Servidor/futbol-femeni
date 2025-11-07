<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadiController extends Controller
{
    protected $initialEstadis = [
        [
            'id' => 1,
            'nom' => 'Estadi Johan Cruyff',
            'ciutat' => 'Sant Joan Despí',
            'capacitat' => 6000,
            'equip_principal' => 'FC Barcelona Femení'
        ],
        [
            'id' => 2,
            'nom' => 'Centro Deportivo Wanda Alcalá de Henares',
            'ciutat' => 'Alcalá de Henares',
            'capacitat' => 2800,
            'equip_principal' => 'Atlètic de Madrid Femení'
        ],
        [
            'id' => 3,
            'nom' => 'Estadio Alfredo Di Stéfano',
            'ciutat' => 'Madrid',
            'capacitat' => 6000,
            'equip_principal' => 'Real Madrid Femení'
        ],
    ];

    protected function getEstadis()
    {
        $estadis = session('estadis', $this->initialEstadis);
        
        if (!session()->has('estadis')) {
            session(['estadis' => $estadis]);
        }
        
        return $estadis;
    }


    public function index()
    {
        $estadis = $this->getEstadis();
        
        return view('estadis.index', compact('estadis'));
    }


    public function create()
    {
        return view('estadis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:3',
            'ciutat' => 'required|min:2',
            'capacitat' => 'required|integer|min:0',
            'equip_principal' => 'required|min:3',
        ], [
            'nom.min' => 'El nom ha de tenir almenys 3 caràcters.',
            'ciutat.min' => 'La ciutat ha de tenir almenys 2 caràcters.',
            'capacitat.min' => 'La capacitat ha de ser un nombre positiu o zero.'
        ]);

        $estadis = $this->getEstadis();
        
        $newId = $estadis ? max(array_column($estadis, 'id')) + 1 : 1;

        $nouEstadi = $request->only(['nom', 'ciutat', 'capacitat', 'equip_principal']);
        $nouEstadi['id'] = $newId;
        $nouEstadi['capacitat'] = (int) $nouEstadi['capacitat'];

        $estadis[] = $nouEstadi;
        session(['estadis' => $estadis]);

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi "' . $nouEstadi['nom'] . '" afegit correctament!');
    }
}
