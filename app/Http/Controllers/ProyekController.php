<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ProyekController extends Controller
{
    public function index()
    {
        $managers = User::where('role', 'Manager')->get();

        return view('proyek.index', compact('managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'anggaran' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'manager' => 'required|exists:users,id',
        ]);

        Project::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'anggaran' => $request->input('anggaran'),
            'status' => 'Pending', // Status default
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'manager' => $request->input('manager'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Proyek berhasil dibuat!');
    }

    public function dashboard(Request $request)
    {
        // Kondisi untuk role 'karyawan'
        if (Auth::user()->role === 'karyawan') {
            // Ambil kata kunci pencarian dari request
            $search = $request->get('search');

            // Menampilkan proyek yang berstatus Pending untuk karyawan
            $pendingProjects = Auth::user()->projects()
                ->where('status', 'Pending')
                ->where(function ($query) use ($search) {
                    if ($search) {
                        $query->where('projects.name', 'like', '%' . $search . '%')
                            ->orWhere('projects.description', 'like', '%' . $search . '%');
                    }
                })
                ->paginate(2, ['*'], 'pendingProjectsPage'); // Pagination untuk proyek Pending

            // Menampilkan proyek yang berstatus In Progress untuk karyawan
            $inProgressProjects = Auth::user()->projects()
                ->where('status', 'In Progress')
                ->where(function ($query) use ($search) {
                    if ($search) {
                        $query->where('projects.name', 'like', '%' . $search . '%')
                            ->orWhere('projects.description', 'like', '%' . $search . '%');
                    }
                })
                ->paginate(2, ['*'], 'inProgressProjectsPage'); // Pagination untuk proyek In Progress

            // Menampilkan proyek yang berstatus Completed untuk karyawan
            $completedProjects = Auth::user()->projects()
                ->where('status', 'Completed')
                ->where(function ($query) use ($search) {
                    if ($search) {
                        $query->where('projects.name', 'like', '%' . $search . '%')
                            ->orWhere('projects.description', 'like', '%' . $search . '%');
                    }
                })
                ->paginate(2, ['*'], 'completedProjectsPage'); // Pagination untuk proyek Completed
        } else {
            // Ambil kata kunci pencarian dari request untuk proyek yang dikelola oleh manager
            $search = $request->get('search');

            // Menambahkan pagination dan pencarian untuk setiap status proyek
            $pendingProjects = Project::where('status', 'Pending')
                ->where('manager', Auth::user()->id)
                ->where(function ($query) use ($search) {
                    if ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('description', 'like', '%' . $search . '%');
                    }
                })
                ->paginate(2, ['*'], 'pendingPage');

            $inProgressProjects = Project::where('status', 'In Progress')
                ->where('manager', Auth::user()->id)
                ->where(function ($query) use ($search) {
                    if ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('description', 'like', '%' . $search . '%');
                    }
                })
                ->paginate(2, ['*'], 'inProgressPage');

            $completedProjects = Project::where('status', 'Completed')
                ->where('manager', Auth::user()->id)
                ->where(function ($query) use ($search) {
                    if ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('description', 'like', '%' . $search . '%');
                    }
                })
                ->paginate(2, ['*'], 'completedPage');
        }

        // Kembali ke tampilan dashboard dengan data proyek yang sesuai
        return view('dashboard', compact(
            'pendingProjects',
            'inProgressProjects',
            'completedProjects',
        ));
    }


    public function updateStatus(Request $request, $id)
    {
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

    public function detail($id)
    {
        $project = Project::findOrFail($id);
        return view('proyek.detail', compact('project'));
    }

    public function undo(Request $request, $id)
    {
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

    public function edit($id)
    {
        $project = Project::find($id);

        if (!$project) {
            abort(404, 'Proyek tidak ditemukan.');
        }

        // Kirim data proyek ke view edit
        return view('proyek.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'anggaran' => 'required|numeric|min:0',
        ]);

        try {
            // Temukan proyek berdasarkan ID
            $project = Project::findOrFail($id);

            // Update data proyek
            $project->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'anggaran' => $request->input('anggaran'),
            ]);

            // Redirect ke dashboard dengan pesan sukses
            return redirect()->route('dashboard')->with('success', 'Proyek berhasil diperbarui!');
        } catch (\Exception $err) {
            return redirect()->route('dashboard')->with('error', 'Gagal memperbarui proyek: ' . $err->getMessage());
        }
    }
}
