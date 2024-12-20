<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SumberDaya;


class ManajemenSDController extends Controller
{
    public function index() {
        $resources = SumberDaya::all(); // Ambil semua data dari database
        return view('ManajemenSD.index', compact('resources'));
    }
    

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'quantity' => 'required|numeric|min:0',
        ]);

        SumberDaya::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'quantity' => $request->input('quantity'),
            'status' => 'available', // Status default
        ]);

        return redirect()->route('ManajemenSD.index')->with('success', 'Proyek berhasil dibuat!');
    }
}