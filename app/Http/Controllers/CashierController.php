<?php

namespace App\Http\Controllers;
use App\Models\Cashier; 
use App\Helpers\Cashier_Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    function cashier_department(){
 
        return view('Cashier.cashier');
    
    }
    function cashier_department2(){
        return view('Cashier.visitor_cashier');
    }

    function cash_controller(){
        return view('Employee.CashCon');
    }
     
    function cashier_controller(){
    
        $latestStudent = Cashier::latest()->first(); 
        
        return view('Employee.Cashier', ['latestStudent' => $latestStudent]);
    }
    public function cash_save(Request $request){
        $validatedData = $request->validate([
            'cash_name' => 'required|string|max:30',
            'cash_studentId' => 'required|string|max:15',
            'cash_studentContact' => 'nullable|string|max:255', 
            'cash_purpose' => 'required|string|max:255',
            'cash_otherPurpose' => 'nullable|string|max:255', 
        ]);
    
        //OTHER CONDITION
        
        $latestStudent = Cashier::latest()->first();
        $cash_generate = Cashier_Helper::Cash_Generator(new Cashier, 'cash_generate', 2, 'C');
    
        // user record
        $cash = new Cashier;
        $cash->cash_name = $request->input('cash_name');
        $cash->cash_studentId = $request->input('cash_studentId');
        $cash->cash_studentContact = $request->input('cash_studentContact');
        $cash->cash_purpose = $request->input('cash_purpose');
        $cash->cash_otherPurpose = $request->input('cash_otherPurpose');
        $cash->cash_generate = $cash_generate;
        $cash->save();   
    
        //GENERATE CONDITION
        if (!$latestStudent) {
            $latestStudent = new Cashier;
            $latestStudent->cash_generate = '1-Cashier Department';
        } else {
            $lastStudentNumber = $latestStudent->cash_generate;
            $numericPart = intval(substr($lastStudentNumber, 2)); 
            $newNumericPart = ($numericPart % 20) + 1; 
            $latestStudent->cash_generate =  $newNumericPart. '-Cashier Department' ;
        }
        //Change Cashier.Generated Numbers
        return view('Student.cash_generate_number', compact('latestStudent'));
        }
    
        //NEXT AND AUTOMATIC DELETE DATA IN DATABASE
        public function next2()
        {
            $nextStudent = Cashier::orderBy('created_at', 'asc')->first();
    
            if ($nextStudent) {
                $nextStudent->delete();
                return redirect()->back()->with('success', 'Now serving: ' . $nextStudent->cash_generate);
            } else {
                return redirect()->back()->with('info', 'Queue is empty.');
            }
        }
    
        public function fetchNextQueue()
    {
        $mysqli = new mysqli("127.0.0.1", "root", "", "demo1");
    
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
    
        $earliestSql = "SELECT * FROM cashier ORDER BY created_at ASC LIMIT 1"; 
    
        $result = $mysqli->query($earliestSql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $queuenumber = $row['cash_generate'];
            $studentname = $row['cash_name'];
            $studentID = $row['cash_studentId'];
    
            $queueHtml = "Queue Number: " . $queuenumber . "<br>";
            $queueHtml .= "Name: " . $studentname . "<br>";
            $queueHtml .= "ID: " .  $studentID . "<br>";
    
            return response()->json($queueHtml);
        } else {
            return response()->json('---');
        }
    
        $mysqli->close();
    }
    //LOGIN
    public function showLoginForm()
    {
        return view('accountLogin.cashierLogin'); 
    }

    public function authenticate(Request $request)
    {
        $username = $request->input('Username');
        $password = $request->input('Password');
    
        if ($username === 'Cashier' && $password === 'Cashier2023') {

            return redirect()->route('Employee.Cashier'); 
        }
    
        return redirect()->back()->with('error', 'Invalid username or password');
    }
    
    public function logout(Request $request)
    {
        Auth::guard('cashier')->logout(); 

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('emp-login'))->with('success', 'You have been logged out.');
    }
    
        
}

