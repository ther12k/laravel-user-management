<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NppbkcController;

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\NppbkcWizard;
use Illuminate\Support\Facades\Route;

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

// Route::redirect('/', '/login');

Route::get('/', function () {
    return view('home');
})->middleware(['auth','verified']);

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {

    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');
    
    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');    

    Route::post('logout', LogoutController::class)
        ->name('logout');
    
    Route::middleware('verified')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/nppbkc-wizard', function () {
            return view('nppbkc-wizard');
        });
        Route::get('/nppbkc/add', function () {
            return view('nppbkc-wizard');
        })->name('add.nppbkc');
    
        Route::get('/nppbkc/{id}', function () {
            return view('nppbkc');
        })->name('view.nppbkc');
    
        Route::get('/nppbkc/downloadfile/{id}', [NppbkcController::class, 'download'])->name('nppbkc.downloadfile');
        Route::get('/nppbkc/generatenppbkc/{id}', [NppbkcController::class, 'generate_nppbkc'])->name('nppbkc.generate');
        Route::get('/nppbkc/generate_permohonan_cek_lokasi/{id}', [NppbkcController::class, 'generate_permohonan_cek_lokasi'])->name('nppbkc-cek.generate');
    
        Route::get('/activity-log', function () {
            return view('activity-log');
        });
        Route::get('/nppbkc', [NppbkcController::class, 'index']);
        Route::get('/nppbkc/permohonan_lokasi_pdf', [NppbkcController::class, 'permohonan_lokasi_pdf']);
        Route::get('/nppbkc/permohonan_nppbkc_pdf', [NppbkcController::class, 'permohonan_nppbkc_pdf']);
        Route::get('/update-profile', function () {
            return view('update-profile');
        });
        Route::get('/users', App\Http\Livewire\Users::class)->name('users');
    });
});
