<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PawnController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\DB;

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
    // Route::post('register', [AuthController::class, 'register'])->name('register');
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1','middleware'=> 'jwt.auth'], function ($route) {
    Route::group(['prefix'=>'user','middleware'=> 'api'], function ($route) {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('register', [UserController::class, 'store'])->name('store');

        Route::get('/pawn/item', [PawnController::class,'index'])->name('pawn.allitems');
        Route::post('/pawn/item/create', [PawnController::class,'store'])->name('pawn.create');
        Route::get('/pawn/item/{id}', [PawnController::class, 'show'])->name('pawn.itemshow');
        Route::post('/pawn/item/update/{id}', [PawnController::class, 'update'])->name('pawn.itemupdate');
        Route::get('/pawn/item/delete/{id}', [PawnController::class, 'destory'])->name('pawn.itemdestory');

        Route::get('/sale/item', [SaleController::class, 'index']); // show all sale item
        Route::post('/sale/item/create', [SaleController::class, 'store']); // create sale record
        Route::get('/sale/item/{id}', [SaleController::class, 'show']); // get single sale item
        Route::post('/sale/item/update/{id}', [SaleController::class, 'update']); // update sale item
    });
});
