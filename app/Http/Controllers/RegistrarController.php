<?php

namespace App\Http\Controllers;

use App\Models\Registrar; 
use App\Helpers\Registrar_Helper;
use Illuminate\Http\Request;
use App\Events\BeforeNextStudentNotification;
use Illuminate\Support\Facades\Auth;

class RegistrarController extends Controller
{

function registrar_department(){

    return view('Registrar.registrar');

}
function registrar_department2(){

    return view('Registrar.visitor_registrar');

}
 
function registrar_controller(){

    $latestStudent = Registrar::latest()->first(); 

    return view('Employee.Registrar', ['latestStudent' => $latestStudent]);
}

function reg_queue(){
    return view('Employee.NextQueue');

}
function check_queue(){
    return view('Employee.NotifQueue');
}
public function Speech(){
    return view('speech.speech');
}

function reg_controller(){
    return view('Employee.Content');
}

public function reg_save(Request $request){
    
    $validatedData = $request->validate([
        'reg_name' => 'required|string|max:255',
        'reg_studentId' => 'required|string|max:255',
        'reg_studentContact' => 'nullable|string|max:255', 
        'reg_purpose' => 'required|string|max:255',
        'reg_otherPurpose' => 'nullable|string|max:255', 
    ]);
    
    //OTHER CONDITION
    
    $latestStudent = Registrar::latest()->first();
    $reg_generate = Registrar_Helper::Reg_Generator(new Registrar, 'reg_generate', 2, 'R');

    // user record
    $reg = new Registrar;
    $reg->reg_name = $request->input('reg_name');
    $reg->reg_studentId = $request->input('reg_studentId');
    $reg->reg_studentContact = $request->input('reg_studentContact');
    $reg->reg_purpose = $request->input('reg_purpose');
    $reg->reg_otherPurpose = $request->input('reg_otherPurpose');
    $reg->reg_generate = $reg_generate;
    $reg->save();   

    //GENERATE CONDITION
    if (!$latestStudent) {
        $latestStudent = new Registrar;
        $latestStudent->reg_generate = '1-Registrar Department';
    } else {
        $lastStudentNumber = $latestStudent->reg_generate;
        $numericPart = intval(substr($lastStudentNumber, 2)); 
        $newNumericPart = ($numericPart % 20) + 1; 
        $latestStudent->reg_generate =  $newNumericPart. '-Registrar Department' ;
    }

    return view('Student.generatenumber', compact('latestStudent'));
    }

    //NEXT AND AUTOMATIC DELETE DATA IN DATABASE
    public function next()
    {
        $nextStudent = Registrar::orderBy('created_at', 'asc')->first();

        if ($nextStudent) {
            $nextStudent->delete();
            return redirect()->back()->with('success', 'Now serving: ' . $nextStudent->reg_generate);
        } else {
            return redirect()->back()->with('info', 'Queue is empty.');
        }
    }

    public function notify()
    {
    $nextStudent = Registrar::orderBy('created_at', 'asc')->first();

    if ($nextStudent) {

        event(new BeforeNextStudentNotification($nextStudent));

        return redirect()->back()->with('success', 'Notified: ' . $nextStudent->reg_generate);
    } else {
        return redirect()->back()->with('info', 'Queue is empty.');
    }
    }

  
    public function nextFunction()
    {
    $mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error); 
    }

    $earliestSql = "SELECT * FROM registrar ORDER BY created_at ASC LIMIT 1"; 

    $result = $mysqli->query($earliestSql);
 
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $queuenumber = $row['reg_generate'];
        $studentname = $row['reg_name'];
        $studentID = $row['reg_studentId'];
        $Purpose = $row['reg_purpose'];

        $queueHtml = "Queue Number: " . $queuenumber . "<br>";
        $queueHtml .= "Name: " . $studentname . "<br>";
        $queueHtml .= "ID: " .  $studentID . "<br>";
        $queueHtml .= "Purpose: " .  $Purpose . "<br>";

        return response()->json($queueHtml);
    } else {
        return response()->json('---');
    }

    $mysqli->close();
    }

    //LOGIN
    
    public function showLoginForm()
    {
        return view('accountLogin.registrarLogin'); 
    }

    public function authenticate(Request $request)
    {
        $username = $request->input('Username');
        $password = $request->input('Password');
    
        if ($username === 'Registrar' && $password === 'Registrar2023') {

            return redirect()->route('Employee.Registrar'); 
        }
    
        return redirect()->back()->with('error', 'Invalid username or password');
    }
    public function logout(Request $request)
    {
        Auth::guard('registrar')->logout(); 

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('emp-login'))->with('success', 'You have been logged out.');
    }
    
} 
