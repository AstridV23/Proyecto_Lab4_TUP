<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;

class StudentController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Student::with('courses');

        // Búsqueda global
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('courses', function($q) use ($searchTerm) {
                      $q->where('name', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        // Filtros específicos existentes
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->filled('course_id')) {
            $query->whereHas('courses', function($q) use ($request) {
                $q->where('courses.id', $request->course_id);
            });
        }

        $students = $query->paginate(10);
        $courses = Course::all();

        return view('student.index', compact('students', 'courses'));
    }

    //
    public function create()
    {
        $courses = Course::orderBy('name')->get();
        return view('student.edit', compact('courses'));
    }

    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'course_id' => 'required|exists:courses,id'
        ]);

        $student = Student::create([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        // Asociar el estudiante con el curso
        $student->courses()->attach($validated['course_id']);

        return redirect()
            ->route('students.index')
            ->with('success', 'Estudiante creado exitosamente');
    }

    public function edit($id)
    {
        $student = Student::with('courses')->findOrFail($id);
        $courses = Course::orderBy('name')->get();
        $currentCourseId = $student->courses->first()->id ?? null;
        
        return view('student.edit', compact('student', 'courses', 'currentCourseId'));
    }

    //
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'course_id' => 'required|exists:courses,id'
        ]);

        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        // Sincronizar el curso (esto eliminará otros cursos y dejará solo el seleccionado)
        $student->courses()->sync([$validated['course_id']]);

        return redirect()
            ->route('students.index')
            ->with('success', 'Estudiante actualizado exitosamente');
    }

    public function show(Student $student)
    {
       //dd($student->name);
       return view('student.show',compact('student'));
    }

    //
    public function destroy(Request $request,Student $student){
       //dd( $student->id);
       $student->delete();
       return redirect()->route('students.index')->with('success','Estudiante '.$student->id.' se elimino');
    }
}
