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
        $api->post('verify-email', 'App\Http\Controllers\API\AuthController@emailRegistration');
        // Reset Password
        $api->post('send-reset-code', 'App\Http\Controllers\API\ResetPasswordController@sendResetCode');
        $api->post('verify-reset-code', 'App\Http\Controllers\API\ResetPasswordController@verifyResetCode');

        // Check password is set or not
        $api->post('check-password', 'App\Http\Controllers\API\AuthController@checkPassword');
        $api->post('check-email-exist', 'App\Http\Controllers\API\AuthController@checkEmailExist');

        // Games
        $api->get('games/upcoming-games', 'App\Http\Controllers\API\GameController@upcomingGames');
        $api->get('games/released-games', 'App\Http\Controllers\API\GameController@releasedGames');
        $api->get('games/trending', 'App\Http\Controllers\API\GameController@trendingGames');
        $api->get('games/popular-games', 'App\Http\Controllers\API\GameController@popularGames');
        $api->get('games/{id}', 'App\Http\Controllers\API\GameController@show');
        $api->get('games/slug/{slug}', 'App\Http\Controllers\API\GameController@showBySlug');
        $api->get('games/', 'App\Http\Controllers\API\GameController@index');
        $api->get('all-rent-games/', 'App\Http\Controllers\API\GameController@allRentPosts');
        $api->get('games/related/{genres}', 'App\Http\Controllers\API\GameController@relatedGames');
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
        //disk-condition get
        $api->get('disk-conditions/{id}', 'App\Http\Controllers\API\DiskConditionController@show');
        $api->get('disk-conditions', 'App\Http\Controllers\API\DiskConditionController@index');
        //Base Price get
//        $api->get('base-price/{id}', 'App\Http\Controllers\API\BasePriceController@show');
        $api->get('base-price', 'App\Http\Controllers\API\BasePriceController@index');
        $api->get('base-price/calculate/{id}', 'App\Http\Controllers\API\BasePriceController@calculate');
        $api->get('base-price/game-calculation/{gameId}/{lendWeek}/{diskType}', 'App\Http\Controllers\API\BasePriceController@gameCalculate');
        //Commission percentage
        $api->get('commission', 'App\Http\Controllers\API\CommissionController@index');
        //Checkpoint all
        $api->get('checkpoints','\App\Http\Controllers\API\CheckpointController@index');
        // Exchanges
        $api->get('exchanges', 'App\Http\Controllers\API\ExchangeController@getActiveExchange');
        $api->get('exchanges', 'App\Http\Controllers\API\ExchangeController@index');

        $api->get('categories/{slug}', 'App\Http\Controllers\API\CategoryController@index');

        //Rent get
	    $api->get('rents/{id}', 'App\Http\Controllers\API\RentController@show');
	    $api->get('cart-items', 'App\Http\Controllers\API\RentController@cartItems');
	    $api->get('rent-posts', 'App\Http\Controllers\API\RentController@allRent');
	    $api->get('rent-games', 'App\Http\Controllers\API\GameController@rentGames');
	    $api->get('filter-games', 'App\Http\Controllers\API\GameController@filterGames');
	    $api->get('offer-amount', 'App\Http\Controllers\API\RentController@offerPercentage');

        //pay
        $api->post('/pay', 'App\Http\Controllers\API\SslCommerzPaymentController@payViaAjax');
        $api->post('/success', 'App\Http\Controllers\API\SslCommerzPaymentController@success');
        $api->post('/fail', 'App\Http\Controllers\API\SslCommerzPaymentController@fail');
        $api->post('/cancel', 'App\Http\Controllers\API\SslCommerzPaymentController@cancel');
        $api->post('/ipn', 'App\Http\Controllers\API\SslCommerzPaymentController@ipn');

        //Rent Posted Users
        $api->get('rent-posted-users/{slug}', 'App\Http\Controllers\API\RentController@rentPostedUsers');
        // New & articles section
        Route::get('articles','\App\Http\Controllers\API\ArticleController@index');
        Route::get('top-articles','\App\Http\Controllers\API\ArticleController@topArticles');
        Route::get('article/{id}','\App\Http\Controllers\API\ArticleController@show');
        Route::get('article/related/{id}','\App\Http\Controllers\API\ArticleController@getRelatedArticles');
        Route::get('featured-article','\App\Http\Controllers\API\ArticleController@getFeaturedArticles');

//        $api->post('email-registration', 'App\Http\Controllers\API\AuthController@emailRegistration');

        //contact mail
        Route::post('contact','\App\Http\Controllers\API\ContactController@sendMail');

        Route::get('validate-token/{token}','\App\Http\Controllers\API\ResetPasswordController@validateToken');
        Route::put('update-password','\App\Http\Controllers\API\ResetPasswordController@updatePassword');
        Route::get('featured-videos','\App\Http\Controllers\API\FeaturedVideoController@index');
        Route::post('subscribe','\App\Http\Controllers\API\SubscriptionController@subscribe');
        Route::get('featured-platforms','\App\Http\Controllers\API\PlatformController@featuredPlatforms');
        Route::get('delivery-charge','\App\Http\Controllers\API\DeliveryChargeController@getCharge');
        //notice
        $api->get('notice', 'App\Http\Controllers\API\NoticeController@index');
        $api->post('check-rented', 'App\Http\Controllers\API\RentController@checkRented');


        $api->group(['middleware' => 'auth:api'], function($api) {
            // Users

            $api->put('users', 'App\Http\Controllers\API\AuthController@update');
            $api->put('update-users-by-phone', 'App\Http\Controllers\API\AuthController@updateUserByPhone');
            $api->post('update-user-profile-image', 'App\Http\Controllers\API\AuthController@updateProfileImage'); 
            $api->get('users', 'App\Http\Controllers\API\UserController@index');
            $api->get('user/details', 'App\Http\Controllers\API\UserController@show');
            $api->delete('user/destroy/{id}', 'App\Http\Controllers\API\AuthController@destroy');
            $api->post('logout', 'App\Http\Controllers\API\AuthController@logout');
            $api->post('user-phone-email-validation', 'App\Http\Controllers\API\AuthController@validatePhoneEmail');
            $api->get('rent-limit', 'App\Http\Controllers\API\AuthController@rentLimit');

            //For rent purpose
            $api->get('rents/', 'App\Http\Controllers\API\RentController@index');
            $api->post('rents/', 'App\Http\Controllers\API\RentController@store');
            $api->delete('rents/{id}', 'App\Http\Controllers\API\RentController@destroy');
            $api->put('rents/{id}', 'App\Http\Controllers\API\RentController@update');
            //role crud
            $api->post('user/role/create','App\Http\Controllers\API\UserController@createRole');
            $api->get('user/role/show','App\Http\Controllers\API\UserController@showRole');
            $api->post('user/permission/create','App\Http\Controllers\API\UserController@createPermission');
            $api->get('user/permission/show','App\Http\Controllers\API\UserController@showPermission');
            //permission crud
            $api->post('role-permission/{role_id}/{per_id}','App\Http\Controllers\API\UserController@rolehasPermission');
            $api->post('user-role/{user_id}/{role_id}','App\Http\Controllers\API\UserController@userhasRole');
            $api->post('user-permission/{user_id}/{per_id}','App\Http\Controllers\API\UserController@userhasPermission');
            //User Profile
            $api->get('profile', 'App\Http\Controllers\API\UserController@profile');
            //Lend Game
            $api->post('lend-game', 'App\Http\Controllers\API\LenderController@store');
            $api->get('lends', 'App\Http\Controllers\API\LenderController@index');
            $api->get('my-lends', 'App\Http\Controllers\API\LenderController@myLends');
            //Payment
            $api->get('success-payment', 'App\Http\Controllers\API\PaymentController@success');
            $api->get('fail-payment', 'App\Http\Controllers\API\PaymentController@success');
            //set upcoming game reminder
            $api->post('set-reminder/{game_id}', 'App\Http\Controllers\API\GameReminderController@store');
            //cart item
            $api->get('cart-items', 'App\Http\Controllers\API\CartItemController@index');
            $api->post('cart-item/create', 'App\Http\Controllers\API\CartItemController@store');
            $api->post('cart-item/destroy', 'App\Http\Controllers\API\CartItemController@destroy');

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

            //Transaction history by id
            $api->get('transaction-details', 'App\Http\Controllers\API\TransactionController@transactionById');
            $api->get('payment-history', 'App\Http\Controllers\API\TransactionController@paymentHistory');
        });
    });

    $api->version('v2', function ($api) {
    });
