<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|addAddress
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::middleware('auth:api')->get('/hello', function (Request $request) {
//    return 'hello';
//});
Route::post('login', 'APIJangoController@login');
Route::post('register', 'APIJangoController@register');
Route::middleware('auth:api')->get('/details','APIJangoController@details');

Route::middleware('auth:api')->post('/addAddress','APIJangoController@addAddress');
Route::middleware('auth:api')->put('/updateAddress/{id}','APIJangoController@updateAddress');