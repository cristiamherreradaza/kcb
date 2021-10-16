<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function __construct()
    {
        // solicita login de ingreso
        $this->middleware('auth');
    }

    public function inicio()
    {
        // echo "holas";
        return view('panel.inicio');
    }
}
