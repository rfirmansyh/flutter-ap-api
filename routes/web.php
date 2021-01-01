<?php

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

// Route::get('/', function () {
//     return 'asdfsdaf';
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', function() {
    // $posts = new PostResource(\App\User::all());
    // return $posts;
    $keyword = 'ACEH';
    $tempats = \App\Tempat::select(\DB::raw('tempats.*, COUNT(*) AS c'))
                        ->leftJoin('reviews', 'tempats.id', '=', 'reviews.tempat_id')
                        ->orderBy('created_at', 'desc')
                        ->groupBy('tempats.id')
                        ->paginate(4);
    return 'adfksadfj';
});