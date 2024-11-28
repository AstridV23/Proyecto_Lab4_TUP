<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Commission;
use App\Models\Professor;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Services\ExportService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GenericExport;

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
        return $this->exportService->toPdf(['students' => $students], 'reports.exports.students-pdf', 'estudiantes');
    }

    public function exportStudentsExcel()
    {
        $students = $this->getStudentsForExport()->toArray();
        return Excel::download(new GenericExport($students), 'estudiantes.xlsx');
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
}
