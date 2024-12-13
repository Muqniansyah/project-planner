<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\PendjadwalanController;
use App\Http\Controllers\ManajemenSDController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProjectDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [ProyekController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/setting', [ProfileController::class, 'setting'])->name('settings.index');

    // routing proyek
    Route::get('/proyek', [ProyekController::class, 'index'])->name('proyek.index');
    Route::post('/proyek/store', [ProyekController::class, 'store'])->name('proyek.store');
    Route::patch('/proyek/{id}/status', [ProyekController::class, 'updateStatus'])->name('proyek.updateStatus');
    Route::get('/proyek/{project}', [ProjectDetailController::class, 'index'])->name('proyekdetail.index');

    // routing pendjadwalan
    Route::get('/pendjadwalan', [PendjadwalanController::class,'index'])->name('pendjadwalan.index');

    // routing ManajemenSD
    Route::get('/ManajemenSD', [ManajemenSDController::class,'index'])->name('ManajemenSD.index');

    // routing Laporan
    Route::get('/Laporan', [LaporanController::class,'index'])->name('Laporan.index');

    //routing pdf
    Route::get('/projects/pdf/{id}', [ProyekController::class, 'generatePdf'])->name('projects.pdf');

});

require __DIR__.'/auth.php';
