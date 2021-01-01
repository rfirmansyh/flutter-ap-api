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
    $tempats = \App\Tempat::select(\DB::raw('tempats.*, COUNT(*) AS c'))
                        ->leftJoin('reviews', 'tempats.id', '=', 'reviews.tempat_id')
                        ->groupBy(\DB::raw('tempats.id'))
                        ->orderBy('created_at', 'desc')
                        ->paginate(4);
    return $tempats;
});

Route::group(['prefix' => 'v1'], function() {

    Route::get('url_image_api', function() {
        return asset('storage/');
    });

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::post('tempats/upload', 'TempatController@upload');
    Route::get('tempats/search/{keyword}', 'TempatController@search');
    Route::apiResource('tempats', 'TempatController');
    
    Route::get('provinces/search/{keyword}', 'ProvinceController@search');
    Route::apiResource('provinces', 'ProvinceController');
    
    Route::get('kabupatens/getbyprovinceid/{id}', 'KabupatenController@getByProvinceId');
    Route::get('kabupatens/search/{keyword}', 'KabupatenController@search');
    Route::apiResource('kabupatens', 'KabupatenController');
    
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'AuthController@logout');
        Route::apiResources([
            'posts' => 'PostController'
        ]);
    });

});