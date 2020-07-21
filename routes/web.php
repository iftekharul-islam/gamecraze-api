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
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => [ 'auth', 'role:admin']], function () {
        Route::get('dashboard','\App\Http\Controllers\DashboardController@index')->name('dashboard');
        //Platform Crud
        Route::get('all-platforms','\App\Http\Controllers\PlatformController@index')->name('all-platform');
        Route::get('create-platform','\App\Http\Controllers\PlatformController@create')->name('platform.create');
        Route::post('store-platforms','\App\Http\Controllers\PlatformController@store')->name('platform.store');
        Route::get('platforms/edit/{id}','\App\Http\Controllers\PlatformController@edit')->name('platform.edit');
        Route::post('platforms/update/{id}','\App\Http\Controllers\PlatformController@update')->name('platform.update');
        Route::delete('platforms/destroy/{id}','\App\Http\Controllers\PlatformController@destroy')->name('platform.destroy');
        //Genre Crud
        Route::get('all-genres','\App\Http\Controllers\GenreController@index')->name('all-genre');
        Route::get('create-genre','\App\Http\Controllers\GenreController@create')->name('genre.create');
        Route::post('store-genre','\App\Http\Controllers\GenreController@store')->name('genre.store');
        Route::get('genres/edit/{id}','\App\Http\Controllers\GenreController@edit')->name('genre.edit');
        Route::post('genres/update/{id}','\App\Http\Controllers\GenreController@update')->name('genre.update');
        Route::delete('genres/destroy/{id}','\App\Http\Controllers\GenreController@destroy')->name('genre.destroy');
        //Games Crud
        Route::get('all-games','\App\Http\Controllers\GameController@index')->name('all-game');
        Route::get('create-game','\App\Http\Controllers\GameController@create')->name('game.create');
        Route::post('store-game','\App\Http\Controllers\GameController@store')->name('game.store');
        Route::get('games/edit/{id}','\App\Http\Controllers\GameController@edit')->name('game.edit');
        Route::post('games/update/{id}','\App\Http\Controllers\GameController@update')->name('game.update');
        Route::delete('games/destroy/{id}','\App\Http\Controllers\GameController@destroy')->name('game.destroy');
        //Disk condition Crud
        Route::get('all-disk-conditions','\App\Http\Controllers\DiskConditionController@index')->name('diskCondition.all');
        Route::get('create-disk-condition','\App\Http\Controllers\DiskConditionController@create')->name('diskCondition.create');
        Route::post('store-disk-condition','\App\Http\Controllers\DiskConditionController@store')->name('diskCondition.store');
        Route::get('disk-condition/edit/{id}','\App\Http\Controllers\DiskConditionController@edit')->name('diskCondition.edit');
        Route::post('disk-condition/update/{id}','\App\Http\Controllers\DiskConditionController@update')->name('diskCondition.update');
        Route::delete('disk-condition/destroy/{id}','\App\Http\Controllers\DiskConditionController@destroy')->name('diskCondition.destroy');
        // Rent Post Cru
        Route::get('all-rent-post','\App\Http\Controllers\RentController@index')->name('rentPost.all');
//        Route::get('create-rent-post','\App\Http\Controllers\RentController@create')->name('rentPost.create');
//        Route::post('store-rent-post','\App\Http\Controllers\RentController@store')->name('rentPost.store');
//        Route::get('rent-post/edit/{id}','\App\Http\Controllers\RentController@edit')->name('rentPost.edit');
//        Route::post('rent-post/update/{id}','\App\Http\Controllers\RentController@update')->name('rentPost.update');
        Route::delete('rent-post/destroy/{id}','\App\Http\Controllers\RentController@destroy')->name('rentPost.destroy');

    });
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

