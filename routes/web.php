<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TourGroupController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\FeedController;

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
/*-----common_routes------*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/blogs',[BlogController::class, 'index']);
Route::get('/feed',[FeedController::class, 'index']);
Route::get('blog/details/{id}',[BlogController::class, 'details']);
Route::get('tour/plans',[TourController::class, 'index']);
Route::get('upcomming/tour/plans',[TourController::class, 'upcomming']);
Route::get('feed/details/{id}',[FeedController::class, 'details']);
/*-----common_routes ends------*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*----------Admin_routes_start----------*/
Route::prefix('admin')->group(function(){

    Route::get('/login',[AdminController::class, 'index']);
    Route::get('/register',[AdminController::class, 'register']);
    Route::post('/register/create',[AdminController::class, 'registerCreate']);
    Route::post('/login/owner',[AdminController::class, 'login']);
    Route::get('/dashboard',[AdminController::class, 'dashboard'])->middleware('admin');
    Route::get('/logout',[AdminController::class, 'logout'])->middleware('admin');


});

/*----------Admin_routes_end----------*/

/*----------TourGroup_routes_start----------*/
Route::prefix('group')->group(function(){
    Route::get('/login',[TourGroupController::class, 'index']);
    Route::get('/register',[TourGroupController::class, 'register']);
    Route::post('/register/create',[TourGroupController::class, 'registerCreate']);
    Route::post('/login/owner',[TourGroupController::class, 'login']);
    Route::get('/dashboard',[TourGroupController::class, 'dashboard'])->middleware('group');
    Route::get('/logout',[TourGroupController::class, 'logout'])->middleware('group');
    Route::get('/blog/add',[BlogController::class, 'add'])->middleware('group');
    Route::post('/blog/create',[BlogController::class, 'create'])->middleware('group');
    Route::get('/feed/add',[FeedController::class, 'add'])->middleware('group');
    Route::post('/feed/create',[FeedController::class, 'create'])->middleware('group');
});

/*----------TourGroup_routes_end----------*/

require __DIR__.'/auth.php';