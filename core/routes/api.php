<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

	route::get('/pinjamkelas','Api\PinjamCtrl@index');
	route::get('/statuspeminjaman','Api\PinjamCtrl@statusPeminjaman');
	route::post('/createpeminjaman','Api\PinjamCtrl@createPeminjaman');
	route::get('/pinjamkelas/{id}/booking','PinjamController@pinjamViewAdd');
	route::post('/pinjamkelas/{id}/bookingadd','PinjamController@pinjamAdd');