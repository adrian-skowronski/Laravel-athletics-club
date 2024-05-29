<?php
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Schema;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Route;

Route::get('/', [StartController::class, 'index'])->name('start.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('events', EventController::class);
Route::resource('trainings', TrainingController::class);

Route::get('/treningi', [TrainingController::class, 'view'])->name('trainings.view');
Route::get('/zawody', [EventController::class, 'view'])->name('events.view');

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::resource('trainings', TrainingController::class);

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

   

    Route::get('/admin/{table}', function ($table) {
        // Sprawdź, czy tabela istnieje
        if (Schema::hasTable($table)) {
            // Jeśli tabela istnieje, przekieruj do odpowiedniego kontrolera
            return redirect()->route($table . '.index');
        } else {
            // Jeśli tabela nie istnieje, przekieruj gdzieś indziej lub zwróć błąd 404
            abort(404);
        }
    })->name('admin.table');

});