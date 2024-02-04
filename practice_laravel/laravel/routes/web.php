<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLTEController;
use App\Http\Controllers\AdminLTEStudentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create')->middleware('login_auth');
Route::post('/student', [StudentController::class, 'store'])->name('student.store')->middleware('login_auth');
Route::get('/student', [StudentController::class, 'index'])->name('student.index')->middleware('login_auth');
Route::get('/student/{student}', [StudentController::class, 'show'])->name('student.show')->middleware('login_auth');
Route::get('/student/{student}/edit', [StudentController::class, 'edit'])->name('student.edit')->middleware('login_auth');
Route::patch('/student/{student}', [StudentController::class, 'update'])->name('student.update')->middleware('login_auth');
Route::delete('/student/{student}', [StudentController::class, 'destroy'])->name('student.destroy')->middleware('login_auth');

Route::get('/login', [AdminController::class, 'index'])->name('login.index');
Route::get('/logout', [AdminController::class, 'logout'])->name('login.logout');
Route::post('/login', [AdminController::class, 'process'])->name('login.process');

Route::get('/adminlte/student/create', [AdminLTEStudentController::class, 'create'])->name('adminlte.student.create')->middleware('login_auth');
Route::post('/adminlte/student', [AdminLTEStudentController::class, 'store'])->name('adminlte.student.store')->middleware('login_auth');
Route::get('/adminlte/student', [AdminLTEStudentController::class, 'index'])->name('adminlte.student.index')->middleware('login_auth');
Route::get('/adminlte/student/{student}', [AdminLTEStudentController::class, 'show'])->name('adminlte.student.show')->middleware('login_auth');
Route::get('/adminlte/student/{student}/edit', [AdminLTEStudentController::class, 'edit'])->name('adminlte.student.edit')->middleware('login_auth');
Route::patch('/adminlte/student/{student}', [AdminLTEStudentController::class, 'update'])->name('adminlte.student.update')->middleware('login_auth');
Route::delete('/adminlte/student/{student}', [AdminLTEStudentController::class, 'destroy'])->name('adminlte.student.destroy')->middleware('login_auth');