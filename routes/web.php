<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\AtributController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\JoinController;
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
    return view('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('heros/trash', [HeroController::class, 'deletelist']);
    Route::get('heros/trash/{hero}/restore', [HeroController::class, 'restore']);
    Route::get('heros/trash/{hero}/forcedelete', [HeroController::class, 'deleteforce']);
    Route::resource('heros', HeroController::class);

    Route::get('atributs/trash', [AtributController::class, 'deletelist']);
    Route::get('atributs/trash/{atribut}/restore', [AtributController::class, 'restore']);
    Route::get('atributs/trash/{atribut}/forcedelete', [AtributController::class, 'deleteforce']);
    Route::resource('atributs', AtributController::class);

    Route::get('posisis/trash', [posisiController::class, 'deletelist']);
    Route::get('posisis/trash/{posisi}/restore', [posisiController::class, 'restore']);
    Route::get('posisis/trash/{posisi}/forcedelete', [posisiController::class, 'deleteforce']);
    Route::resource('posisis', PosisiController::class);

    Route::get('/totals', [JoinController::class, 'index']);
    Route::post('soft/{id}', [HeroController::class, 'soft'])->name('heros.soft');
});