<?php

use App\Postcard;
use App\PostcardSendingService;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
});

// send emails
Route::get('/email' , 'EmailController@create');
Route::post('/email/send' , 'EmailController@send');
// Service container
Route::get('pay' , 'PayOrderController@store');
// View Composer
Route::get('channels' ,'ChannelController@index');
Route::get('post/create' , 'PostController@create');

//Select2 search
Route::get('search', 'MovieController@index');
Route::get('ajax-autocomplete-search', 'MovieController@selectSearch');

//facades
Route::get('postcards', function () {

    $postcardService = new PostcardSendingService('Morocco', 4,  6);

    $postcardService->hello('Hello from Bahaeddine; We are learning facades', 'sihassi.bahaedddine@gmail.com');
});

Route::get('/facades' , function() {

    Postcard::hello('facades', 'facades@aravel.coml');

});

//Macros
Route::get('/macros' , function(){
    // dd(Str::partNumber('123456789'));
    dd(Str::prefix('123456789'));

    return Response::errorJson();
});
