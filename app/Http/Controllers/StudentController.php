<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Mostrar todos los estudiantes
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('student.edit');
    }

    // Guardar un nuevo estudiante
    public function store(Request $request)
    {
        // Validación
        $v = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
        ]);

        // Crear un nuevo estudiante
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('students.index')->with('success', 'Estudiante creado');
    }

    // Mostrar el formulario de edición
    public function edit($id)
    {
        $student = Student::find($id);
        return view('student.edit', compact('student'));
    }

    // Actualizar un estudiante
    public function update(Request $request, Student $student)
    {
        // Validación
        $v = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]);

        // Actualizar los datos del estudiante
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('students.index')->with('success', 'Estudiante actualizado');
    }

    // Eliminar un estudiante
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Estudiante eliminado');
    }
}
