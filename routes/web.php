<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;



Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard',[CategoryController::class,'index']);
Route::post('/add_category', [CategoryController::class,'create']);
Route::get('/delete_category/{id}' , [CategoryController::class, 'delete']);



//Route::get('/','\App\Http\controllers\HomeController@index');

