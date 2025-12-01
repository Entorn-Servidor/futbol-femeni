<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipRequest;
use App\Http\Requests\UpdateEquipRequest;
use App\Models\Equip;
use App\Models\Estadi;
use App\Services\EquipService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class EquipController extends Controller {
    public function __construct(private EquipService $servei) {}

    // GET /equips
    public function index() {
        return view('equips.index', ['equips' => $this->servei->llistar()]);
    }

    // GET /equips/create
    public function create()
{
    $estadis = Estadi::all(); // Obtener estadios para el select
    return view('equips.create', compact('estadis'));
}
    // POST /equips
    public function store(StoreEquipRequest $request) // Usa tu Request personalizado
{
    // 1. Obtener los datos validados
    $datos = $request->validated();

    // 2. Verificar si viene el archivo 'escut' y guardarlo
    if ($request->hasFile('escut')) {
        // Guarda el archivo en 'storage/app/public/escuts' y devuelve la ruta
        $rutaEscut = $request->file('escut')->store('escuts', 'public');
        
        // Asigna la ruta al array de datos para guardarlo en la BD
        $datos['escut'] = $rutaEscut;
    }

    // 3. Crear el equipo
    Equip::create($datos);

    // 4. Redireccionar
    return redirect()->route('equips.index');
}

    // GET /equips/{id}
    public function show(Equip $equip)
{
    // Carga las relaciones para usarlas en la vista
    $equip->load('jugadores', 'estadi');
    
    // IMPORTANTE: Debe retornar 'view', NO '$equip'
    return view('equips.show', compact('equip'));
}

    // GET /equips/{id}/edit
    public function edit(Equip $equip) {
        $this->authorize('update', $equip);
        $estadis = Estadi::all();
        return view('equips.edit', compact('equip','estadis'));
    }

    // PUT /equips/{id}/edit
    public function update(Request $request, Equip $equip) {
        $this->servei->actualitzar($equip, $request->validated());
        return redirect()->route('equips.index')->with('ok', 'Equip actualitzat');
    }



    // DELETE /equips/{id}
    public function destroy($id) {
        $this->servei->eliminar($id);
        return redirect()->route('equips.index');
    }
}