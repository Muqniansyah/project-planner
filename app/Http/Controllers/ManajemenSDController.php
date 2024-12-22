<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SumberDaya;
use App\Models\Project;
use App\Models\ProjectSumberDaya;

class ManajemenSDController extends Controller
{
    public function index(Request $request) {
        // Tangkap keyword pencarian
        $search = $request->input('search');

        // Query sumber daya dengan pencarian (jika ada)
        $resources = SumberDaya::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('type', 'like', '%' . $search . '%');
        })->paginate(5); // Pagination 5 item per halaman
        
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

    public function view($id) {
        // Ambil data proyek berdasarkan ID
        $project = Project::findOrFail($id);
    
        // Ambil alokasi sumber daya yang sesuai dengan proyek ini
        $allocations = ProjectSumberDaya::with('sumberDaya')
            ->where('project_id', $id)
            ->get();
    
        // Kirim data proyek dan alokasi ke view
        return view('ManajemenSD.view', compact('project', 'allocations'));
    }

    public function storeAllocation(Request $request) {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'sumber_daya_id' => 'required|exists:sumber_dayas,id',
        ]);

        // Ambil data sumber daya
        $resource = SumberDaya::findOrFail($request->sumber_daya_id);

        // Pastikan sumber daya masih available
        if ($resource->status !== 'Available') {
            return redirect()->back()->with('error', 'Sumber Daya tidak tersedia untuk dialokasikan.');
        }

        // Lakukan alokasi
        ProjectSumberDaya::create([
            'project_id' => $request->project_id,
            'sumber_daya_id' => $resource->id,
            'quantity' => $resource->quantity,
            'jenis' => $resource->type,
        ]);

        // Ubah status sumber daya menjadi Not Available
        $resource->update(['status' => 'Not Available']);

        return redirect()->route('ManajemenSD.view', ['id' => $request->project_id])
            ->with('success', 'Sumber Daya berhasil dialokasikan ke proyek!');
    }
}
