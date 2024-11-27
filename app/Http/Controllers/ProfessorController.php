<?php
namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{

    public function index()
    {
        $professors = Professor::all();
        return view('professor.index', compact('professors'));
    }

// Mostrar el formulario de creación
    public function create()
    {
        return view('professor.edit');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
        ]);

        // Crear un nuevo estudiante
        $professor = new Professor();
        $professor->name = $request->name;
        $professor->specialization = $request->specialization;
        $professor->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('professors.index')->with('success', 'Profesor creado');
    }


    // Mostrar el formulario de edición
    public function edit($id)
    {
        // Buscar al profesor por su ID
        $professor = Professor::findOrFail($id);
        
        // Pasar el profesor a la vista para que pueda ser editado
        return view('professor.edit', compact('professor'));
    }


    public function update(Request $request, $id)
    {
        $professor = Professor::findOrFail($id);

        // Validación
        $v = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'sometimes|string|max:255',
        ]);

         // Actualizar los datos del estudiante
         $professor->update([
            'name' => $request->name,
            'specialization' => $request->specialization,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('professors.index')->with('success', 'Profesor actualizado');
    }

    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);
        $professor->delete();
        return redirect()->route('professors.index')->with('success', 'Profesor eliminado');}
}