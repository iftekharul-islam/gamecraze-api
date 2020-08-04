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

        // Login & Register
        $api->post('register', 'App\Http\Controllers\API\AuthController@register');
        $api->post('login', 'App\Http\Controllers\API\AuthController@login');
        // OTP
        $api->post('send-otp', 'App\Http\Controllers\API\OneTimePasswordController@sendOtp');
        $api->post('verify-otp', 'App\Http\Controllers\API\OneTimePasswordController@verifyOtp');
        // Reset Password
        $api->post('send-reset-code', 'App\Http\Controllers\API\ResetPasswordController@sendResetCode');
        $api->post('verify-reset-code', 'App\Http\Controllers\API\ResetPasswordController@verifyResetCode');

        // Games
        $api->get('games/latest', 'App\Http\Controllers\API\GameController@latestGames');
        $api->get('games/{id}', 'App\Http\Controllers\API\GameController@show');
        $api->get('games/', 'App\Http\Controllers\API\GameController@index');
        // Genres
        $api->get('genres/{id}', 'App\Http\Controllers\API\GenreController@show');
        $api->get('genres/', 'App\Http\Controllers\API\GenreController@index');
        // Search
        $api->get('search', 'App\Http\Controllers\API\SearchController@search');
        // Platforms
        $api->get('platforms/{id}', 'App\Http\Controllers\API\PlatformController@show');
        $api->get('platforms', 'App\Http\Controllers\API\PlatformController@index');
//        $api->post('platforms', 'App\Http\Controllers\API\PlatformController@store');
        $api->put('platforms/{id}', 'App\Http\Controllers\API\PlatformController@update');
        $api->delete('platforms/{id}', 'App\Http\Controllers\API\PlatformController@destroy');

        // Exchanges
        $api->get('exchanges', 'App\Http\Controllers\API\ExchangeController@getActiveExchange');
        $api->get('exchanges', 'App\Http\Controllers\API\ExchangeController@index');

        $api->get('categories/{slug}', 'App\Http\Controllers\API\CategoryController@index');

        //Rent get
	    $api->get('rents/{id}', 'App\Http\Controllers\API\RentController@show');
	    $api->get('cart-items', 'App\Http\Controllers\API\RentController@cartItems');
	    $api->get('rent-posts', 'App\Http\Controllers\API\RentController@allRent');

        //disk-condition get
        $api->get('disk-conditions/{id}', 'App\Http\Controllers\API\DiskConditionController@show');
        $api->get('disk-conditions', 'App\Http\Controllers\API\DiskConditionController@index');

        //pay
        $api->post('/pay', 'App\Http\Controllers\API\SslCommerzPaymentController@payViaAjax');
        $api->post('/success', 'App\Http\Controllers\API\SslCommerzPaymentController@success');
        $api->post('/fail', 'App\Http\Controllers\API\SslCommerzPaymentController@fail');
        $api->post('/cancel', 'App\Http\Controllers\API\SslCommerzPaymentController@cancel');
        $api->post('/ipn', 'App\Http\Controllers\API\SslCommerzPaymentController@ipn');

        //Rent Posted Users
        $api->get('rent-posted-users/{id}', 'App\Http\Controllers\API\RentController@rentPostedUsers');

        $api->group(['middleware' => 'auth:api'], function($api) {
            // Users
            $api->get('users', 'App\Http\Controllers\API\UserController@index');
            $api->get('user/details', 'App\Http\Controllers\API\UserController@show');
            $api->put('users', 'App\Http\Controllers\API\AuthController@update');
            $api->delete('user/destroy/{id}', 'App\Http\Controllers\API\AuthController@destroy');
            $api->post('logout', 'App\Http\Controllers\API\AuthController@logout');
            // Users Role & Permission

            //For rent purpose
            $api->get('rents/', 'App\Http\Controllers\API\RentController@index');
            $api->post('rents/', 'App\Http\Controllers\API\RentController@store');
            $api->delete('rents/{id}', 'App\Http\Controllers\API\RentController@destroy');
            $api->put('rents/{id}', 'App\Http\Controllers\API\RentController@update');

            $api->post('user/role/create','App\Http\Controllers\API\UserController@createRole');
            $api->get('user/role/show','App\Http\Controllers\API\UserController@showRole');
            $api->post('user/permission/create','App\Http\Controllers\API\UserController@createPermission');
            $api->get('user/permission/show','App\Http\Controllers\API\UserController@showPermission');

            $api->post('role-permission/{role_id}/{per_id}','App\Http\Controllers\API\UserController@rolehasPermission');
            $api->post('user-role/{user_id}/{role_id}','App\Http\Controllers\API\UserController@userhasRole');
            $api->post('user-permission/{user_id}/{per_id}','App\Http\Controllers\API\UserController@userhasPermission');
            //User Profile
            $api->get('profile', 'App\Http\Controllers\API\UserController@profile');
            //Lend Game
            $api->post('lend-game', 'App\Http\Controllers\API\LenderController@store');
            $api->get('lends', 'App\Http\Controllers\API\LenderController@index');
            //Payment
            $api->get('success-payment', 'App\Http\Controllers\API\PaymentController@success');
            $api->get('fail-payment', 'App\Http\Controllers\API\PaymentController@success');

            // Admin
            $api->group(['middleware' => 'role:admin'], function ($api) {
                // Games
                $api->post('games/', 'App\Http\Controllers\API\GameController@store');
                $api->delete('games/{id}', 'App\Http\Controllers\API\GameController@destroy');
                $api->put('games/{id}', 'App\Http\Controllers\API\GameController@update');
                // Genres
                $api->post('genres/', 'App\Http\Controllers\API\GenreController@store');
                $api->delete('genres/{id}', 'App\Http\Controllers\API\GenreController@destroy');
                $api->put('genres/{id}', 'App\Http\Controllers\API\GenreController@update');
                // Managements
                $api->get('managements/{id}', 'App\Http\Controllers\API\ManagementController@show');
                $api->get('managements/', 'App\Http\Controllers\API\ManagementController@index');
                $api->post('managements/', 'App\Http\Controllers\API\ManagementController@store');
                $api->delete('managements/{id}', 'App\Http\Controllers\API\ManagementController@destroy');
                $api->put('managements/{id}', 'App\Http\Controllers\API\ManagementController@update');
                // Platforms
                $api->post('platforms/', 'App\Http\Controllers\API\PlatformController@store');
                $api->delete('platforms/{id}', 'App\Http\Controllers\API\PlatformController@destroy');
                $api->put('platforms/{id}', 'App\Http\Controllers\API\PlatformController@update');

                //Disk Conditions Crud
                $api->post('disk-conditions', 'App\Http\Controllers\API\DiskConditionController@store');
                $api->delete('disk-conditions/{id}', 'App\Http\Controllers\API\DiskConditionController@destroy');
                $api->put('disk-conditions/{id}', 'App\Http\Controllers\API\DiskConditionController@update');
            });

            $api->post('exchanges/', 'App\Http\Controllers\API\PostController@store');
            $api->get('exchanges/{id}', 'App\Http\Controllers\API\PostController@show');
//            $api->get('exchanges/', 'App\Http\Controllers\API\PostController@index');
            $api->delete('exchanges/{id}', 'App\Http\Controllers\API\PostController@destroy');
            $api->put('exchanges/{id}', 'App\Http\Controllers\API\PostController@update');

            $api->post('requests/', 'App\Http\Controllers\API\UserRequestController@store');
            $api->get('requests/', 'App\Http\Controllers\API\UserRequestController@index');
            $api->get('requests/{id}', 'App\Http\Controllers\API\UserRequestController@show');
            $api->delete('requests/{id}', 'App\Http\Controllers\API\UserRequestController@destroy');

            $api->post('requests/accept', 'App\Http\Controllers\API\AcceptRequestController@acceptRequest');
        });
    });

    $api->version('v2', function ($api) {
    });
