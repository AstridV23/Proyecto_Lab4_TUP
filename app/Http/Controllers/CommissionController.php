<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Course;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    // Mostrar todas las comisiones
    public function index()
    {
        $commissions = Commission::all();
        return view('commission.index', compact('commissions'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        $commission = Commission::all(); 
        return view('commission.edit');
    }

    // Almacenar una nueva comisión
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $validated = $request->validate([
            'aula' => 'required|string|max:255',
            'horario' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',  // Asegurarse que el course_id exista en la tabla courses
        ]);

        // Crear una nueva comisión
        Commission::create([
            'aula' => $request->aula,
            'horario' => $request->horario,
            'course_id' => $request->course_id,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('commissions.index')->with('success', 'Comisión creada');
    }

    // Mostrar el formulario de edición
    public function edit($id)
    {
        // Buscar la comisión por su ID
        $commission = Commission::findOrFail($id);
        $courses = Course::all();  // Obtener todos los cursos disponibles
        return view('commission.edit', compact('commission', 'courses'));
    }

    // Actualizar una comisión existente
    public function update(Request $request, $id)
    {
        // Buscar la comisión por su ID
        $commission = Commission::findOrFail($id);

        // Validación de los datos recibidos
        $validated = $request->validate([
            'aula' => 'required|string|max:255',
            'horario' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',  // Asegurarse que el course_id exista en la tabla courses
        ]);

        // Actualizar los datos de la comisión
        $commission->update([
            'aula' => $request->aula,
            'horario' => $request->horario,
            'course_id' => $request->course_id,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('commissions.index')->with('success', 'Comisión actualizada');
    }

    // Eliminar una comisión
    public function destroy($id)
    {
        // Buscar la comisión por su ID
        $commission = Commission::findOrFail($id);
        $commission->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('commissions.index')->with('success', 'Comisión eliminada');
    }
}
