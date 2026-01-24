<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /*
    projectController

    public function index()
    {
    // 10 per pàgina, carregant l'equip per evitar consultes N+1
    $projects = Project::with('team')->paginate(10);
    return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {

    $project->load(['team', 'technologies']);
    return view('projects.show', compact('project'));
    }
    */


    /*
    Vista (resources/views/projects/index.blade.php

    <h1>Llistat de Projectes</h1>

@auth
    <a href="{{ route('projects.create') }}" class="btn btn-primary">Nou Projecte</a>
@endauth

<table>
    <thead>
        <tr>
            <th>Títol</th>
            <th>Any</th>
            <th>Equip</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($projects as $project)
            <tr>
                <td>{{ $project->title }}</td>
                <td>{{ $project->publication_year }}</td>
                <td>{{ optional($project->team)->name }}</td>
                <td>
                    <a href="{{ route('projects.show', $project) }}">Detall</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No hi ha projectes.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $projects->links() }}
    
    */

}
