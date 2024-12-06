<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('subject');

        // Filtro por nombre del curso
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Filtro por materia
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $courses = $query->paginate(10);
        $subjects = Subject::all();

        return view('courses.index', compact('courses', 'subjects'));
    }

    public function show(Course $course)
    {
        $course->load(['subject', 'students', 'commissions']);
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('courses.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id'
        ]);

        Course::create($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Curso creado exitosamente');
    }

    public function edit(Course $course)
    {
        $students = Student::orderBy('name')->get();
        $currentStudents = $course->students->pluck('id')->toArray();
        $subjects = Subject::orderBy('name')->get();
        
        return view('courses.edit', compact('course', 'students', 'currentStudents', 'subjects'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'students' => 'array'
        ]);

        $course->update([
            'name' => $validated['name'],
            'subject_id' => $validated['subject_id']
        ]);

        // Sincronizar estudiantes si se proporcionaron
        if (isset($validated['students'])) {
            $course->students()->sync($validated['students']);
        }

        return redirect()
            ->route('courses.index')
            ->with('success', 'Curso actualizado exitosamente');
    }
} 