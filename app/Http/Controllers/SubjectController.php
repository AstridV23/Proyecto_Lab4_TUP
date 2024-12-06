<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Course;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::with('courses');

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $subjects = $query->paginate(10);
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects',
            'courses' => 'required|array|min:1',
            'courses.*' => 'required|string|max:255'
        ]);

        $subject = Subject::create([
            'name' => $validated['name']
        ]);

        // Crear los cursos asociados
        foreach ($validated['courses'] as $courseName) {
            Course::create([
                'name' => $courseName,
                'subject_id' => $subject->id
            ]);
        }

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Materia y cursos creados exitosamente');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
            'courses' => 'required|array|min:1',
            'courses.*' => 'required|string|max:255'
        ]);

        $subject->update([
            'name' => $validated['name']
        ]);

        // Obtener los IDs de los cursos actuales
        $currentCourseIds = $subject->courses->pluck('id')->toArray();
        
        // Actualizar cursos existentes y crear nuevos
        foreach ($validated['courses'] as $index => $courseName) {
            if (isset($currentCourseIds[$index])) {
                // Actualizar curso existente
                Course::where('id', $currentCourseIds[$index])
                      ->update(['name' => $courseName]);
            } else {
                // Crear nuevo curso
                Course::create([
                    'name' => $courseName,
                    'subject_id' => $subject->id
                ]);
            }
        }

        // Eliminar cursos que ya no están en la lista
        if (count($validated['courses']) < count($currentCourseIds)) {
            Course::whereIn('id', array_slice($currentCourseIds, count($validated['courses'])))
                  ->delete();
        }

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Materia y cursos actualizados exitosamente');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()
            ->route('subjects.index')
            ->with('success', 'Materia eliminada exitosamente');
    }
} 