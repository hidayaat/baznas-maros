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
//Cara 1 Invokable
// Route::get(
//     '/localization/{language}',
//     App\Http\Controllers\LocalizationController::class
// )->name('localization.switch');

//Cara 2 method biasa
Route::get(
    '/localization/{language}',
    [App\Http\Controllers\LocalizationController::class, 'switch']
)->name('localization.switch');

// route blog
Route::get('/',[\App\Http\Controllers\BlogController::class, 'home'])->name('blog.home');

Route::get('/categories/{slug}',[\App\Http\Controllers\BlogController::class, 'showPostByCategory'])->name('blog.posts.category');

Route::get('/post/{slug}',[\App\Http\Controllers\BlogController::class, 'showPostDetail'])->name('blog.post.detail');

Route::get('/bayar-zakat',[\App\Http\Controllers\BlogController::class, 'create'])->name('blog.create');

Route::post('/bayar-zakat',[\App\Http\Controllers\BlogController::class, 'store'])->name('blog.store');

Auth::routes([
    'register' => false,
]);


// route dashboard
Route::group(['prefix' => 'dashboard', 'middleware' => ['web', 'auth']], function () {
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
        Route::get(
            '/index',
            [\App\Http\Controllers\FileManagerController::class, 'index']
        )
            ->name('filemanager.index');
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    //roles  
    Route::get('/roles/select', [\App\Http\Controllers\RoleController::class, 'select'])->name('roles.select');
    Route::resource('/roles', \App\Http\Controllers\RoleController::class);

    //user
    Route::resource('/users', \App\Http\Controllers\UserController::class)->except(['show']);

    //donatur
    Route::resource('/donors', \App\Http\Controllers\DonorController::class)->except(['create', 'store']);
});
