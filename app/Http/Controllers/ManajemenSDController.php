<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManajemenSDController extends Controller
{
    public function index() {
        return view('ManajemenSD.index');
    }
}
