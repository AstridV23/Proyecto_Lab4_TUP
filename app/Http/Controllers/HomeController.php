<?php

namespace App\Http\Controllers;

use App\Models\Subject; 
use App\Models\Course;
use App\Models\Commission;
use App\Models\Student; 
use App\Models\Professor; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    /*
    public function index(Request $request)
    {
        // Obtener el término de búsqueda desde la URL
        $searchTerm = $request->get('search', '');

        // Realizar búsquedas en las diferentes tablas
        $subjects = Subject::where('name', 'like', '%' . $searchTerm . '%')->get();
        $courses = Course::where('name', 'like', '%' . $searchTerm . '%')->get();
        $commissions = Commission::where('aula', 'like', '%' . $searchTerm . '%')
            ->orWhere('horario', 'like', '%' . $searchTerm . '%')->get();
        $students = Student::where('name', 'like', '%' . $searchTerm . '%') 
            ->orWhere('gmail', 'like', '%' . $searchTerm . '%')->get();
        $professors = Professor::where('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('specialization', 'like', '%' . $searchTerm . '%')->get();

        // Pasar los resultados a la vista
        return view('home', compact('subjects', 'courses', 'commissions', 'students', 'professors', 'searchTerm'));
    }*/
}
