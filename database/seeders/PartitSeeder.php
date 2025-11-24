<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Partit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PartitSeeder extends Seeder
{
    public function run(): void
    {
        // Obtenemos todos los IDs de equipos
        $equips = Equip::all()->pluck('id')->toArray();
        $numEquips = count($equips);

        // Ajuste para algoritmo Round Robin si hay impares
        if ($numEquips % 2 != 0) {
            array_push($equips, null);
        }

        $numJornadas = count($equips) - 1;
        $partitsPerJornada = count($equips) / 2;

        // Fecha de inicio: Hace 3 meses para tener partidos pasados y futuros
        $dataInici = Carbon::now()->subMonths(3)->startOfWeek(Carbon::SATURDAY);

        for ($j = 0; $j < $numJornadas; $j++) {
            $dataIda = $dataInici->copy()->addWeeks($j);
            $dataVuelta = $dataInici->copy()->addWeeks($j + $numJornadas + 1);

            for ($i = 0; $i < $partitsPerJornada; $i++) {
                $localId = $equips[$i];
                $visitantId = $equips[count($equips) - 1 - $i];

                if ($localId && $visitantId) {
                    // Crear partido IDA
                    $this->crearPartit($localId, $visitantId, $j + 1, $dataIda);
                    
                    // Crear partido VUELTA
                    $this->crearPartit($visitantId, $localId, $j + 1 + $numJornadas, $dataVuelta);
                }
            }

            // Rotación de equipos (Algoritmo Round Robin)
            $primero = array_shift($equips);
            $ultimo = array_pop($equips);
            array_unshift($equips, $ultimo);
            array_unshift($equips, $primero);
        }
    }

    private function crearPartit($local, $visitant, $jornada, $fecha)
    {
        $esPasado = $fecha->isPast();

        // Si el partido ya pasó, generamos goles aleatorios. Si no, null.
        // Usamos un array que Laravel convertirá a JSON automáticamente
        $gols = $esPasado ? [
            'local' => rand(0, 5),
            'visitant' => rand(0, 5)
        ] : null;

        Partit::create([
            'local_id'      => $local,
            'visitant_id'   => $visitant,
            'jornada'       => $jornada,
            'data'          => $fecha->format('Y-m-d'), // CORREGIDO: 'data' en lugar de 'data_partit'
            'gols'          => $gols,                   // CORREGIDO: Insertamos array en columna 'gols'
        ]);
    }
}