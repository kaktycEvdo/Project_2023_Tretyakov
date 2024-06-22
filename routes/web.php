<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Models\Freelancer;
use App\Models\PersonalData;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::group(['prefix'=> 'burse'], function () {
    Route::get('', [TaskController::class, 'index'])->name('burse');
    Route::get('/task', [TaskController::class, 'show'])->name('task.show');
    Route::get('/task/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::get('/new_task', [TaskController::class, 'create'])->name('task.create')->middleware('auth');
    Route::post('/new_task', [TaskController::class, 'store'])->name('task.store')->middleware('auth');
    Route::patch('/task/{id}', [TaskController::class, 'update'])->name('task.update')->middleware('auth');
    Route::delete('/task/{id}', [TaskController::class, 'destroy'])->name('task.destroy')->middleware('auth');
});

Route::group(['prefix'=> 'chat'], function () {
    Route::get('', [ChatController::class, 'create'])->name('chat')->middleware('auth');
    Route::post('', [ChatController::class, 'store'])->name('chat.create')->middleware('auth');
    Route::patch('', [ChatController::class, 'update'])->name('chat.update')->middleware('auth');
    Route::delete('', [ChatController::class, 'destroy'])->name('chat.destroy')->middleware('auth');
});

Route::get('new_feedback', function () {
    return view('task.forms.feedback')->middleware('auth');
})->name('new_feedback');

Route::get('/freelancers', function () {
    $freelancers = array();
    $i = 0;
    foreach(Freelancer::all() as $fr) {
        $user = PersonalData::where('email', $fr->email)->first();
        array_push($freelancers, [
            'id' => $fr->id,
            'name' => $user->name,
            'surname' => $user->surname,
            'patronymic' => $user->patronymic,
            'about' => $fr->about,
            'chars' => explode(', ', $fr->characteristics),
        ]);
        $i++;
    };
    return view('freelancers', ['frs' => $freelancers]);
})->name('freelancers');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
