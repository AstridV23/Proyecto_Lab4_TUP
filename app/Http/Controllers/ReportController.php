<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Commission;
use App\Models\Professor;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Services\ExportService;
use Shuchkin\SimpleXLSXGen;

class ReportController extends Controller
{
    protected $exportService;

    public function __construct(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }

    public function index()
    {
        return view('reports.index');
    }

    public function students()
    {
        $students = Student::with(['courses.subject', 'courses.commissions'])
            ->paginate(10)
            ->through(function ($student) {
                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'enrollments' => $student->courses->map(function ($course) {
                        return [
                            'course' => $course->name,
                            'subject' => $course->subject->name,
                            'commission' => $course->commissions->first()->name ?? 'Sin comisión'
                        ];
                    })
                ];
            });

        return view('reports.students', compact('students'));
    }

    public function courses()
    {
        $subjects = Subject::with(['courses.commissions'])
            ->get()
            ->map(function ($subject) {
                return [
                    'name' => $subject->name,
                    'courses' => $subject->courses->map(function ($course) {
                        return [
                            'name' => $course->name,
                            'commissions_count' => $course->commissions->count()
                        ];
                    })
                ];
            });

        return view('reports.courses', compact('subjects'));
    }

    public function commissions()
    {
        $commissions = Commission::with(['course.subject', 'professors'])
            ->get()
            ->map(function ($commission) {
                return [
                    'id' => $commission->id,
                    'classroom' => $commission->classroom,
                    'schedule' => $commission->schedule,
                    'course' => $commission->course->name,
                    'subject' => $commission->course->subject->name,
                    'professors' => $commission->professors->pluck('name')
                ];
            });

        return view('reports.commissions', compact('commissions'));
    }

    public function professors()
    {
        $professors = Professor::with('commissions.course')
            ->get()
            ->map(function ($professor) {
                return [
                    'id' => $professor->id,
                    'name' => $professor->name,
                    'commissions' => $professor->commissions->map(function ($commission) {
                        return [
                            'name' => $commission->name,
                            'course' => $commission->course->name,
                            'schedule' => $commission->schedule
                        ];
                    })
                ];
            });

        return view('reports.professors', compact('professors'));
    }

    public function exportStudentsPdf()
    {
        $students = $this->getStudentsForExport();
        return $this->exportService->toPdf(['students' => $students], 'reports.exports.students-pdf', 'students');
    }


public function exportStudentsExcel()
{
    // Obtener los estudiantes
    $students = Student::select('id', 'name', 'email', 'created_at', 'updated_at')->get();

    // Preparar los datos con los encabezados
    $data = [
        ['ID', 'Nombre', 'Correo', 'Creado el', 'Actualizado el'], // Encabezados
    ];

    // Agregar los datos de los estudiantes
    foreach ($students as $student) {
        $data[] = [$student->id, $student->name, $student->email, $student->created_at, $student->updated_at];
    }

    // Generar el archivo Excel
    $xlsx = SimpleXLSXGen::fromArray($data);

    // Descargar el archivo Excel
    return $xlsx->downloadAs('estudiantes.xlsx');
}

public function exportStudentsHTML()
{
    $students = \App\Models\Student::all();

    $output = '<table border="1">';
    $output .= '<tr><th>ID</th><th>Nombre</th><th>Email</th></tr>';

    foreach ($students as $student) {
        $output .= '<tr>';
        $output .= "<td>{$student->id}</td>";
        $output .= "<td>{$student->nombre}</td>";
        $output .= "<td>{$student->email}</td>";
        $output .= "<td>{$student->created_at}</td>";
        $output .= "<td>{$student->updated_at}</td>";
        $output .= '</tr>';
    }

    $output .= '</table>';

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="estudiantes.xls"');
    echo $output;
    exit;
}

    private function getStudentsForExport()
    {
        return Student::with(['courses.subject', 'courses.commissions'])->get()
            ->map(function ($student) {
                return [
                    'Nombre' => $student->name,
                    'Email' => $student->email,
                    'Cursos' => $student->courses->pluck('name')->implode(', ')
                ];
            });
    }

    public function exportCoursesPdf()
    {
        $courses = $this->getCoursesForExport();
        return $this->exportService->toPdf(['students' => $courses], 'reports.exports.courses-pdf', 'curso');
    }
}
