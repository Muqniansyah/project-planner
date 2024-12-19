<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Laporan;

class LaporanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $laporan;

    public function __construct(Laporan $laporan)
    {
        $this->laporan = $laporan;

    }
    
    /**
     * Build the message.
     */
    public function build()
    {

        // Debug: Tampilkan data laporan sebelum mengirim email
        // dd([
        //     'subject' => 'Laporan Proyek: ' . $this->laporan->title,
        //     'laporan' => $this->laporan,
        // ]);

        return $this->subject('Laporan Proyek: ' . $this->laporan->title)
                    ->view('emails.laporan') // Template view
                    ->with([
                        'laporan' => $this->laporan,
                    ]);
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
