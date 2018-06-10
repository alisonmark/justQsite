<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestFormController extends Controller
{
    public function index()      
    { 
        return view('Test')->with('name', 'just Q');
    }
}
