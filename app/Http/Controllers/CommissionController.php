<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Course;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Commission::with(['course', 'professors']);

        // Filtro por curso
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // Filtro por horario
        if ($request->filled('horario')) {
            $query->where('horario', 'LIKE', '%' . $request->horario . '%');
        }

        $commissions = $query->paginate(10);
        $courses = Course::all();

        return view('commissions.index', compact('commissions', 'courses'));
    }
} 