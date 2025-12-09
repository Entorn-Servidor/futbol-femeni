<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JugadoraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Canviem a true per permetre que tothom pugui fer la petició.
        // Més endavant aquí posaries lògica de rols/permisos.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // El nom és obligatori i no pot ser massa llarg
            'nom' => 'required|string|max:255',
            
            // La posició ha de ser una de les llistades
            'posicio' => 'required|string|in:portera,defensa,migcampista,davantera',
            
            // El dorsal ha de ser un número entre 1 i 99
            'dorsal' => 'required|integer|min:1|max:99',
            
            // Si tinguessis equip_id, seria així:
            // 'equip_id' => 'required|exists:equips,id',
        ];
    }

    /**
     * Missatges personalitzats d'error (Opcional, però recomanat)
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'El nom de la jugadora és obligatori.',
            'posicio.in' => 'La posició ha de ser: portera, defensa, migcampista o davantera.',
            'dorsal.integer' => 'El dorsal ha de ser un número.',
        ];
    }
}