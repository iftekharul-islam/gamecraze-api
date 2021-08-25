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
        Route::get('article/{slug}','\App\Http\Controllers\ArticleController@show')->name('article.show');
        Route::get('article/edit/{slug}','\App\Http\Controllers\ArticleController@edit')->name('article.edit');
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
        Route::get('rent-post/edit/{id}','\App\Http\Controllers\RentController@edit')->name('rentPost.edit');
        Route::post('rent-post/update/{id}','\App\Http\Controllers\RentController@update')->name('rentPost.update');
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
        Route::delete('user/delete/{id}','\App\Http\Controllers\UserController@destory')->name('user.delete');
        Route::post('user/verification/{id}','\App\Http\Controllers\UserController@UserIdVerification')->name('user.verification');
        //user export
        Route::get('customer/export/', '\App\Http\Controllers\UserController@export')->name('customer.export');
        //Base price Crud
        Route::get('base-prices','\App\Http\Controllers\BasePriceController@index')->name('basePrice.all');
        Route::get('create/base-price','\App\Http\Controllers\BasePriceController@create')->name('basePrice.create');
        Route::post('store/base-price','\App\Http\Controllers\BasePriceController@store')->name('basePrice.store');
        Route::get('base-price/edit/{id}','\App\Http\Controllers\BasePriceController@edit')->name('basePrice.edit');
        Route::post('base-price/update/{id}','\App\Http\Controllers\BasePriceController@update')->name('basePrice.update');
        Route::delete('base-price/destroy/{id}','\App\Http\Controllers\BasePriceController@destroy')->name('basePrice.destroy');
//        //Commission Crud
//        Route::get('commission','\App\Http\Controllers\CommissionController@index')->name('commission');
//        Route::get('create/commission','\App\Http\Controllers\CommissionController@create')->name('commission.create');
//        Route::post('store/commission','\App\Http\Controllers\CommissionController@store')->name('commission.store');
//        Route::get('commission/edit/{id}','\App\Http\Controllers\CommissionController@edit')->name('commission.edit');
//        Route::post('commission/update/{id}','\App\Http\Controllers\CommissionController@update')->name('commission.update');
//        Route::delete('commission/destroy/{id}','\App\Http\Controllers\CommissionController@destroy')->name('commission.destroy');
        //Discount Crud
//        Route::get('discount','\App\Http\Controllers\DiscountController@index')->name('discount');
//        Route::get('create/discount','\App\Http\Controllers\DiscountController@create')->name('discount.create');
//        Route::post('store/discount','\App\Http\Controllers\DiscountController@store')->name('discount.store');
//        Route::get('discount/edit/{id}','\App\Http\Controllers\DiscountController@edit')->name('discount.edit');
//        Route::post('discount/update/{id}','\App\Http\Controllers\DiscountController@update')->name('discount.update');
//        Route::delete('discount/destroy/{id}','\App\Http\Controllers\DiscountController@destroy')->name('discount.destroy');

        //Extend
        Route::get('extend-requests','\App\Http\Controllers\ExtendLendController@index')->name('extend.request');
        Route::get('approve-request/{id}','\App\Http\Controllers\ExtendLendController@approve')->name('extend.request.approve');
        Route::get('reject-requests/{id}','\App\Http\Controllers\ExtendLendController@reject')->name('extend.request.reject');
        //Post Report
        Route::get('post-report','\App\Http\Controllers\PostReportController@index')->name('post.report');
        Route::get('post-report/show/{id}','\App\Http\Controllers\PostReportController@show')->name('post.report.show');
        Route::get('approve-request/{id}','\App\Http\Controllers\PostReportController@approve')->name('post.report.approve');
        Route::get('reject-requests/{id}','\App\Http\Controllers\PostReportController@reject')->name('post.report.reject');
        //withdraw request
        Route::get('withdraw-requests','\App\Http\Controllers\WithdrawRequestController@index')->name('withdraw.request');
        Route::get('withdraw-approve/{id}','\App\Http\Controllers\WithdrawRequestController@approve')->name('withdraw.request.approve');
        Route::get('withdraw-reject/{id}','\App\Http\Controllers\WithdrawRequestController@reject')->name('withdraw.request.reject');
        // Coupon CRUD
        Route::get('coupon','\App\Http\Controllers\CouponController@index')->name('coupon');
        Route::get('create/discount','\App\Http\Controllers\CouponController@create')->name('coupon.create');
        Route::post('store/discount','\App\Http\Controllers\CouponController@store')->name('coupon.store');
        Route::get('show/discount/{id}','\App\Http\Controllers\CouponController@show')->name('coupon.show');
        Route::get('discount/edit/{id}','\App\Http\Controllers\CouponController@edit')->name('coupon.edit');
        Route::post('discount/update/{id}','\App\Http\Controllers\CouponController@update')->name('coupon.update');
        Route::delete('discount/destroy/{id}','\App\Http\Controllers\CouponController@destroy')->name('coupon.destroy');

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

        // Featured video
        Route::get('videos','\App\Http\Controllers\FeaturedVideoController@index')->name('video.all');
        Route::get('videos/{id}','\App\Http\Controllers\FeaturedVideoController@show')->name('video.show');
        Route::get('create/video','\App\Http\Controllers\FeaturedVideoController@create')->name('video.create');
        Route::post('store/video','\App\Http\Controllers\FeaturedVideoController@store')->name('video.store');
        Route::get('video/edit/{id}','\App\Http\Controllers\FeaturedVideoController@edit')->name('video.edit');
        Route::post('video/update/{id}','\App\Http\Controllers\FeaturedVideoController@update')->name('video.update');
        Route::delete('video/delete/{id}','\App\Http\Controllers\FeaturedVideoController@destroy')->name('featured.video.delete');

        //Cover image
        Route::get('cover-image','\App\Http\Controllers\CoverImageController@index')->name('cover.all');
        Route::get('create/cover-image','\App\Http\Controllers\CoverImageController@create')->name('cover.create');
        Route::post('store/cover-image','\App\Http\Controllers\CoverImageController@store')->name('cover.store');
        Route::delete('cover-image/delete/{id}','\App\Http\Controllers\CoverImageController@destroy')->name('cover.delete');

        //game orders
        Route::get('orders','\App\Http\Controllers\GameOrderController@index')->name('orders.all');
        Route::get('orders/{id}','\App\Http\Controllers\GameOrderController@show')->name('orders.show');
        Route::post('order-status/{status_type}/{order_id}','\App\Http\Controllers\GameOrderController@updateOrderStatus')->name('orders.status.update');
        Route::post('order-disk-status/{lend_id}','\App\Http\Controllers\LendController@updateStatus')->name('orders.disk.status.update');

        // Delivery Charges
        Route::get('delivery-charges','\App\Http\Controllers\DeliveryChargeController@index')->name('deliveryCharge.all');
        Route::get('delivery-charges/create','\App\Http\Controllers\DeliveryChargeController@create')->name('deliveryCharge.create');
        Route::post('delivery-charges','\App\Http\Controllers\DeliveryChargeController@store')->name('deliveryCharge.store');
        Route::get('delivery-charges/edit/{id}','\App\Http\Controllers\DeliveryChargeController@edit')->name('deliveryCharge.edit');
        Route::post('delivery-charges/update/{id}','\App\Http\Controllers\DeliveryChargeController@update')->name('deliveryCharge.update');
        Route::delete('delivery-charges/delete/{id}','\App\Http\Controllers\DeliveryChargeController@destroy')->name('deliveryCharge.destroy');

        // Transaction History
        Route::get('transaction-history','\App\Http\Controllers\TransactionHistoryController@index')->name('transaction.history');
        Route::get('pay-amount/{id}','\App\Http\Controllers\TransactionHistoryController@payAmount')->name('pay.amount');
        Route::get('my-lender-posts/{id}','\App\Http\Controllers\TransactionHistoryController@myLendPost')->name('my.lend.post');
        Route::post('payment/{id}','\App\Http\Controllers\TransactionHistoryController@payment')->name('payment');
        //Transaction export
        Route::get('transaction/export', '\App\Http\Controllers\TransactionHistoryController@transactionExport')->name('transaction.export');

        // Referral history
        Route::get('referral-history','\App\Http\Controllers\UserController@referralHistory')->name('referral.history');
        // Wallet spend history
        Route::get('wallet-spend-history','\App\Http\Controllers\UserController@walletSpendHistory')->name('wallet.history');
        Route::get('my-spend-list/{id}','\App\Http\Controllers\UserController@walletSpendById')->name('wallet.spend.show');
        //notice
        Route::get('notice','\App\Http\Controllers\NoticeController@index')->name('notice');
        Route::post('notice/store','\App\Http\Controllers\NoticeController@store')->name('notice.store');
        Route::get('notice/edit/{id}','\App\Http\Controllers\NoticeController@edit')->name('notice.edit');
        Route::post('notice/update/{id}','\App\Http\Controllers\NoticeController@update')->name('notice.update');
        Route::delete('notice/delete/{id}','\App\Http\Controllers\NoticeController@destroy')->name('notice.delete');

        //meta
        Route::get('meta','\App\Http\Controllers\MetaController@index')->name('meta');
        Route::post('meta/store','\App\Http\Controllers\MetaController@store')->name('meta.store');
        Route::get('meta/edit/{id}','\App\Http\Controllers\MetaController@edit')->name('meta.edit');
        Route::post('meta/update/{id}','\App\Http\Controllers\MetaController@update')->name('meta.update');
        Route::delete('meta/delete/{id}','\App\Http\Controllers\MetaController@destroy')->name('meta.delete');

        //Category
        Route::get('category','\App\Http\Controllers\CategoryController@index')->name('category');
        Route::get('category/create','\App\Http\Controllers\CategoryController@create')->name('category.create');
        Route::post('category/store','\App\Http\Controllers\CategoryController@store')->name('category.store');
        Route::get('category/edit/{id}','\App\Http\Controllers\CategoryController@edit')->name('category.edit');
        Route::post('category/update/{id}','\App\Http\Controllers\CategoryController@update')->name('category.update');
        Route::delete('category/delete/{id}','\App\Http\Controllers\CategoryController@destroy')->name('category.destroy');

        //Sub Category
        Route::get('sub-category','\App\Http\Controllers\SubCategoryController@index')->name('subcategory');
        Route::get('sub-category/create','\App\Http\Controllers\SubCategoryController@create')->name('subcategory.create');
        Route::post('sub-category/store','\App\Http\Controllers\SubCategoryController@store')->name('subcategory.store');
        Route::get('sub-category/{id}','\App\Http\Controllers\SubCategoryController@show')->name('subcategory.show');
        Route::get('sub-category/edit/{id}','\App\Http\Controllers\SubCategoryController@edit')->name('subcategory.edit');
        Route::post('sub-category/update/{id}','\App\Http\Controllers\SubCategoryController@update')->name('subcategory.update');
        Route::delete('sub-category/delete/{id}','\App\Http\Controllers\SubCategoryController@destroy')->name('subcategory.destroy');

        //Product
        Route::get('product','\App\Http\Controllers\ProductController@index')->name('product');
        Route::get('product/create','\App\Http\Controllers\ProductController@create')->name('product.create');
        Route::post('product/store','\App\Http\Controllers\ProductController@store')->name('product.store');
        Route::get('product/{id}','\App\Http\Controllers\ProductController@show')->name('product.show');
        Route::get('product/edit/{id}','\App\Http\Controllers\ProductController@edit')->name('product.edit');
        Route::post('product/update/{id}','\App\Http\Controllers\ProductController@update')->name('product.update');
        Route::delete('product/delete/{id}','\App\Http\Controllers\ProductController@destroy')->name('product.destroy');
        Route::get('product/approve/{id}','\App\Http\Controllers\ProductController@approve')->name('product.approve');
        Route::post('product/reject/{id}','\App\Http\Controllers\ProductController@reject')->name('product.reject');

        //bkash
//        Route::get('/travel-bkash', '\App\Http\Controllers\TransactionHistoryController@payBkash');
        Route::post('/initiate-bkash', '\App\Http\Controllers\TransactionHistoryController@payBkash')->name('travel-initiate-bkash');
        Route::post('/confirm-bkash', '\App\Http\Controllers\TransactionHistoryController@executeBkashPayment')->name('travel-confirm-bkash');
    });
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
