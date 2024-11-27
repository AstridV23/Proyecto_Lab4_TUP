<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('subject')->get(); // Trae los cursos junto con la materia asociada
        return view('course.index', compact('courses'));
    }

    // Mostrar el formulario de creación
    public function create()
{
    // Pasamos todas las materias disponibles para mostrarlas en el formulario de creación
    $course = Course::all(); 
    return view('course.edit');
}

    // Almacenar un nuevo curso
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id', // Validación para que la materia exista
        ]);

        Course::create($validated); // Crear el curso

        return redirect()->route('courses.index')->with('success', 'Curso creado');
    }

    // Mostrar el formulario de edición
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $subjects = Subject::all(); // Obtener todas las materias
        return view('course.edit', compact('course', 'subjects'));
    }

    // Actualizar un curso
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $course = Course::findOrFail($id);
        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Curso actualizado');
    }

    // Eliminar un curso
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Curso eliminado');
    }
}
