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

Route::get('', '\App\Http\Controllers\Auth\LoginController@login');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => [ 'auth', 'role:admin']], function () {
        Route::get('dashboard','\App\Http\Controllers\DashboardController@index')->name('dashboard');
        //Platform Crud
        Route::get('platforms','\App\Http\Controllers\PlatformController@index')->name('all-platform');
        Route::get('create/platform','\App\Http\Controllers\PlatformController@create')->name('platform.create');
        Route::post('store/platforms','\App\Http\Controllers\PlatformController@store')->name('platform.store');
        Route::get('platform/edit/{id}','\App\Http\Controllers\PlatformController@edit')->name('platform.edit');
        Route::post('platform/update/{id}','\App\Http\Controllers\PlatformController@update')->name('platform.update');
        Route::delete('platform/destroy/{id}','\App\Http\Controllers\PlatformController@destroy')->name('platform.destroy');
        //Genre Crud
        Route::get('genres','\App\Http\Controllers\GenreController@index')->name('all-genre');
        Route::get('create/genre','\App\Http\Controllers\GenreController@create')->name('genre.create');
        Route::post('store/genre','\App\Http\Controllers\GenreController@store')->name('genre.store');
        Route::get('genre/edit/{id}','\App\Http\Controllers\GenreController@edit')->name('genre.edit');
        Route::post('genre/update/{id}','\App\Http\Controllers\GenreController@update')->name('genre.update');
        Route::delete('genre/destroy/{id}','\App\Http\Controllers\GenreController@destroy')->name('genre.destroy');
        //Games Crud
        Route::get('games','\App\Http\Controllers\GameController@index')->name('all-game');
        Route::get('create/game','\App\Http\Controllers\GameController@create')->name('game.create');
        Route::get('game/{id}','\App\Http\Controllers\GameController@show')->name('game.show');
        Route::post('store/game','\App\Http\Controllers\GameController@store')->name('game.store');
//        Route::get('game/edit/{id}','\App\Http\Controllers\GameController@edit')->name('game.edit');
//        Route::post('game/update/{id}','\App\Http\Controllers\GameController@update')->name('game.update');
        Route::delete('game/destroy/{id}','\App\Http\Controllers\GameController@destroy')->name('game.destroy');
        //Disk condition Crud
        Route::get('disk-conditions','\App\Http\Controllers\DiskConditionController@index')->name('diskCondition.all');
        Route::get('create/disk-condition','\App\Http\Controllers\DiskConditionController@create')->name('diskCondition.create');
        Route::post('store/disk-condition','\App\Http\Controllers\DiskConditionController@store')->name('diskCondition.store');
        Route::get('disk-condition/edit/{id}','\App\Http\Controllers\DiskConditionController@edit')->name('diskCondition.edit');
        Route::post('disk-condition/update/{id}','\App\Http\Controllers\DiskConditionController@update')->name('diskCondition.update');
        Route::delete('disk-condition/destroy/{id}','\App\Http\Controllers\DiskConditionController@destroy')->name('diskCondition.destroy');
        // Rent Post Crud
        Route::get('rent-posts','\App\Http\Controllers\RentController@index')->name('rentPost.all');
        Route::get('rent-post/{id}','\App\Http\Controllers\RentController@show')->name('rentPost.show');
        Route::post('rent-post/approve/{id}','\App\Http\Controllers\RentController@approve')->name('rentPost.approve');
        Route::post('rent-post/reject/{id}','\App\Http\Controllers\RentController@reject')->name('rentPost.reject');
//        Route::get('create-rent-post','\App\Http\Controllers\RentController@create')->name('rentPost.create');
//        Route::post('store-rent-post','\App\Http\Controllers\RentController@store')->name('rentPost.store');
//        Route::get('rent-post/edit/{id}','\App\Http\Controllers\RentController@edit')->name('rentPost.edit');
//        Route::post('rent-post/update/{id}','\App\Http\Controllers\RentController@update')->name('rentPost.update');
        Route::delete('rent-post/destroy/{id}','\App\Http\Controllers\RentController@destroy')->name('rentPost.destroy');
        // Lend
        Route::get('lends','\App\Http\Controllers\LendController@index')->name('lend.all');
        Route::get('lend/{id}','\App\Http\Controllers\LendController@show')->name('lend.show');
//        Route::get('rent-post/{id}','\App\Http\Controllers\RentController@show')->name('rentPost.show');
//        Route::post('rent-post/approve/{id}','\App\Http\Controllers\RentController@approve')->name('rentPost.approve');
//        Route::post('rent-post/reject/{id}','\App\Http\Controllers\RentController@reject')->name('rentPost.reject');
//        Route::delete('rent-post/destroy/{id}','\App\Http\Controllers\RentController@destroy')->name('rentPost.destroy');

    });
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

