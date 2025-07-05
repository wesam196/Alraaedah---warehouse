<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard',[CategoryController::class,'index']);
Route::post('/add_category', [CategoryController::class,'create']);
Route::get('/delete_category/{id}' , [CategoryController::class, 'delete']);

Route::post('/add_product', [ProductController::class, 'create']);
Route::get('/delete_product/{id}', [ProductController::class, 'delete']);
Route::get('/edit_product/{id}', [ProductController::class, 'edit']);
Route::post('/update_product/{id}', [ProductController::class, 'update']);


//Route::get('/','\App\Http\controllers\HomeController@index');

