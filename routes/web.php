<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/burse', function () {
    return view('burse', ['tasks' => Task::all()]);
})->name('burse');

Route::get('/freelancers', function () {
    return view('freelancers', ['freelancers' => Freelancer::all()]);
})->name('freelancers');

Route::get('/task/{id}', function ($request, $id) {
    return view('task', ['task' => Task::where($id)]);
})->name('task');

Route::get('/chat', function ($request) {
    return view('chat', ['messages' => Message::where('author', '=', Auth::user()->email),
    'dialogues' => User::where('email', '=', Message::all('recipient')->where('author', '=', Auth::user()->email)),
    'user' => Auth::user()->email]);
})->name('chat');

Route::post('/chat', function ($request) {
    Message::create([
        'text' => $request->text,
        'author'=> Auth::user()->email,
        'recipient' => $request->recipient,
    ]);
    return redirect('chat');
})->name('chat.post');

Route::patch('/chat', function ($request) {
    Message::update([
        'text' => $request->text,
        'author'=> Auth::user()->email,
        'recipient' => $request->recipient,
    ]);
    return redirect('chat');
})->name('chat.update');

Route::destroy('/chat', function ($request) {
    Message::destroy($request->id);
    return redirect('chat');
})->name('chat.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
