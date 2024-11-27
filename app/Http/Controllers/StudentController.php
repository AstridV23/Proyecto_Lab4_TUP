<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;

class StudentController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Student::with('courses');

        // Búsqueda global
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('courses', function($q) use ($searchTerm) {
                      $q->where('name', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        // Filtros específicos existentes
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->filled('course_id')) {
            $query->whereHas('courses', function($q) use ($request) {
                $q->where('courses.id', $request->course_id);
            });
        }

        $students = $query->paginate(10);
        $courses = Course::all();

        return view('student.index', compact('students', 'courses'));
    }

    //
    public function create()
    {
        return view('student.edit');
    }

    //
    public function store(Request $request){
      
      //dd($request->name .' email    '.$request->email);

      $v= $request->validate(
        ['name'=>'required|string|max:255',
         'email'=>'required|email|unique:students,email,']
      );
        $student = new Student();
        $student->name = $request->name; 
        $student->email = $request->email;      
        $student->course_id =$request->course_id;
        $student->save();

    
    
        return redirect()->route('students.index')->with('success','Estudiante creado');




    }

    public function edit($id)
    {
        $student = Student::find($id);
        return view('student.edit',compact('student'));
    }

    //
    public function update(Request $request, Student $student){

        //dd($request->course_id);
        $v= $request->validate(
            ['name'=>'required|string|max:255',
            'email'=>'required|email|unique:students,email,'.$student->id, 
            'course_id'=>'required']
        );

        $student->update($v);
        
        return redirect()->route('students.index')->with('success','Estudiante acctualizado');
    }

    public function show(Student $student)
    {
       //dd($student->name);
       return view('student.show',compact('student'));
    }

    //
    public function destroy(Request $request,Student $student){
       //dd( $student->id);
       $student->delete();
       return redirect()->route('students.index')->with('success','Estudiante '.$student->id.' se elimino');
    }
}
