<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ControlUsers;


//Route::get('/','\App\Http\controllers\HomeController@index');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/users', [ControlUsers::class, 'index'])->name('users.index');
     

Route::post('/update_user/{id}', [ControlUsers::class, 'update'])->name('users.update');
Route::get('/delete_user/{id}', [ControlUsers::class, 'delete'])->name('users.delete');
Route::get('/reset_password/{id}', [ControlUsers::class, 'resetPassword'])->name('users.reset_password');



Route::get('/',[ProductController::class,'index']);


Route::get('/dashboard',[CategoryController::class,'index']);
Route::post('/add_category', [CategoryController::class,'create']);
Route::get('/delete_category/{id}' , [CategoryController::class, 'delete']);
Route::get('/edit_category/{id}' , [CategoryController::class, 'edit']);
Route::post('/update_category/{id}' , [CategoryController::class, 'update']);


Route::post('/add_product', [ProductController::class, 'create']);
Route::get('/delete_product/{id}', [ProductController::class, 'delete']);
Route::get('/edit_product/{id}', [ProductController::class, 'edit']);
Route::post('/update_product/{id}', [ProductController::class, 'update']);


Route::get('/edit_pledge/{id}', [ProductController::class, 'editPledge']);

Route::get('/return_pledge/{id}', [ProductController::class, 'returnPledge']);

Route::get('/dashboard',[CategoryController::class,'index']);

//Route::get('/dashboard', function () {
  //      return view('dashboard');
    //})->name('dashboard');


    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    
});

