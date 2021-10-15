<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
]);


Route::group(['prefix' => 'dashboard', 'middleware'=> ['web', 'auth']], function(){
    //Dashboard
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

    //Categories
    Route::get('/categories/select', [\App\Http\Controllers\CategoryController::class, 'select'])->name('categories.select');
    Route::resource('/categories', \App\Http\Controllers\CategoryController::class);
    
    //Tags
    Route::get('/tags/select', [\App\Http\Controllers\TagController::class, 'select'])->name('tags.select');
    Route::resource('/tags', \App\Http\Controllers\TagController::class)->except(['show']);

    //Posts
    Route::resource('/posts', \App\Http\Controllers\PostController::class);

    //file manager
    Route::group(['prefix' => 'filemanager'], function () {
        Route::get('/index',
        [\App\Http\Controllers\FileManagerController::class, 'index'])
        ->name('filemanager.index');
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
   
});