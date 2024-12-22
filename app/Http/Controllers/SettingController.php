<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Notifications\DashboardNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

class SettingController extends Controller
{
    /**
     * Menampilkan notifikasi pada dashboard.
     */
    public function index()
    {
        $notifications = auth()->check() ? auth()->user()->notifications()->latest()->paginate(10) : collect();

        return view('dashboard', compact('notifications'));
    }

    /**
     * Memperbarui pengaturan dan mengirim notifikasi.
     */
    public function update(Request $request, Settings $settings)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'setting_key' => 'required|string|max:255',
        ]);

        $settings->update($request->all());

        $user->notify(new DashboardNotification([
            'title' => 'Pengaturan Diperbarui',
            'message' => 'Pengaturan Anda telah berhasil diperbarui.',
            'url' => '/settings',
        ]));

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }

    /**
     * Menandai notifikasi sebagai dibaca.
     */
    public function read($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if (!$notification) {
            return back()->with('error', 'Notifikasi tidak ditemukan.');
        }

        $notification->markAsRead();

        return back()->with('success', 'Notifikasi ditandai sebagai dibaca!');
    }

    /**
     * Menghapus notifikasi.
     */
    public function delete($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if (!$notification) {
            return back()->with('error', 'Notifikasi tidak ditemukan.');
        }

        $notification->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    /**
     * Kirim notifikasi untuk tugas yang jatuh tempo.
     */
    public function notifyDueTasks()
    {
        $users = User::with(['tasks' => function ($query) {
            $query->where('due_date', '<=', Carbon::now())->where('status', '!=', 'completed');
        }])->get();

        foreach ($users as $user) {
            foreach ($user->tasks as $task) {
                $user->notify(new DashboardNotification([
                    'title' => 'Tugas Jatuh Tempo',
                    'message' => "Tugas '{$task->title}' jatuh tempo pada {$task->due_date->format('d-m-Y')}.", 
                    'url' => route('tasks.show', $task->id),
                ]));
            }
        }

        return back()->with('success', 'Notifikasi tugas jatuh tempo telah dikirim.');
    }

    public function notifyDueProjects()
    {
        // Ambil proyek yang deadline-nya mendekati
        $projects = Project::with('user') // Pastikan ada relasi user pada proyek
            ->where('end_date', '<=', Carbon::now()->addDays(3)) // 3 hari sebelum deadline
            ->where('status', '!=', 'Completed') // Hanya proyek yang belum selesai
            ->get();

        foreach ($projects as $project) {
            $user = $project->user; // Mengambil pengguna yang terkait dengan proyek

            $user->notify(new DashboardNotification([
                'title' => 'Proyek Mendekati Deadline',
                'message' => "Proyek '{$project->name}' hampir mencapai deadline pada {$project->end_date->format('d-m-Y')}.",
                'url' => route('projects.show', $project->id), // Tautan menuju detail proyek
            ]));
        }

        return back()->with('success', 'Notifikasi proyek hampir jatuh tempo telah dikirim.');
    }
}
