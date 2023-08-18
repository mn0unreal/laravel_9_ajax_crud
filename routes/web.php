<?php
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\StudentController;
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
  return view('welcome');
});

//Route::get('/form', function () {
//  return view('form');
//});

//Route::get('/add-student',[StudentController::class,'addStudent']);

Route::post('/form_submit',[StudentController::class,'form_submit'])->name('form_submit');


Route::get('/add-student',[StudentController::class,'addStudent'])->name('addStudent');
Route::get('/get-students', function () {
  return view('students');
});

Route::get('/get-all-students',[StudentController::class,'getStudents'])->name('getStudents');
Route::get('/editUser/{id}',[StudentController::class,'getStudentData'])->name('getStudentData');
Route::post('/update-data',[StudentController::class,'updateStudent'])->name('updateStudent');
Route::get('/delete-student/{id}',[StudentController::class,'deleteStudent'])->name('delete-data');

Route::get('/ajax', function () {
  return view('ajax');
});

Route::post('/ajaxupload', function () {
  return view('ajax');
});

//ajaxupload
Route::post('ajaxupload',[AjaxController::class,'upload']);
