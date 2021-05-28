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
Route::get('/getall', 'ApiController@getall');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('/updateuser/{id}', 'ApiController@updateuser');

Route::get('/getusers', 'ApiController@getusers');

Route::get('/getprofiles', 'ApiController@getprofiles');

Route::get('/getitems', 'ApiController@getitems');

Route::get('/getcategories', 'ApiController@getcategories');

Route::get('/getproducts', 'ApiController@getproducts');

Route::get('/getsubproducts', 'ApiController@getsubproducts');

Route::get('/getcountry', 'ApiController@getcountry');

Route::get('/getstate', 'ApiController@getstate');

Route::get('/getareyou', 'ApiController@getareyou');

Route::get('/getcurrency', 'ApiController@getcurrency');

Route::get('/getunit', 'ApiController@getunit');

Route::get('/getregisterdetails', 'ApiController@getregisterdetails');

/* POST API's */

Route::post('/login', 'ApiController@login');

Route::post('/registeruser', 'ApiController@registeruser');

Route::post('/checkphone', 'ApiController@checkphone');

Route::post('/checkemail', 'ApiController@checkemail');

Route::post('/forgotpassword', 'ApiController@forgotpassword');

Route::post('/addsubuser', 'ApiController@addsubuser');

/*new APi */
Route::post('/addEnquiryOffer', 'ApiController@addEnquiryOffer');