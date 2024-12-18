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

Route::get('/dashboard', [ProyekController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:edit'])->group(function () {
    // Routes for User Edit
    Route::get('/project/manage', [ProjectController::class, 'index'])->name('project.manage');
    Route::get('/tasks/manage', [TaskController::class, 'index'])->name('tasks.manage');
    Route::get('/resources/manage', [ResourceController::class, 'index'])->name('resources.manage');
    Route::get('/reports/manage', [ReportController::class, 'index'])->name('reports.manage');
});

Route::middleware(['auth', 'role:view'])->group(function () {
    // Routes for User View
    Route::get('/project/view', [ProjectController::class, 'view'])->name('project.view');
    Route::get('/tasks/view', [TaskController::class, 'view'])->name('tasks.view');
    Route::get('/resources/view', [ResourceController::class, 'view'])->name('resources.view');
    Route::get('/reports/view', [ReportController::class, 'view'])->name('reports.view');
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

    // routing Laporan
    Route::get('/Laporan', [LaporanController::class,'index'])->name('Laporan.index');
    Route::post('/Laporan/store', [LaporanController::class, 'store'])->name('Laporan.store');
    
    //routing pdf
    Route::get('/projects/pdf/{id}', [ProyekController::class, 'generatePdf'])->name('projects.pdf');
    Route::get('/laporan/pdf/{id}', [LaporanController::class, 'downloadPDF'])->name('Laporan.downloadPDF');

});

require __DIR__.'/auth.php';
