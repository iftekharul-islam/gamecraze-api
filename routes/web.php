<?php

use Illuminate\Support\Facades\Mail;
use App\Mail\SendPasswordResetMail;
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
        //Search bar
        Route::get('search','\App\Http\Controllers\SearchController@index')->name('search');
        Route::get('autocomplete','\App\Http\Controllers\SearchController@autocomplete')->name('autocomplete');

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
        Route::get('game/edit/{id}','\App\Http\Controllers\GameController@edit')->name('game.edit');
        Route::post('game/update/{id}','\App\Http\Controllers\GameController@update')->name('game.update');
        Route::delete('game/destroy/{id}','\App\Http\Controllers\GameController@destroy')->name('game.destroy');
        //game video url delete
        Route::delete('games-video/destroy/{id}','\App\Http\Controllers\GameController@videoDestroy')->name('video.destroy');
        //game screenshots  delete
        Route::delete('games-screenshots/destroy/{id}','\App\Http\Controllers\GameController@screenshotsDestroy')->name('screenshots.destroy');
        // New & articles section
        Route::get('articles','\App\Http\Controllers\ArticleController@index')->name('all-article');
        Route::get('create/article','\App\Http\Controllers\ArticleController@create')->name('article.create');
        Route::post('store/article','\App\Http\Controllers\ArticleController@store')->name('article.store');
        Route::get('article/{id}','\App\Http\Controllers\ArticleController@show')->name('article.show');
        Route::get('article/edit/{id}','\App\Http\Controllers\ArticleController@edit')->name('article.edit');
        Route::post('article/update/{id}','\App\Http\Controllers\ArticleController@update')->name('article.update');
        Route::delete('article/destroy/{id}','\App\Http\Controllers\ArticleController@destroy')->name('article.destroy');
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
        // users
        Route::get('users','\App\Http\Controllers\UserController@index')->name('user.all');
        Route::get('user/{id}','\App\Http\Controllers\UserController@show')->name('user.show');
        Route::get('create/user','\App\Http\Controllers\UserController@create')->name('user.create');
        Route::post('store/user','\App\Http\Controllers\UserController@store')->name('user.store');
        Route::get('user/edit/{id}','\App\Http\Controllers\UserController@edit')->name('user.edit');
        Route::post('user/update/{id}','\App\Http\Controllers\UserController@update')->name('user.update');
        //Base price Crud
        Route::get('base-prices','\App\Http\Controllers\BasePriceController@index')->name('basePrice.all');
        Route::get('create/base-price','\App\Http\Controllers\BasePriceController@create')->name('basePrice.create');
        Route::post('store/base-price','\App\Http\Controllers\BasePriceController@store')->name('basePrice.store');
        Route::get('base-price/edit/{id}','\App\Http\Controllers\BasePriceController@edit')->name('basePrice.edit');
        Route::post('base-price/update/{id}','\App\Http\Controllers\BasePriceController@update')->name('basePrice.update');
        Route::delete('base-price/destroy/{id}','\App\Http\Controllers\BasePriceController@destroy')->name('basePrice.destroy');
        //Division Crud
        Route::get('divisions','\App\Http\Controllers\DivisionController@index')->name('division.all');
        Route::get('create/division','\App\Http\Controllers\DivisionController@create')->name('division.create');
        Route::post('store/division','\App\Http\Controllers\DivisionController@store')->name('division.store');
        Route::get('division/edit/{id}','\App\Http\Controllers\DivisionController@edit')->name('division.edit');
        Route::post('division/update/{id}','\App\Http\Controllers\DivisionController@update')->name('division.update');
        Route::delete('division/destroy/{id}','\App\Http\Controllers\DivisionController@destroy')->name('division.destroy');
         //District Crud
        Route::get('districts','\App\Http\Controllers\DistrictController@index')->name('district.all');
        Route::get('create/district','\App\Http\Controllers\DistrictController@create')->name('district.create');
        Route::post('store/district','\App\Http\Controllers\DistrictController@store')->name('district.store');
        Route::get('district/edit/{id}','\App\Http\Controllers\DistrictController@edit')->name('district.edit');
        Route::post('district/update/{id}','\App\Http\Controllers\DistrictController@update')->name('district.update');
        Route::delete('district/destroy/{id}','\App\Http\Controllers\DistrictController@destroy')->name('district.destroy');
        //Thana Crud
        Route::get('thanas','\App\Http\Controllers\ThanaController@index')->name('thana.all');
        Route::get('create/thana','\App\Http\Controllers\ThanaController@create')->name('thana.create');
        Route::post('store/thana','\App\Http\Controllers\ThanaController@store')->name('thana.store');
        Route::get('thana/edit/{id}','\App\Http\Controllers\ThanaController@edit')->name('thana.edit');
        Route::post('thana/update/{id}','\App\Http\Controllers\ThanaController@update')->name('thana.update');
        Route::delete('thana/destroy/{id}','\App\Http\Controllers\ThanaController@destroy')->name('thana.destroy');
        //Area Crud
        Route::get('areas','\App\Http\Controllers\AreaController@index')->name('area.all');
        Route::get('create/area','\App\Http\Controllers\AreaController@create')->name('area.create');
        Route::post('store/area','\App\Http\Controllers\AreaController@store')->name('area.store');
        Route::get('area/edit/{id}','\App\Http\Controllers\AreaController@edit')->name('area.edit');
        Route::post('area/update/{id}','\App\Http\Controllers\AreaController@update')->name('area.update');
        Route::delete('area/destroy/{id}','\App\Http\Controllers\AreaController@destroy')->name('area.destroy');
        // Checkpoint Crud
        Route::get('checkpoints','\App\Http\Controllers\CheckpointController@index')->name('checkpoint.all');
        Route::get('checkpoint/{id}','\App\Http\Controllers\CheckpointController@show')->name('checkpoint.show');
        Route::get('create/checkpoint','\App\Http\Controllers\CheckpointController@create')->name('checkpoint.create');
        Route::post('store/checkpoint','\App\Http\Controllers\CheckpointController@store')->name('checkpoint.store');
        Route::get('checkpoint/edit/{id}','\App\Http\Controllers\CheckpointController@edit')->name('checkpoint.edit');
        Route::post('checkpoint/update/{id}','\App\Http\Controllers\CheckpointController@update')->name('checkpoint.update');
    });
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
