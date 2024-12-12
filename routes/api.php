<?php

use App\Http\Controllers\GanttController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProjectDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/data/{project}', [GanttController::class, 'get']);
Route::resource('link', LinkController::class);
Route::resource('task', ProjectDetailController::class);
