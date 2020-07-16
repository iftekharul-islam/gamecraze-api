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

Route:: get('/', function () {
    return view('welcome');
});
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::prefix('admin')->group(function () {
    Route::get('login', function () {
        return view('admin.login');
    });
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('dashboard','\App\Http\Controllers\DashboardController@index');
        Route::get('add-platform', function () {
            return view('admin.platform.add-platform');
        });

        Route::get('all-platforms','\App\Http\Controllers\PlatformController@index')->name('all-platform');
        Route::get('create-platform','\App\Http\Controllers\PlatformController@create')->name('platform.create');
        Route::post('store-platforms','\App\Http\Controllers\PlatformController@store')->name('platform.store');
        Route::get('platforms/edit/{id}','\App\Http\Controllers\PlatformController@edit')->name('platform.edit');
        Route::put('platforms/edit/{id}','\App\Http\Controllers\PlatformController@update')->name('platform.update');
        Route::delete('platforms/destroy/{id}','\App\Http\Controllers\PlatformController@destroy')->name('platform.destroy');

        Route::get('all-genres','\App\Http\Controllers\GenreController@index')->name('all-genre');
        Route::get('create-genre','\App\Http\Controllers\GenreController@create')->name('genre.create');
        Route::post('store-genre','\App\Http\Controllers\GenreController@store')->name('genre.store');
        Route::get('genres/edit/{id}','\App\Http\Controllers\GenreController@edit')->name('genre.edit');
        Route::put('genres/edit/{id}','\App\Http\Controllers\GenreController@update')->name('genre.update');
        Route::delete('genres/destroy/{id}','\App\Http\Controllers\GenreController@destroy')->name('genre.destroy');

        Route::get('all-games','\App\Http\Controllers\GameController@index')->name('all-game');
        Route::get('create-game','\App\Http\Controllers\GameController@create')->name('game.create');
        Route::post('store-game','\App\Http\Controllers\GameController@store')->name('game.store');
        Route::get('games/edit/{id}','\App\Http\Controllers\GameController@edit')->name('game.edit');
        Route::put('games/edit/{id}','\App\Http\Controllers\GameController@update')->name('game.update');
        Route::delete('games/destroy/{id}','\App\Http\Controllers\GameController@destroy')->name('game.destroy');

//        Route::get('add-game', function () {
//            return view('admin.game.add-game');
//        });
//        Route::get('all-games', function () {
//            return view('admin.game.all-games');
//        });
        Route::get('add-disk-condition', function () {
            return view('admin.disk-condition.add-disk-condition');
        });
        Route::get('all-disk-conditions', function () {
            return view('admin.disk-condition.all-disk-conditions');
        });
    });
});

//Route:: get('/admin', function () {
//    return view('admin');
//});


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

