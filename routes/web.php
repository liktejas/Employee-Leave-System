<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/','login');
Route::post('/login',[MainController::class, 'login']);
Route::get('/dashboard',[MainController::class, 'dashboard']);
Route::get('/logout',[MainController::class, 'logout']);
Route::post('/adddept',[MainController::class, 'adddept']);
Route::post('/edit_dept',[MainController::class, 'edit_dept']);
Route::get('/delete_dept/{id}',[MainController::class, 'delete_dept']);
Route::get('/leave_type',[MainController::class, 'leave_type']);
Route::post('/add_leave_type',[MainController::class, 'add_leave_type']);
Route::post('/edit_leave_type',[MainController::class, 'edit_leave_type']);
Route::get('/delete_leave_type/{id}',[MainController::class, 'delete_leave_type']);
Route::get('/employee',[MainController::class, 'employee']);
Route::post('/add_employee',[MainController::class, 'add_employee']);
Route::post('/edit_emp',[MainController::class, 'edit_employee']);
Route::get('/delete_emp/{id}',[MainController::class, 'delete_employee']);
Route::get('/leave',[MainController::class, 'user_leave']);
Route::post('/request_leave',[MainController::class, 'request_leave']);
Route::get('/delete_leave/{id}',[MainController::class, 'delete_leave']);
Route::post('/change_status',[MainController::class, 'change_status']);
Route::get('/check_email',[MainController::class, 'check_email']);