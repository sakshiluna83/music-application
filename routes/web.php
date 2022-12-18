<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\eventController;
use App\Http\Controllers\authController;

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
Route::get('events', [eventController::class, 'index']);
Route::get('dashboard', [authController::class, 'dashboard']);
Route::get('login', [authController::class, 'index'])->name('login');
Route::post('custom-login', [authController::class, 'customLogin'])->name('login.custom');
Route::get('register', [authController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [authController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [authController::class, 'signOut'])->name('signout');




Route::get('events-list', [eventController::class, 'listEvents']);
Route::get('events/{id}', [eventController::class, 'EventDetails']);
Route::post('update-events', [eventController::class, 'UpdateEventData'])->name('UpdateEventData');
Route::get('event/delete/{id}', [eventController::class, 'eventDelete']);

Route::get('genre-list', [eventController::class, 'listGenre']);
Route::get('genre/{id}', [eventController::class, 'GenreDetails']);
Route::post('update-genre', [eventController::class, 'UpdateGenreData'])->name('UpdateGenreData');
Route::get('genre/delete/{id}', [eventController::class, 'genreDelete']);

Route::get('artist-list', [eventController::class, 'listArtist']);
Route::get('artist/{id}', [eventController::class, 'artistDetails']);
Route::post('update-artist', [eventController::class, 'UpdateArtistData'])->name('UpdateArtistData');
Route::get('artist/delete/{id}', [eventController::class, 'artistDelete']);
