<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Commission;
use App\Models\Professor;
use App\Models\Subject;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function students()
    {
        $students = Student::with(['courses.subject', 'courses.commissions'])
            ->get()
            ->map(function ($student) {
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
}
