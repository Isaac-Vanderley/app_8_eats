<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class empleadosController extends Controller
{
    public function vista(){
        return view ('pages.empleados');
    }
    
}
