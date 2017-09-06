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

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::get('/dash', function () {
    return view('artist.dashboard');
})->name('dash');

Auth::routes();


//activate account
Route::get('/auth/activate', 'Auth\ActivationController@activate')->name('auth.activate');
Route::get('/auth/activate/resend', 'Auth\ActivationResendController@showResendForm')->name('auth.activate.resend');
Route::post('/auth/activate/resend', 'Auth\ActivationResendController@resend');

//dashboard route
Route::get('/dashboard', 'HomeController@index')->name('dashboard');




Route::post('/webhook/encoding', 'EncodingWebhookController@handle');


/*
 *
 * videos group
 * unauthenticated routes
 *
 * */
Route::group(['prefix' => 'videos'], function (){

    Route::get('/{video}', 'VideoController@show');

    Route::post('/{video}/views', 'VideoViewController@store');

    Route::get('/{video}/votes', 'VideoVoteController@show');


    Route::get('/{video}/comments', 'VideoCommentController@index');
});




Route::get('/search', 'SearchController@index');





Route::get('/subscription/{channel}', 'ChannelSubscriptionController@show');


Route::get('/channel/{channel}', 'ChannelController@show')->name('profile.show');


Route::group(['prefix' => 'account','namespace' => 'Artist', 'middleware' => ['auth']], function (){

    Route::get('/upload', 'PostController@create')->name('account.posts.create');
    Route::get('/post', 'PostController@store')->name('account.posts.store');
});


/*Authenticated routes*/
Route::group(['middleware' => ['auth']], function (){

    Route::get('/upload', 'VideoUploadController@index')->name('upload.index');//depreciated
    Route::post('/upload', 'VideoUploadController@store');

    Route::get('/posts', 'VideoController@index')->name('show.uploads');
    Route::post('/videos', 'VideoController@store');
    Route::delete('/videos/{video}', 'VideoController@delete');
    Route::get('/videos/{video}/edit', 'VideoController@edit');
    Route::put('/videos/{video}', 'VideoController@update');


    Route::get('/channel/{channel}/edit', 'ChannelSettingsController@edit')->name('profile.edit');
    Route::put('/channel/{channel}/edit', 'ChannelSettingsController@update');


    Route::post('/videos/{video}/votes', 'VideoVoteController@create');
    Route::delete('/videos/{video}/votes', 'VideoVoteController@remove');


    Route::post('/videos/{video}/comments', 'VideoCommentController@create');
    Route::delete('/videos/{video}/comments/{comment}', 'VideoCommentController@delete');


    Route::post('/subscription/{channel}', 'ChannelSubscriptionController@create');
    Route::delete('/subscription/{channel}', 'ChannelSubscriptionController@delete');
});
