<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Unisharp\LaravelFilemanager\Lfm;
use App\Http\Controllers\Front\PostController as FrontPostController;

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
Route::name('home')->get('/', [FrontPostController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function () {
    Lfm::routes();
});

Route::prefix('posts')->group(function () {
    Route::name('posts.display')->get('{slug}', [FrontPostController::class, 'show']);
});

require __DIR__.'/auth.php';
