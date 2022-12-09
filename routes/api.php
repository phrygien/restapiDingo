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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    
    $api->get('/', function(){
        return 'Hello DingoApi';
    });

    $api->post('/users/signup', 'App\Http\Controllers\UserController@store');
    $api->post('/users/login', 'App\Http\Controllers\Auth\AuthController@login');

    $api->group(['middleware' => 'api', 'prefix' => 'auth'], function($api) {
        $api->post('/token/refresh', 'App\Http\Controllers\Auth\AuthController@refresh');
        $api->post('/logout', 'App\Http\Controllers\Auth\AuthController@logout');
    });

    $api->group(['middleware' => ['role:super-admin'], 'prefix'=>'admin'], function($api) {
        $api->get('users', 'App\Http\Controllers\Admin\AdminUserController@index');
    });
});