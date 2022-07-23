<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserResponseController;
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

Route::get('/', static function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

// unsubscribe
Route::get('unsubscribe/{user_hash}', array(UserController::class, 'unsubscribe'))->name('user.unsubscribe');

Route::middleware(array('auth', 'verified'))->group(function () {
    Route::get('dashboard', static function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('user', array(UserController::class, 'index'))->name('user.index');
    Route::get('message', array(MessageController::class, 'index'))->name('message.index');
    Route::post('message', [MessageController::class, 'sendMail'])->name('message.create');
    Route::get('response/{user}/{type}/{id}', [UserResponseController::class, 'index'])->name('user.response');
});

require __DIR__ . '/auth.php';
