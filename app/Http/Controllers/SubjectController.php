<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function index()
    {
        $subjects = Subject::all();  // Asegúrate de usar $subjects en plural
        return view('subject.index', compact('subjects'));  // Y pasarlo con 'subjects'
    }

// Mostrar el formulario de creación
    public function create()
    {
        return view('subject.edit');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Crear un nuevo estudiante
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('subjects.index')->with('success', 'Materia creada');
    }


    // Mostrar el formulario de edición
    public function edit($id)
    {
        // Buscar al profesor por su ID
        $subject = Subject::findOrFail($id);
        
        // Pasar el profesor a la vista para que pueda ser editado
        return view('subject.edit', compact('subject'));
    }


    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        // Validación
        $v = $request->validate([
            'name' => 'required|string|max:255',
        ]);

         // Actualizar los datos del estudiante
         $subject->update([
            'name' => $request->name,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('subjects.index')->with('success', 'Materia actualizada');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Materia eliminada');}
}