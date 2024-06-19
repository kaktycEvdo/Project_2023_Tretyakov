<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Models\Freelancer;
use App\Models\Message;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix'=> 'burse'], function () {
    Route::get('', [TaskController::class, 'index'])->name('burse');
    Route::get('/task/{id}', [TaskController::class, 'show'])->name('task.show');
    Route::patch('/profile', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/profile', [TaskController::class, 'destroy'])->name('task.destroy');
});

Route::group(['prefix'=> 'chat'], function () {
    Route::get('', [ChatController::class, 'index'])->name('chat');
    Route::post('', [ChatController::class, 'store'])->name('chat.create');
    Route::patch('', [ChatController::class, 'update'])->name('chat.update');
    Route::delete('', [ChatController::class, 'destroy'])->name('chat.destroy');
});

Route::get('/freelancers', function () {
    return view('freelancers', ['freelancers' => Freelancer::all()]);
})->name('freelancers');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
