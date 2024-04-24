<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/report', [ReportController::class, 'index'])->name('report.index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('report')
        ->name('report.')
        ->controller(ReportController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/{report}', 'show')->name('show');
            Route::post('/', 'store')->name('store');
            Route::get('/{report}/edit', 'edit')->name('edit');
            Route::put('/{report}', 'update')->name('update');
            Route::delete('/{report}', 'destroy')->name('destroy');
        });
    Route::prefix('comment')
        ->name('comment.')
        ->controller(CommentController::class)
        ->group(function () {
            Route::post('/{report}', 'store')->name('store');
            Route::delete('/{comment}',  'destroy')->name('destroy');
        });
    Route::prefix('user')
        ->name('user.')
        ->controller(UserController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{user}', 'show')->name('show');
            Route::get('/{user}/edit', 'edit')->name('edit');
            Route::patch('/{user}', 'update')->name('update');
        });
    Route::prefix('schedule')
        ->name('schedule.')
        ->controller(ScheduleController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });
});

require __DIR__ . '/auth.php';
