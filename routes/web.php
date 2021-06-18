<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->name('home')->middleware(["role:user"]);

Route::get('/admin_home', [App\Http\Controllers\Admin\HomeController::class, 'index'])
->middleware(["role:admin"]);

Route::view('login','livewire.home');

Route::get('/livewire-pagination', App\Http\Livewire\SearchPagination::class)->name('livewire-pagination')->middleware('auth');