<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendjadwalanController extends Controller
{
    public function index() {
        return view('pendjadwalan.index');
    }
}
