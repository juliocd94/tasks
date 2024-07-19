<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.list');

    Route::get('/tasks/{id}', function ($id) {
        $task = Task::findOrFail($id);
        return Inertia::render('Tasks/Show', ['task' => $task]);
    })->name('tasks.show');

    Route::get('/tasks-edit/{id}', function ($id) {
        $task = Task::findOrFail($id);
        return Inertia::render('Tasks/Edit', ['task' => $task]);
    })->name('tasks.edit');

    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

});

require __DIR__.'/auth.php';
