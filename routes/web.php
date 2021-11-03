<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AperoController;
use App\Http\Controllers\PostulationController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('aperos', AperoController::class);
Route::patch('/aperos/{apero}/close', [AperoController::class, 'close'])->name('aperos.close');

Route::get('/lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'fr'])) {
        abort(400);
    }

    session()->put('locale', $locale);
    return redirect()->back();
});

// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'createAccount'])->name('auth.createAccount');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Postulations route
Route::post('/aperos/{apero}/postulations', [PostulationController::class, 'store'])->name('postulations.store');
Route::patch('/aperos/{apero}/postulations/{postulation}/cancel', [PostulationController::class, 'cancel'])->name('postulations.cancel');

Route::get('/mypostulations', [PostulationController::class, 'index'])->name('postulations.index');

Route::patch('/aperos/{apero}/postulations/{postulation}/accept', [PostulationController::class, 'accept'])->name('postulations.accept');

Route::patch('/aperos/{apero}/postulations/{postulation}/decline', [PostulationController::class, 'decline'])->name('postulations.decline');