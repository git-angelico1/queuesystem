<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsesController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\StudController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\KioskController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\Auth\LoginRegisterController;



Route::get('/', function () {
    return view('Kiosk.kioskmain');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
   
    Route::get('/dashboard',[UsesController::class,'index'])->name('dashboard');
    
});

Route::get('department_login', [UsesController::class, 'department_login'])->name('emp-login'); 

Route::get('fetch_video',[App\Http\Controllers\VideoController::class,'fetch']);

Route::get('upload',[App\Http\Controllers\VideoController::class,'upload']);

Route::delete('/delete-video/{id}',[App\Http\Controllers\VideoController::class,'delete'])->name('delete.video');

Route::post('insert_video',[App\Http\Controllers\VideoController::class,'insert'])->name('insert.file');
Route::get('/live-monitor',[App\Http\Controllers\VideoController::class,'liveMonitor'])->name('live-monitor');
Route::get('/a4tech',[App\Http\Controllers\VideoController::class,'a4tech'])->name('monitor');


Route::get('studentdepartment',[StudController::class, 'studentdepartment']);
Route::get('visitordepartment',[StudController::class, 'visitordepartment']);
Route::get('visitor',[StudController::class, 'visitor']);
Route::post('visitor',[StudController::class, 'save2'])->name('info.save2');
Route::get('kiosk',[StudController::class, 'kiosk']);
Route::get('generate',[StudController::class, 'generate']);
Route::get('emp',[StudController::class, 'emp1']);
Route::post('next', [StudController::class, 'next'])->name('next.student');
Route::get('register',[AccountController::class, 'register']);
Route::get('student',[KioskController::class, 'index']);
Route::post('student',[KioskController::class, 'Infosave'])->name('info.save');


//REGISTRAR ROUTES
Route::get('registrar_department',[RegistrarController::class,'registrar_department']);
Route::get('registrar_department2',[RegistrarController::class,'registrar_department2']);
Route::post('registrar_department',[RegistrarController::class, 'reg_save'])->name('registrar.save');
Route::post('next', [RegistrarController::class, 'next'])->name('next.student');

Route::group(['middleware' => 'auth.registrar'], function () {
Route::get('registrar_controller',[RegistrarController::class, 'registrar_controller']); 
});

Route::get('/registrar_login', [RegistrarController::class, 'showLoginForm'])->name('registrar.login');
Route::post('/registrar_login', [RegistrarController::class, 'authenticate']);
Route::get('nextFunction', [RegistrarController::class,'nextFunction'])->name('nextFunction.fetch');
Route::get('reg_queue', [RegistrarController::class, 'reg_queue']);
Route::post('check_queue', [RegistrarController::class, 'check_queue']);
Route::get('reg_controller',[RegistrarController::class, 'reg_controller']);
Route::get('Speech',[RegistrarController::class, 'Speech']);
Route::post('notify', [RegistrarController::class, 'notify'])->name('notify_student');
Route::view('employee_registrar', [RegistrarController::class, 'Employee.Registrar'])->name('Employee.Registrar');
Route::post('registar_logout', [RegistrarController::class, 'logout'])->name('registrar.logout');


//CASHIER ROUTES
Route::get('cashier_department',[CashierController::class,'cashier_department']);
Route::get('cashier_department2',[CashierController::class,'cashier_department2']);
Route::post('next2', [CashierController::class, 'next2'])->name('next.student2'); 
Route::post('cashier_department',[CashierController::class, 'cash_save'])->name('cash.save');

Route::group(['middleware' => 'auth'], function () {
Route::get('cashier_controller',[CashierController::class, 'cashier_controller']);
});

Route::get('cash_controller',[CashierController::class, 'cash_controller']);
Route::get('/cashier_login', [CashierController::class, 'showLoginForm'])->name('cashier.login');
Route::post('/cashier_login', [CashierController::class, 'authenticate']);
Route::view('employee_cashier', 'Employee.Cashier')->name('Employee.Cashier');
Route::post('cashier_logout', [CashierController::class, 'logout'])->name('cashier.logout');


//FINANCE ROUTES
Route::get('finance_department',[FinanceController::class,'finance_department']);
Route::get('finance_department2',[FinanceController::class,'finance_department2']); 
Route::post('next3', [FinanceController::class, 'next3'])->name('next.student3');
Route::post('finance_department',[FinanceController::class, 'fin_save'])->name('fin.save');

Route::group(['middleware' => 'auth'], function () {
Route::get('finance_controller',[FinanceController::class, 'finance_controller']);
});
Route::get('fin_controller',[FinanceController::class, 'fin_controller']);
Route::get('example',[FinanceController::class, 'example']);
Route::get('display',[FinanceController::class, 'display']);
Route::get('finance_login', [FinanceController::class, 'showLoginForm'])->name('finance.login');
Route::post('finance_login', [FinanceController::class, 'authenticate']);
Route::post('finance_logout', [FinanceController::class, 'logout'])->name('finance.logout');
Route::view('employee_finance', 'Employee.Finance')->name('Employee.Finance');
