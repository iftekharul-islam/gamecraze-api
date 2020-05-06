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
        $api->get('games/{id}', 'App\Http\Controllers\API\GameController@show');
        $api->get('games/', 'App\Http\Controllers\API\GameController@index');
        $api->get('genres/{id}', 'App\Http\Controllers\API\GenreController@show');
        $api->get('genres/', 'App\Http\Controllers\API\GenreController@index');
        $api->get('categories/{id}', 'App\Http\Controllers\API\CategoryController@show');
        $api->get('categories/', 'App\Http\Controllers\API\CategoryController@index');

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

            $api->group(['middleware' => 'role:admin'], function ($api) {
                $api->post('games/', 'App\Http\Controllers\API\GameController@store');
                $api->delete('games/{id}', 'App\Http\Controllers\API\GameController@destroy');
                $api->put('games/{id}', 'App\Http\Controllers\API\GameController@update');

                $api->post('genres/', 'App\Http\Controllers\API\GenreController@store');
                $api->delete('genres/{id}', 'App\Http\Controllers\API\GenreController@destroy');
                $api->put('genres/{id}', 'App\Http\Controllers\API\GenreController@update');

                $api->post('categories/', 'App\Http\Controllers\API\CategoryController@store');
                $api->delete('categories/{id}', 'App\Http\Controllers\API\CategoryController@destroy');
                $api->put('categories/{id}', 'App\Http\Controllers\API\CategoryController@update');

                $api->get('managements/{id}', 'App\Http\Controllers\API\ManagementController@show');
                $api->get('managements/', 'App\Http\Controllers\API\ManagementController@index');
                $api->post('managements/', 'App\Http\Controllers\API\ManagementController@store');
                $api->delete('managements/{id}', 'App\Http\Controllers\API\ManagementController@destroy');
                $api->put('managements/{id}', 'App\Http\Controllers\API\ManagementController@update');
            });
            $api->post('exchanges/', 'App\Http\Controllers\API\PostController@store');
            $api->get('exchanges/{id}', 'App\Http\Controllers\API\PostController@show');
            $api->get('exchanges/', 'App\Http\Controllers\API\PostController@index');
            $api->delete('exchanges/{id}', 'App\Http\Controllers\API\PostController@destroy');
            $api->put('exchanges/{id}', 'App\Http\Controllers\API\PostController@update');

            $api->post('requests/', 'App\Http\Controllers\API\UserRequestController@store');
        });
    });

    $api->version('v2', function ($api) {
        $api->get('/', function() {
            return ['Fruits' => 'For Human Fruits also Delicious and healthy!'];
        });
    });
