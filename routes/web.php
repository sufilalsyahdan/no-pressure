<?php

use App\Http\Controllers\PinController;
use App\Models\Pin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/pins', [PinController::class, 'index'])->name('pins');
    Route::resource('pins', PinController::class, ['except' => ['index']]);
    Route::put('/done/{id}', [PinController::class, 'markAsDone']);
    Route::put('/deleteTask/{id}', [PinController::class, 'deleteTask']);
    Route::put('/updateTask/{id}', [PinController::class, 'updateTask']);
    Route::post('/tasks', [PinController::class, 'makeTask']);
});
