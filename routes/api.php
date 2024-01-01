<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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
Route::group([
    'middleware'=>'api',
    'prefix'=>'auth'
],function($route){
    Route:: post('login',[AuthController::class,'login'])->name('login');
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1','middleware'=> 'jwt.auth'], function ($route) {
    Route::group(['prefix'=>'user','middleware'=> 'api'], function ($route) {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('register', [UserController::class, 'store'])->name('store');
    });
});
