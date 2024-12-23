<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Exports\LaporanExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\LaporanMail;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Project;


class LaporanController extends Controller
{
    // Menampilkan Halaman Index dengan Data Laporan
    public function index($projectId = null): \Illuminate\View\View
    {
        // Jika $projectId diberikan, ambil data proyek terkait
        $project = $projectId ? Project::findOrFail($projectId) : null;
    
        // Ambil data laporan berdasarkan projectId jika ada, atau semua laporan jika tidak ada
        $laporans = $projectId ? Laporan::where('project_id', $projectId)->get() : Laporan::all();
    
        // Kirim data ke view
        return view('Laporan.index', compact('project', 'laporans'));
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
            'project_id' => 'required|exists:projects,id',
        ]);

        // Simpan ke Database
        Laporan::create($request->all()); // Ini cukup

        // Redirect dengan Pesan Sukses
        return redirect()->route('Laporan.index', $request->project_id)
                     ->with('success', 'Laporan berhasil ditambahkan.');
        }
        // Method untuk mengunduh laporan sebagai PDF
    public function downloadPDF($id)
    {
        // Ambil data laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);

        // Render view untuk PDF
        $pdf = PDF::loadView('Laporan.pdf', compact('laporan'));

        // Download file PDF dengan nama yang sesuai
        return $pdf->download('Laporan ' . $laporan->title . '.pdf');
    }
    /**
     * Unduh file Excel dari daftar laporan
     */
    public function exportExcel($id)
    {
        //Ambil Laporan berdasaran ID
        $laporan = Laporan::findOrFail($id);

        //Unduh file excel
        return Excel::download(export: new LaporanExport, fileName: 'Laporan '. $laporan->title .'.xlsx');
    }

// send email
public function shareReport(Request $request, $id)
{
    // Validasi input email
    $request->validate([
        'email' => 'required|email',
    ]);

    // Ambil data laporan berdasarkan ID
    $laporan = Laporan::findOrFail($id);

    try {
        // Log: Menampilkan informasi email dan laporan
        Log::info('Mengirim email ke: ' . $request->email);
        Log::info('Subject: Laporan Proyek  ' . $laporan->title);

        // Kirim email
        Mail::to($request->email)->send(new LaporanMail($laporan));

        // Redirect jika berhasil
        return redirect()->route('Laporan.index')->with('success', 'Laporan berhasil dikirim ke ' . $request->email);
    } catch (\Exception $e) {
        // Log error
        Log::error('Error saat mengirim email: ' . $e->getMessage());

        return redirect()->route('Laporan.index')->with('error', 'Gagal mengirim email: ' . $e->getMessage());
    }
}

}

