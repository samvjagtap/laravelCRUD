<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('showAllEmployee');
});

Route::view('/addEmp','addEmployee')->name('addEmp');

Route::controller(EmployeeController::class)->group(function() {
    Route::get('/', 'getAllEmpData')->name('getAllEmp');
    Route::get('/addEmp', 'index')->name('addEmp');
    Route::post('/addEmpData', 'addEmployee')->name('addEmpData');
    Route::get('/deleteEmp/{id}', 'deleteEmployee')->name('deleteEmp');
    Route::get('/getEmp/{id}', 'getSingleEmployee')->name('getEmp');
    Route::post('/updateEmp{id}', 'updateEmployeeData')->name('updateEmp');
});