<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Support\Facades\Route;

Route::prefix("/php/4_halado/4_keretrendszerek/")->group(function(){

    Route::resource('task', TaskController::class)->except(['show','create']);

    Route::patch('/task/{task}/status', [TaskStatusController::class, 'update'])->name('task.status');

    Route::redirect('/', route('task.index'))->name('index');
});
