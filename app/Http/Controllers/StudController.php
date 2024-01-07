<?php

namespace App\Http\Controllers;
use App\Helpers\Helper;
use App\Models\Student;
use App\Models\Kiosk;
use Illuminate\Http\Request;

class StudController extends Controller
{
    function index(){
        $students = Student::all();

         return view('Student.index', compact('students'));
    }
    //DEPARTMENT
    function visitordepartment(){
        return view('Visitor.selectdep');
    }
    function studentdepartment(){
        return view('Student.selectdep');
    }

    public function emp1(){
        $kiosk = Kiosk::all();
        
        $latestStudent = Student::latest()->first(); 
         
    
        return view('Employee.index', ['latestStudent' => $latestStudent]);
    }
    //KIOSK
    function kiosk(){
        return view('Kiosk.kioskmain');
    }
    function visitor(){
        return view('Visitor.index');
    }
    function generate(){
        $latestStudent = Student::latest()->first();
        if (!$latestStudent) {
            $latestStudent = new Student;
            $latestStudent->student_id = 'C-1';
        } else {
            $lastStudentNumber = $latestStudent->student_id;
            $numericPart = intval(substr($lastStudentNumber, 2)); 
            $newNumericPart = ($numericPart % 20) + 1; 
            $latestStudent->student_id = 'C-' . $newNumericPart;
        }
    
        return view('Student.generatenumber', compact('latestStudent'));
    }
    function save2(Request $request){
        $latestStudent = Student::latest()->first();
        
        $name = $request->name;
        $student_id = Helper::IDGenerator(new Student, 'student_id', 2, 'C');

        $q = new Student;
        $q ->student_id = $student_id;
        $q ->name = $name;
        $q->save();

        if (!$latestStudent) {
            $latestStudent = new Student;
            $latestStudent->student_id = 'C-1';
        } else {
            
            $lastStudentNumber = $latestStudent->student_id;
            $numericPart = intval(substr($lastStudentNumber, 2)); 
            $newNumericPart = ($numericPart % 20) + 1; 
            $latestStudent->student_id = 'C-' . $newNumericPart;
        }
    
        return view('Student.generatenumber', compact('latestStudent'));
    }
    function serve(Request $request){
        $latestStudent = Student::latest()->first();
        
        $name = $request->name;
        $student_id = Helper::IDGenerator(new Student, 'student_id', 2, 'C');

        $q = new Student;
        $q ->student_id = $student_id;
        $q ->name = $name;
        $q->save();

        if (!$latestStudent) {
            $latestStudent = new Student;
            $latestStudent->student_id = 'C-1';
        } else {
            
            $lastStudentNumber = $latestStudent->student_id;
            $numericPart = intval(substr($lastStudentNumber, 2)); 
            $newNumericPart = ($numericPart % 20) + 1; 
            $latestStudent->student_id = 'C-' . $newNumericPart;
        }
    
        return view('Student.generatenumber', compact('latestStudent'));
    }
    //NEXT
    public function next()
    {
        
        $nextStudent = Student::orderBy('created_at', 'asc')->first();

        if ($nextStudent) {
            $nextStudent->delete();
            return redirect()->back()->with('success', 'Now serving: ' . $nextStudent->student_id);
        } else {
            return redirect()->back()->with('info', 'Queue is empty.');
        }
    }
}
