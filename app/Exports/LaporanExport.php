<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil semua data laporan
     */
    public function collection()
    {
        return Laporan::all(['title', 'author', 'report_date', 'description']);
    }

    /**
     * Menambahkan header di file Excel
     */
    public function headings(): array
    {
        return [
            'Judul Laporan',
            'Nama Pembuat',
            'Tanggal',
            'Deskripsi',
        ];
    }
        // Styling untuk header
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Baris 1 dibuat tebal
        ];
    }
}

