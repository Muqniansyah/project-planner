<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SumberDaya;
use App\Models\Project;
use App\Models\ProjectSumberDaya;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManajemenSDController extends Controller
{
    public function index(Request $request) {
        // Tangkap keyword pencarian
        $search = $request->input('search');

        // Query sumber daya dengan pencarian (jika ada)
        $materials = SumberDaya::where('type', 'Material')->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(5); // Pagination 5 item per halaman

        $tenaga_kerja = SumberDaya::where('type', 'Tenaga Kerja')->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(5); // Pagination 5 item per halaman
        
        // Ambil semua data proyek
        $projects = Project::where('manager', Auth::user()->id)->get(); 

        // Kirimkan data materials dan projects ke view
        return view('ManajemenSD.index', compact('materials', 'tenaga_kerja', 'projects'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
        ]);

        if ($request->has('quantity')) {
            $request->validate([
                'quantity' => 'required|numeric|min:0',
            ]);
        }

        SumberDaya::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            
            'quantity' => $request->has('quantity') ? $request->quantity : 0,
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

    public function storeAllocation(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'sumber_daya_id' => 'required|exists:sumber_dayas,id',
        ]);

        // Ambil data sumber daya
        $resource = SumberDaya::findOrFail($request->sumber_daya_id);

        // Pastikan sumber daya masih tersedia
        if ($resource->status !== 'Available') {
            return redirect()->back()->with('error', 'Sumber Daya tidak tersedia untuk dialokasikan.');
        }

        // Alokasikan sumber daya ke proyek
        $projectSumberDaya = ProjectSumberDaya::create([
            'project_id' => $request->project_id,
            'sumber_daya_id' => $resource->id,
            'jenis' => $resource->type,
        ]);

        // Jika ada user, buat relasi dengan user dan proyek
        if ($request->filled('user')) {
            $user = User::findOrFail($request->user);

            // Hubungkan user dengan proyek (many-to-many)
            $user->projects()->attach($request->project_id);

            $resource->update(['quantity' => $resource->quantity - 1]);
        } else {
            ProjectSumberDaya::create([
                'quantity' => $request->quantity,
            ]);

            $resource->update(['quantity' => $resource->quantity - $request->quantity]);
        }

        // Ubah status sumber daya menjadi Not Available
        if ($resource->quantity === 0) {
            $resource->update(['status' => 'Not Available']);
        }

        return redirect()->route('ManajemenSD.view', ['id' => $request->project_id])
            ->with('success', 'Sumber Daya berhasil dialokasikan ke proyek!');
    }


    public function getUsersByJobDesk($resourceId)
    {
        // Retrieve the resource by ID
        $resource = SumberDaya::findOrFail($resourceId);

        // Assuming each resource has many associated users
        $users = $resource->users;  // This depends on your relationship setup, adjust accordingly

        // Return the users as a JSON response
        return response()->json($users);
    }

}
