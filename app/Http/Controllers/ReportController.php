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
            ->paginate(10)
            ->through(function ($commission) {
                return [
                    'id' => $commission->id,
                    'subject' => $commission->course->subject->name,
                    'course' => $commission->course->name,
                    'classroom' => $commission->classroom,
                    'schedule' => $commission->schedule,
                    'professors' => $commission->professors->pluck('name')
                ];
            });

        return view('reports.commissions', compact('commissions'));
    }

    public function professors()
    {
        $professors = Professor::with(['commissions.course'])
            ->orderBy('name')
            ->paginate(10);
        
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
        $subjects = $this->getCoursesForExport();
        return $this->exportService->toPdf(['subjects' => $subjects], 'reports.exports.courses-pdf', 'cursos-por-materia');
    }

    public function exportCoursesExcel()
    {
        $subjects = Subject::with(['courses' => function($query) {
            $query->withCount(['commissions', 'students']);
        }])->get();

        $data = [
            ['Materia', 'Curso', 'Cantidad de Comisiones', 'Cantidad de Estudiantes']
        ];

        foreach ($subjects as $subject) {
            foreach ($subject->courses as $course) {
                $data[] = [
                    $subject->name,
                    $course->name,
                    $course->commissions_count,
                    $course->students_count
                ];
            }
        }

        $xlsx = SimpleXLSXGen::fromArray($data);
        return $xlsx->downloadAs('cursos-por-materia.xlsx');
    }

    private function getCoursesForExport()
    {
        return Subject::with(['courses' => function($query) {
            $query->withCount(['commissions', 'students']);
        }])->get()->map(function ($subject) {
            return [
                'name' => $subject->name,
                'courses' => $subject->courses->map(function ($course) {
                    return [
                        'name' => $course->name,
                        'commissions_count' => $course->commissions_count,
                        'students_count' => $course->students_count
                    ];
                })
            ];
        });
    }

    public function exportCommissionsPdf()
    {
        $commissions = $this->getCommissionsForExport();
        return $this->exportService->toPdf(
            ['commissions' => $commissions], 
            'reports.exports.commissions-pdf', 
            'comisiones'
        );
    }

    public function exportCommissionsExcel()
    {
        $commissions = Commission::with(['course.subject', 'professors'])->get();
        
        $data = [
            ['Materia', 'Curso', 'Aula', 'Horario', 'Profesores']
        ];

        foreach ($commissions as $commission) {
            $data[] = [
                $commission->course->subject->name,
                $commission->course->name,
                $commission->classroom,
                $commission->schedule,
                $commission->professors->pluck('name')->implode(', ')
            ];
        }

        $xlsx = SimpleXLSXGen::fromArray($data);
        return $xlsx->downloadAs('comisiones.xlsx');
    }

    private function getCommissionsForExport()
    {
        return Commission::with(['course.subject', 'professors'])->get()
            ->map(function ($commission) {
                return [
                    'Materia' => $commission->course->subject->name,
                    'Curso' => $commission->course->name,
                    'Aula' => $commission->classroom,
                    'Horario' => $commission->schedule,
                    'Profesores' => $commission->professors->pluck('name')->implode(', ')
                ];
            });
    }

    public function exportProfessorsPdf()
    {
        $professors = Professor::with(['commissions.course'])
            ->get()
            ->map(function ($professor) {
                $horarios = $professor->commissions->map(function ($commission) {
                    return $commission->schedule;
                })->unique()->implode("\n");

                return [
                    'Profesor' => $professor->name,
                    'Email' => $professor->email,
                    'Comisiones' => $professor->commissions->map(function ($commission) {
                        return $commission->course->name;
                    })->unique()->implode(', '),
                    'Horarios' => $horarios,
                    'Estado' => 'Activo'
                ];
            });

        return $this->exportService->toPdf(
            ['professors' => $professors], 
            'reports.exports.professors-pdf', 
            'profesores'
        );
    }

    public function exportProfessorsExcel()
    {
        $professors = $this->getProfessorsForExport();
        
        $data = [
            ['Profesor', 'Email', 'Comisiones', 'Horarios', 'Estado']
        ];

        foreach ($professors as $professor) {
            $data[] = [
                $professor->name,
                $professor->email,
                $professor->commissions->pluck('course.name')->implode(', '),
                $professor->commissions->pluck('schedule')->implode(', '),
                'Activo'
            ];
        }

        $xlsx = SimpleXLSXGen::fromArray($data);
        return $xlsx->downloadAs('profesores.xlsx');
    }

    private function getProfessorsForExport()
    {
        return Professor::with(['commissions.course'])
            ->orderBy('name')
            ->get();
    }

}
