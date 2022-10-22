<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\CategoryController;


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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/schedule/{id}/act', [ActionController::class, 'act'])->name('action.act');
    Route::get('/music/storemusic/{query?}/{type?}', [MusicController::class, 'storeDownloadedMusicInformation'])->name('music.storemusic');
    Route::resource('music', MusicController::class);
    Route::resource('action', ActionController::class);
    Route::resource('schedule', ScheduleController::class);
    Route::resource('category', CategoryController::class);
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    
});

require __DIR__.'/auth.php';


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
