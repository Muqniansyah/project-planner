<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SumberDaya;
use App\Models\Project;
use App\Models\ProjectSumberDaya;

class ManajemenSDController extends Controller
{
    public function index() {
        $resources = SumberDaya::all(); // Ambil semua data dari database

        // Ambil semua data proyek
        $projects = Project::all(); 

        // Kirimkan data resources dan projects ke view
        return view('ManajemenSD.index', compact('resources', 'projects'));
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

        return redirect()->route('ManajemenSD.index')->with('success', 'Sumber Daya berhasil dibuat!');
    }

    public function edit($id) {
        $resource = SumberDaya::find($id);

        if (!$resource) {
            abort(404, 'Sumber Daya tidak ditemukan.');
        }

        // Kirim data sumber daya ke view edit
        return view('ManajemenSD.edit', compact('resource'));
    }

    public function update(Request $request, $id) {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'quantity' => 'required|numeric|min:0',
        ]);

        try {
            // Temukan sumber daya berdasarkan ID
            $resource = SumberDaya::findOrFail($id);

            // Update data sumber daya
            $resource->update([
                'name' => $request->input('name'),
                'type' => $request->input('type'),
                'quantity' => $request->input('quantity'),
            ]);

            // Redirect ke halaman manajemen sumber daya dengan pesan sukses
            return redirect()->route('ManajemenSD.index')->with('success', 'Sumber Daya berhasil diperbarui!');
        } catch (\Exception $err) {
            return redirect()->route('ManajemenSD.index')->with('error', 'Gagal memperbarui Sumber Daya: ' . $err->getMessage());
        }
    }

    public function view() {
        // Ambil semua data proyek
        $projects = Project::all();
    
        // Ambil semua data alokasi sumber daya yang ada
        $allocations = ProjectSumberDaya::with('project', 'sumberDaya')->get();
    
        // Kirim data proyek dan alokasi ke view
        return view('ManajemenSD.view', compact('projects', 'allocations'));
    }

    public function storeAllocation(Request $request) {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'sumber_daya_id' => 'required|exists:sumber_dayas,id',
            'quantity' => 'required|integer|min:1',  // Pastikan kuantitasnya valid
            'jenis' => 'required|string|max:255',    // Validasi jenis sumber daya
        ]);
    
        // Membuat alokasi baru
        ProjectSumberDaya::create([
            'project_id' => $request->project_id,
            'sumber_daya_id' => $request->sumber_daya_id,
            'quantity' => $request->quantity,
            'jenis' => $request->jenis,  // Menambahkan jenis
        ]);
    
        return redirect()->route('ManajemenSD.view')->with('success', 'Sumber Daya berhasil dialokasikan ke proyek!');
    }
}
