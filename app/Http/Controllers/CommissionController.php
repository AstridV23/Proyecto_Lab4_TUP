<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Course;
use App\Models\Professor;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Commission::with(['course', 'professors']);

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('horario')) {
            $query->where('horario', 'LIKE', '%' . $request->horario . '%');
        }

        $commissions = $query->paginate(10);
        $courses = Course::all();

        return view('commissions.index', compact('commissions', 'courses'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('commissions.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'aula' => 'required|string|max:255',
            'horario' => 'required|string|max:255'
        ]);

        Commission::create($validated);

        return redirect()
            ->route('commissions.index')
            ->with('success', 'Comisión creada exitosamente');
    }

    public function edit(Commission $commission)
    {
        $courses = Course::all();
        return view('commissions.edit', compact('commission', 'courses'));
    }

    public function update(Request $request, Commission $commission)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'aula' => 'required|string|max:255',
            'horario' => 'required|string|max:255'
        ]);

        $commission->update($validated);

        return redirect()
            ->route('commissions.index')
            ->with('success', 'Comisión actualizada exitosamente');
    }

    public function destroy(Commission $commission)
    {
        $commission->delete();

        return redirect()
            ->route('commissions.index')
            ->with('success', 'Comisión eliminada exitosamente');
    }

    public function showAssignProfessor(Commission $commission)
    {
        $professors = Professor::all();
        $assignedProfessors = $commission->professors->pluck('id')->toArray();
        
        return view('commissions.assign-professor', compact('commission', 'professors', 'assignedProfessors'));
    }

    public function assignProfessor(Request $request, Commission $commission)
    {
        $validated = $request->validate([
            'professor_ids' => 'required|array',
            'professor_ids.*' => 'exists:professors,id'
        ]);

        $commission->professors()->sync($request->professor_ids);

        return redirect()
            ->route('commissions.index')
            ->with('success', 'Profesores asignados exitosamente');
    }
} 