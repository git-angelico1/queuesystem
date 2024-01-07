<?php

namespace App\Http\Controllers;
use App\Models\Finance; 
use App\Helpers\Finance_Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    
    function finance_department(){

        return view('Finance.finance');
    
    }
    function finance_department2(){

        return view('Finance.visitor_finance'); 
    
    }
    function fin_controller(){
        return view('Employee.FinCon');
    }
      
    function finance_controller(){
    
        $latestStudent = Finance::latest()->first(); 
    
        return view('Employee.Finance', ['latestStudent' => $latestStudent]);
    }
    public function fin_save(Request $request){
        $validatedData = $request->validate([
            'fin_name' => 'required|string|max:30',
            'fin_studentId' => 'required|string|max:15',
            'fin_studentContact' => 'nullable|string|max:255', 
            'fin_purpose' => 'required|string|max:255',
            'fin_otherPurpose' => 'nullable|string|max:255',
        ]);
     
        //OTHER CONDITION
        
        $latestStudent = Finance::latest()->first();
        $fin_generate = Finance_Helper::Fin_Generator(new Finance, 'fin_generate', 2, 'F');
    
        // user record
        $fin = new Finance;
        $fin->fin_name = $request->input('fin_name');
        $fin->fin_studentId = $request->input('fin_studentId');
        $fin->fin_studentContact = $request->input('fin_studentContact');
        $fin->fin_purpose = $request->input('fin_purpose');
        $fin->fin_otherPurpose = $request->input('fin_otherPurpose');
        $fin->fin_generate = $fin_generate;
        $fin->save();   
    
        //GENERATE CONDITION
        if (!$latestStudent) {
            $latestStudent = new Finance;
            $latestStudent->fin_generate = '1-Finance Department';
        } else {
            $lastStudentNumber = $latestStudent->fin_generate;
            $numericPart = intval(substr($lastStudentNumber, 2)); 
            $newNumericPart = ($numericPart % 20) + 1; 
            $latestStudent->fin_generate =  $newNumericPart. '-Finance Department' ;
        }
        //Change Finance.Generated Numbers
        return view('Student.fingenerate', compact('latestStudent'));
        }
    
        //NEXT AND AUTOMATIC DELETE DATA IN DATABASE
        public function next3()
        {
            $nextStudent = Finance::orderBy('created_at', 'asc')->first();
    
            if ($nextStudent) {
                $nextStudent->delete();
                return redirect()->back()->with('success', 'Now serving: ' . $nextStudent->fin_generate);
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
    
        $earliestSql = "SELECT * FROM finance ORDER BY created_at ASC LIMIT 1"; 
    
        $result = $mysqli->query($earliestSql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $queuenumber = $row['fin_generate'];
            $studentname = $row['fin_name'];
            $studentID = $row['fin_studentId'];
    
            $queueHtml = "Queue Number: " . $queuenumber . "<br>";
            $queueHtml .= "Name: " . $studentname . "<br>";
            $queueHtml .= "ID: " .  $studentID . "<br>";
    
            return response()->json($queueHtml);
        } else {
            return response()->json('---');
        }
    
        $mysqli->close();
    }

    public function showLoginForm()
    {
        return view('accountLogin.financeLogin');
    }

    public function authenticate(Request $request)
    {
        $username = $request->input('Username');
        $password = $request->input('Password');
    
        if ($username === 'Finance' && $password === 'Finance2023') {

            return redirect()->route('Employee.Finance');
        } 
    
        return redirect()->back()->with('error', 'Invalid username or password');
    }
    //logout
    public function logout(Request $request)
    {
        Auth::guard('finance')->logout(); 

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('emp-login'))->with('success', 'You have been logged out.');
    }
        
}
