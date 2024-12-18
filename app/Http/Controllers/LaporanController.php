<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Exports\LaporanExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
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
        Laporan::create($request->all()); // Ini cukup

        // Redirect dengan Pesan Sukses
        return redirect()->route('Laporan.index')->with('success', 'Laporan berhasil dibuat!');
    }

        // Method untuk mengunduh laporan sebagai PDF
    public function downloadPDF($id)
    {
        // Ambil data laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);

        // Render view untuk PDF
        $pdf = PDF::loadView('Laporan.pdf', compact('laporan'));

        // Download file PDF dengan nama yang sesuai
        return $pdf->download('Laporan-' . $laporan->title . '.pdf');
    }
    /**
     * Unduh file Excel dari daftar laporan
     */
    public function exportExcel($id)
    {
        //Ambil Laporan berdasaran ID
        $laporan = Laporan::findOrFail($id);

        //Unduh file excel
        return Excel::download(new LaporanExport, $laporan->title .'.xlsx');
    }

}
