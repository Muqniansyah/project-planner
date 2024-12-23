<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\PendjadwalanController;
use App\Http\Controllers\ManajemenSDController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProjectDetailController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ProyekController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

//send email
Route::get('/test-email', function () {
    Mail::raw('Ini adalah email uji coba dari Laravel menggunakan Brevo SMTP.', function ($message) {
        $message->to('recipient@example.com')
                ->subject('Uji Coba Email Brevo');
    });

    return 'Email berhasil dikirim!';
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/setting', [ProfileController::class, 'setting'])->name('settings.index');

    // routing proyek
    Route::get('/proyek', [ProyekController::class, 'index'])->name('proyek.index');
    Route::post('/proyek/store', [ProyekController::class, 'store'])->name('proyek.store');
    Route::patch('/proyek/{id}/status', [ProyekController::class, 'updateStatus'])->name('proyek.updateStatus');
    Route::patch('/proyek/{id}/undo', [ProyekController::class, 'undo'])->name('proyek.undo');
    Route::get('/proyek/{project}', [ProjectDetailController::class, 'index'])->name('proyekdetail.index');
    Route::get('/proyek/edit/{id}', [ProyekController::class, 'edit'])->name('proyek.edit');
    Route::put('/proyek/{id}', [ProyekController::class, 'update'])->name('proyek.update');

    // routing ManajemenSD
    Route::get('/ManajemenSD', [ManajemenSDController::class,'index'])->name('ManajemenSD.index');
    Route::post('/ManajemenSD/store', [ManajemenSDController::class,'store'])->name('ManajemenSD.store');
    Route::get('/ManajemenSD/edit/{id}', [ManajemenSDController::class, 'edit'])->name('ManajemenSD.edit');
    Route::put('/ManajemenSD/{id}', [ManajemenSDController::class, 'update'])->name('ManajemenSD.update');
    Route::get('/ManajemenSD/view/{id}', [ManajemenSDController::class, 'view'])->name('ManajemenSD.view');
    Route::post('/ManajemenSD/storeAllocation', [ManajemenSDController::class, 'storeAllocation'])->name('ManajemenSD.storeAllocation');

    // routing Laporan
    Route::get('/Laporan', [LaporanController::class,'index'])->name('Laporan.index');
    Route::post('/Laporan/store', [LaporanController::class, 'store'])->name('Laporan.store');
    Route::get('/Laporan/{projectId}', [LaporanController::class, 'index'])->name('Laporan.index');

    //routing pdf
    Route::get('/projects/pdf/{id}', [ProyekController::class, 'generatePdf'])->name('projects.pdf');
    Route::get('/laporan/pdf/{id}', [LaporanController::class, 'downloadPDF'])->name('Laporan.downloadPDF');

    //routing excel
    // Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('Laporan.exportExcel');
    Route::get('/laporan/excel/{id}', [LaporanController::class, 'exportExcel'])->name('Laporan.exportExcel');

    //send email
    Route::get('/laporan/share/{id}', [LaporanController::class, 'shareReport'])->name('Laporan.share');
    Route::post('/laporan/share/{id}', [LaporanController::class, 'shareReport'])->name('Laporan.share');

    // notifikasi
    Route::put('/setting/{settings}', [SettingController::class, 'update'])->name('settings.update');
    Route::post('/notifications/read/{id}', [SettingController::class, 'read'])->name('settings.read');
    Route::get('/notify-due-projects', [SettingController::class, 'notifyDueProjects']);

});

require __DIR__.'/auth.php';
