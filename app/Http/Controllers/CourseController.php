<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
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
} 