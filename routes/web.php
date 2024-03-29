<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return  redirect()->route('index');
});
Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('/admin')->group(function(){
        Route::get('/form',[FormController::class,'index'])->name('index');
        Route::get('/form/{form}',[FormController::class,'show'])->name('show');
        Route::get('/create',[FormController::class,'create'])->name('create');
        Route::post('/form',[FormController::class,'store'])->name('store');
        Route::delete('/delete/{form}',[FormController::class,'destroy'])->name('destroy');
        Route::post('/save-form-data',[FormController::class,'saveData'])->name('save.form.data');

        Route::get('/image',[ImageController::class,'index'])->name('indeximage');
        Route::get('/image/create',[ImageController::class,'create'])->name('createimage');
        Route::post('/images',[ImageController::class,'store'])->name('storeimage');
        Route::delete('/image/delete/{image}',[ImageController::class,'destroy'])->name('destroyimage');

        Route::get('form/export/{form}', [FormController::class, 'export'])->name('export');
    })->middleware('checkRole:admin');
});

Route::get('/signin',[UserController::class,'signin'])->name('signin');
Route::post('/login',[UserController::class,'login'])->name('login');

Route::get('/signup',[UserController::class,'create'])->name('signup');
Route::post('/logup',[UserController::class,'store'])->name('logup');

Route::get('/form/{form}',[FormController::class,'showform'])->name('showform');
Route::post('/form',[FormController::class,'questionnaire'])->name('questionnaire');
Route::get('/form/{form}/success',[FormController::class,'successform'])->name('successform');



