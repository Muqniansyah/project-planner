<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;

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
        // Menambahkan pagination untuk setiap status proyek
        $pendingProjects = Project::where('status', 'Pending')->paginate(2); // 5 proyek per halaman
        $inProgressProjects = Project::where('status', 'In Progress')->paginate(2); // 5 proyek per halaman
        $completedProjects = Project::where('status', 'Completed')->paginate(2); // 5 proyek per halaman

        return view('dashboard', compact('pendingProjects', 'inProgressProjects', 'completedProjects'));

    }


    public function updateStatus(Request $request, $id) {
        // Validasi dan cari proyek berdasarkan ID
        $project = Project::findOrFail($id);

        // Perbarui status proyek
        if ($project->status === 'Pending') {
            $project->status = 'In Progress';
        } elseif ($project->status === 'In Progress') {
            $project->status = 'Completed';
        }

        $project->save();

        return redirect()->route('dashboard')->with('success', 'Status berhasil dibuah!');
    }

    public function detail($id) {
        $project = Project::findOrFail($id);
        return view('proyek.detail', compact('project'));
    }
    public function undo(Request $request, $id) {
        // Temukan proyek berdasarkan ID
        $project = Project::findOrFail($id);

        // Perbarui status proyek secara dinamis
        if ($project->status === 'Completed') {
            $project->status = 'In Progress';
        } elseif ($project->status === 'In Progress') {
            $project->status = 'Pending';
        }

        $project->save();

        return redirect()->route('dashboard')->with('success', 'Proyek berhasil dikembalikan ke status sebelumnya!');
    }
    
    // public function generatePdf($id)
    public function generatePDF($id)
    {
    // Cari proyek berdasarkan ID
    $project = Project::findOrFail($id);

    // Load view dengan data proyek
    $pdf = Pdf::loadView('pdf.project', ['project' => $project]);

    // Unduh file PDF
    return $pdf->download("Project_{$project->name}.pdf");
    }
}
