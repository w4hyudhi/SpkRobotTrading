<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\NilaiAlternatifController;
use App\Http\Controllers\SubkriteriaController;
use App\Models\NilaiAlternatif;
use App\Models\Subkriteria;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('hasil', [\App\Http\Controllers\HasilController::class, 'index'])->name('hasil');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::resource('kriteria', KriteriaController::class)->parameters([
        'kriteria' => 'kriteria'
    ]);


    Route::resource('kriteria.sub', SubkriteriaController::class)->parameters([
        'kriteria' => 'kriteria'])->shallow();

     Route::resource('alternatif',AlternatifController::class);
     Route::resource('nilai', NilaiAlternatifController::class)->parameters([
        'nilai' => 'nilai'
    ]);

    //  Route::get('nilai', [\App\Http\Controllers\NilaiAlternatifController::class, 'index'])->name('nilai');


});
