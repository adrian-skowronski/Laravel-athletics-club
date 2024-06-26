<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TrainerMiddleware;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AthletePanelController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventUserController;


Route::get('/', [StartController::class, 'index'])->name('start.index');
Route::get('/verify', function () {
    return view('auth.notice');
})->name('auth.notice');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/athlete-panel', [AthletePanelController::class, 'index'])->name('athlete.panel');
    Route::get('/athlete/edit', [AthleteController::class, 'edit'])->name('athlete.edit');
    Route::post('/athlete/update', [AthleteController::class, 'update'])->name('athlete.update');
    Route::delete('/athlete/remove-from-training', [AthleteController::class, 'removeFromTraining'])
    ->name('athlete.removeTraining');

    Route::post('/trainings/{training_id}/sign-up', [TrainingController::class, 'signUp'])->name('training.signUp');

    Route::middleware(TrainerMiddleware::class)->group(function () {
        Route::get('/trainer', [TrainerController::class, 'index'])->name('trainer.index');
        Route::get('/trainer/edit', [TrainerController::class, 'edit'])->name('trainer.edit');
        Route::post('/trainer/update', [TrainerController::class, 'update'])->name('trainer.update');
        Route::get('/training/{training_id}/participants', [TrainerController::class, 'viewParticipants'])->name('trainer.viewParticipants');
        Route::get('/training/{training_id}/participant/{user_id}/edit', [TrainerController::class, 'editStatus'])->name('trainer.editStatus');
        Route::patch('/training/{training_id}/participant/{user_id}', [TrainerController::class, 'updateStatus'])->name('trainer.updateStatus');    
        Route::get('/trainer/create-training', [TrainerController::class, 'createTraining'])->name('trainer.createTraining');
        Route::post('/trainer/store-training', [TrainerController::class, 'storeTraining'])->name('trainer.storeTraining');
        Route::get('/trainer/{training_id}/edit', [TrainerController::class, 'trainingEdit'])->name('trainer.editTraining');
        Route::put('/trainer/{training_id}/update', [TrainerController::class, 'trainingUpdate'])->name('trainer.updateTraining');
        Route::delete('/trainer/{training_id}', [TrainerController::class, 'trainingDestroy'])->name('trainer.trainingDestroy');
        Route::delete('/training/{training_id}/participants/{user_id}', [TrainerController::class, 'removeParticipant'])->name('trainer.removeParticipant');

    });

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::resource('trainings', TrainingController::class);
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/approve/{user}', [AdminController::class, 'approve'])->name('admin.approve');
        Route::post('/admin/store-approval/{user}', [AdminController::class, 'storeApproval'])->name('admin.storeApproval');
        Route::delete('/admin/reject/{user}', [AdminController::class, 'reject'])->name('admin.reject');

        Route::get('/admin/{table}', function ($table) {
            if (Schema::hasTable($table)) {
                return redirect()->route($table . '.index');
            } else {
                abort(404);
            }
        })->name('admin.table');
        Route::resource('events', EventController::class);
    Route::resource('sports', SportController::class);
    Route::resource('users', UserController::class);
    Route::resource('event_user', EventUserController::class);
    Route::get('/event_user/create', [EventUserController::class, 'create'])->name('event_user.create');
    Route::post('/event_user/store', [EventUserController::class, 'store'])->name('event_user.store');
    Route::get('/event-user/{event}/athletes', [EventUserController::class, 'eligibleAthletes'])->name('event_user.athletes');

});


    Route::get('/trainer/{user_id}', [TrainerController::class, 'show'])->name('trainer.details');
});



Route::get('/treningi', [TrainingController::class, 'view'])->name('trainings.view');
Route::get('/zawody', [EventController::class, 'view'])->name('events.view');
Route::get('/trainer/{user_id}', [TrainerController::class, 'show'])->name('trainer.details');

require __DIR__.'/auth.php';
