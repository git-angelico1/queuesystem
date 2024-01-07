<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;

class UsesController extends Controller
{
    public function index(){

        $users = User::orderBy('last_seen','DESC')->get();

        return view('dashboard',compact('users'));
    }
    
    function department_login(){
        return view('Employee.login');
    }
    
}
