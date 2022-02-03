<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{TodoController,UserController};
use App\Models\User;

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
Route::group(["prefix"=>"v1"],function (){
    Route::get("/todo",[TodoController::class,'all']);
    Route::post("/todo",[TodoController::class,'add_todo']);
    Route::put("/todo/{id}",[TodoController::class,'compelete_todo']);
    Route::get("/todo/{id}",[TodoController::class,'get_todo']);
    Route::delete("/todo/{id}",[TodoController::class,'delete_todo']);
    Route::post("/token/create",[UserController::class,'Login']);
    // Route::post('/tokens/create', function (Request $request) {
    //     $user=new User();
    //     $token = $user->createToken($request->query('token_name'));
    
    //     return ['token' => $token->plainTextToken];
    // });
    Route::post("user/create",[UserController::class,"register"]);
    Route::post("user/logout",[UserController::class,"signout"])->middleware('auth:sanctum');
    Route::post("user/check",[UserController::class,"check_authenticated"])->middleware('auth:sanctum');

});
