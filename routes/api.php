<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('/', function() {
        return ['Fruits' => 'Delicious and healthy!!!'];
    });

    $api->post('register', 'App\Http\Controllers\API\AuthController@register');
    $api->post('login', 'App\Http\Controllers\API\AuthController@login');

    $api->group(['middleware' => 'auth:api'], function($api) {
        $api->get('users', 'App\Http\Controllers\API\UserController@show');
        $api->get('user/details', 'App\Http\Controllers\API\UserController@index');
        $api->post('user/edit/{id}', 'App\Http\Controllers\API\AuthController@edit');
        $api->delete('user/destory/{id}', 'App\Http\Controllers\API\AuthController@destroy');
        $api->post('logout', 'App\Http\Controllers\API\AuthController@logout');

        $api->post('user/role/create','App\Http\Controllers\API\UserController@createRole');
        $api->get('user/role/show','App\Http\Controllers\API\UserController@showRole');
        $api->post('user/permission/create','App\Http\Controllers\API\UserController@createPermission');
        $api->get('user/permission/show','App\Http\Controllers\API\UserController@showPermission');

        $api->post('role-permission/{role_id}/{per_id}','App\Http\Controllers\API\UserController@rolehasPermission');
        $api->post('user-role/{user_id}/{role_id}','App\Http\Controllers\API\UserController@userhasRole');
        $api->post('user-permission/{user_id}/{per_id}','App\Http\Controllers\API\UserController@userhasPermission');
    });
});

$api->version('v2', function ($api) {
    $api->get('/', function() {
        return ['Fruits' => 'For Human Fruits also Delicious and healthy!'];
    });
});


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api->version(['v1','v2'], function ($api) {
    $api->group(['prefix' => 'games'], function ($api) {
        $api->post('/', 'App\Http\Controllers\GameController@store');
        $api->get('/{id}', 'App\Http\Controllers\GameController@show');
        $api->get('/', 'App\Http\Controllers\GameController@index');
        $api->delete('/{id}', 'App\Http\Controllers\GameController@destroy');
        $api->put('/{id}', 'App\Http\Controllers\GameController@update');
    });
});
