<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
});

$api->version('v2', function ($api) {
    $api->get('/', function() {
        return ['Fruits' => 'For Human also Delicious and healthy!'];
    });
});


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
