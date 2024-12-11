<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProyekController extends Controller
{
    public function index() {
        return view('proyek.index');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'anggaran' => 'required|numeric|min:0',
        ]);

        Project::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'anggaran' => $request->input('anggaran'),
            'status' => 'Pending', // Status default
        ]);

        return redirect()->route('dashboard')->with('success', 'Proyek berhasil dibuat!');
    }

    public function dashboard() {
        $pendingProjects = Project::where('status', 'Pending')->get();
        $inProgressProjects = Project::where('status', 'In Progress')->get();
    
        return view('dashboard', compact('pendingProjects', 'inProgressProjects'));
    }
    

    public function updateStatus(Request $request, $id) {
        // Validasi dan cari proyek berdasarkan ID
        $project = Project::findOrFail($id);

        // Perbarui status proyek
        $project->update([
            'status' => $request->input('status', 'In Progress'), // Default ke 'In Progress'
        ]);

        return response()->json(['message' => 'Status proyek berhasil diperbarui!']);
    }


    
}
