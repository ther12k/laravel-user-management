<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NppbkcController;

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Nppbkc\View;
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

    Route::get('password/reset', Email::class)
        ->name('password.request');
    
    Route::get('password/reset/{token}', Reset::class)
        ->name('password.reset');
});

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
    
    Route::get('/update-profile',\App\Http\Livewire\UpdateProfile::class)->name('user.profile');

    Route::middleware(['verified','profile'])->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/users', [UserController::class, 'index'])->name('users');
        // Route::get('/nppbkc-wizard', function () {
        //     return view('nppbkc-wizard');
        // });
        
        Route::get('/nppbkc/add', \App\Http\Livewire\Nppbkc\Wizard::class)->name('nppbkc.add');

        Route::get('/nppbkc/{id}', \App\Http\Livewire\Nppbkc\View::class)->name('nppbkc.view');
        Route::get('/nppbkc/edit/{id}', \App\Http\Livewire\Nppbkc\Wizard::class)->name('nppbkc.edit');
    
        Route::get('/nppbkc/surat-permohonan-lokasi/{id}', [NppbkcController::class, 'surat_permohonan_lokasi'])
            ->name('nppbkc.surat-permohonan-lokasi');
            Route::get('/nppbkc/download-file/{id}', [NppbkcController::class, 'download'])
                ->name('nppbkc.download-file');
        Route::get('/nppbkc/generatenppbkc/{id}', [NppbkcController::class, 'generate_nppbkc'])
            ->name('nppbkc.generate');
        Route::get('/nppbkc/generate-cek-lokasi/{id}', [NppbkcController::class, 'generate_permohonan_cek_lokasi'])
            ->name('nppbkc.generate-cek-lokasi');
    
        Route::get('/activity-log', function () {
            return view('activity-log');
        })->name('activity-log');
        
        Route::get('/nppbkc', [NppbkcController::class, 'index']);
        Route::get('/nppbkc/permohonan_lokasi_pdf', [NppbkcController::class, 'permohonan_lokasi_pdf']);
        Route::get('/nppbkc/permohonan_nppbkc_pdf', [NppbkcController::class, 'permohonan_nppbkc_pdf']);
        // Route::get('/users', App\Http\Livewire\Users::class)->name('users');

    });
});
