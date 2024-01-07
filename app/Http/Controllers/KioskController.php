<?php

namespace App\Http\Controllers;
use App\Models\Kiosk;
use App\Helpers\Helper;
use App\Models\Student;
use Illuminate\Http\Request;

class KioskController extends Controller
{
    function index(){
        return view('Student.index');
}
    function index2(){
    return view('Student.generatenumber');
}
   
    public function Infosave(Request $request)
{
    
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'stud_id' => 'required|string|max:20',
        'contact' => 'required|string|max:20',
        'department' => 'required|string',
    ]);

    
    $kiosk = new Kiosk;
    $kiosk->name = $request->input('name');
    $kiosk->stud_id = $request->input('stud_id');
    $kiosk->contact = $request->input('contact');
    $kiosk->department = $request->input('department');
    $kiosk->save();


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

}
