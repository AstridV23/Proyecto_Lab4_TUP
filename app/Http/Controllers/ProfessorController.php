<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Commission;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index(Request $request)
    {
        $query = Professor::query();

        // Filtro por nombre
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Filtro por especialización
        if ($request->filled('specialization')) {
            $query->where('specialization', 'LIKE', '%' . $request->specialization . '%');
        }

        $professors = $query->paginate(10);
        return view('professors.index', compact('professors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
        ]);

        Professor::create($validated);

        return redirect()
            ->route('professors.index')
            ->with('success', 'Profesor creado exitosamente');
    }

    public function show(Professor $professor)
    {
        return view('professors.show', compact('professor'));
    }

    public function edit(Professor $professor)
    {
        $commissions = Commission::with('course')->get();
        return view('professors.edit', compact('professor', 'commissions'));
    }

    public function update(Request $request, Professor $professor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'commissions' => 'array'
        ]);

        $professor->update([
            'name' => $validated['name'],
            'specialization' => $validated['specialization']
        ]);

        if (isset($validated['commissions'])) {
            $professor->commissions()->sync($validated['commissions']);
        }

        return redirect()
            ->route('professors.index')
            ->with('success', 'Profesor actualizado exitosamente');
    }

    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);
        $professor->delete();

        return response()->json(['message' => 'Professor deleted successfully']);
    }

    public function create()
    {
        return view('professors.create');
    }
}