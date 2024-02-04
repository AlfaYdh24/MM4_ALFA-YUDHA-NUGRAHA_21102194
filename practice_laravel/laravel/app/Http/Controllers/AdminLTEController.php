<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class AdminLTEController extends Controller
{
    public function index()
    {
        $mahasiswas = Student::all();
        return view('adminlte.index', ['students' => $mahasiswas]);
    }

}