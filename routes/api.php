<?php

use Illuminate\Http\Request;

use App\Http\Resources\Post as PostResource;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('test', function() {
    // $posts = new PostResource(\App\User::all());

    return 'Api Cae Ready';
});

Route::group(['prefix' => 'v1'], function() {

    Route::get('url_image_api', function() {
        return asset('storage/');
    });

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::apiResources([
        'goods' => 'GoodController',
        'donations' => 'DonationController',
    ]);

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'AuthController@logout');
    });
});
