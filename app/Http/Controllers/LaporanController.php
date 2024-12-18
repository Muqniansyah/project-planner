<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Menampilkan Halaman Index dengan Data Laporan
    public function index()
    {
        // Ambil semua data laporan
        $laporans = Laporan::all();

        // Kirim data ke view 'Laporan.index'
        return view('Laporan.index', compact('laporans'));
    }

    // Menyimpan Data Laporan Baru
    public function store(Request $request)
    {
        // Debug: Menampilkan semua input dari request
        // dd($request->all());

        // Validasi Input
        $request->validate([
            'author' => 'required|string|max:255',
            'report_date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Simpan ke Database
        Laporan::create([
            'author' => $request->input('author'),
            'report_date' => $request->input('report_date'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        Laporan::create($request->all());

        // Redirect dengan Pesan Sukses
        return redirect()->route('Laporan.index')->with('success', 'Laporan berhasil dibuat!');
    }
}
