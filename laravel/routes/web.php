<?php

use App\Http\Controllers\HomeController as GuestHomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('admin/home', [DashboardController::class, 'home'])->name('admin.home');
});

require __DIR__.'/auth.php';

Auth::routes();


Route::prefix('admin')->name('admin.')->middleware(['first', 'second'])->group(function(){
    Route::get('/',[AdminDashboardController::class,'home'])->name('home');
    Route::get('/posts/deleted', [PostController::class, 'deletedIndex'])->name('posts.deleted');
    Route::post('/posts/deleted/{{post}}', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/deleted/{{post}}', [PostController::class, 'obliterate'])->name('posts.obliterate');
    Route::resource('/posts', PostController::class);

    

});

Route::name('guest.')->group(function(){
    Route::get('/',[GuestHomeController::class,'home'])->name('home');

});
