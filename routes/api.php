<?php

use App\Http\Controllers\TutorialController;
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
        $api->post('/me', 'App\Http\Controllers\Auth\AuthController@me');
    });

    $api->group(['middleware' => ['role:super-admin'], 'prefix'=>'admin'], function($api) {
        $api->get('users', 'App\Http\Controllers\Admin\AdminUserController@index');
    });

    $api->group(['middleware' => ['role:super-admin'], 'prefix'=>'gestion'], function($api) {
        $api->get('employees', 'App\Http\Controllers\Gestion\EmployeeController@index');
        $api->post('employees/create', 'App\Http\Controllers\Gestion\EmployeeController@store');
        $api->get('employees/show/{id}', 'App\Http\Controllers\Gestion\EmployeeController@show');
        $api->put('employees/update/{id}', 'App\Http\Controllers\Gestion\EmployeeController@update');
        $api->delete('employees/delete/{id}', 'App\Http\Controllers\Gestion\EmployeeController@destroy');
        $api->get('activities', 'App\Http\Controllers\Gestion\EmployeeController@activityLog');
        // product module
        $api->resource('products', App\Http\Controllers\Gestion\ProductController::class);
        $api->get('products/view/all', [ProductController::class, 'indexAll']);
        $api->get('products/view/search', [ProductController::class, 'search']);
    });

    $api->get('tutorials', [TutorialController::class, 'index']);
    $api->get('tutorials/chercher', [TutorialController::class, 'chercher']);
    $api->post('tutorials/create', [TutorialController::class, 'store']);
    $api->get('tutorials/show/{id}', [TutorialController::class, 'show']);
    $api->put('tutorials/update/{id}', [TutorialController::class, 'update']);
    $api->delete('tutorials/delete/{id}', [TutorialController::class, 'destroy']);
    $api->delete('tutorials/deleteAll', [TutorialController::class, 'deleteAll']);
});
