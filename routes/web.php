<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheffController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});




Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('home');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin_home', [AdminController::class, 'admin_home'])->name('admin_home');

    Route::get('/users', [UserController::class, 'users'])->name('users');
    Route::delete('/delete_user/{id}', [UserController::class, 'delete_user'])->name('delete_user');

    Route::get('/food_admin_menu', [FoodController::class, 'food_admin_menu'])->name('food_admin_menu');
    Route::post('/upload_food', [FoodController::class, 'upload_food'])->name('upload_food');
    Route::get('/edit_food/{id}', [FoodController::class, 'edit_food'])->name('edit_food');
    Route::put('/update_food/{id}', [FoodController::class, 'update_food'])->name('update_food');
    Route::get('/delete_food/{id}', [FoodController::class, 'delete_food'])->name('delete_food');

    Route::get('/view_reservations', [ReservationController::class, 'view_reservations'])->name('view_reservations');
    Route::get('/delete_reservation/{id}', [ReservationController::class, 'delete_reservation'])->name('delete_reservation');


    Route::get('/chefs', [CheffController::class, 'chefs'])->name('chefs');
    Route::post('/upload_chef', [CheffController::class, 'upload_chef'])->name('upload_chef');
    Route::get('/edit_chef/{id}', [CheffController::class, 'edit_chef'])->name('edit_chef');
    Route::put('/update_chef/{id}', [CheffController::class, 'update_chef'])->name('update_chef');
    Route::get('/delete_chef/{id}', [CheffController::class, 'delete_chef'])->name('delete_chef');

    Route::get('/delete_cart/{id}', [CartController::class, 'delete_cart'])->name('delete_cart');

    Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
    Route::get('/delete_order/{id}', [OrderController::class, 'delete_order'])->name('delete_order');

    Route::get('/search', [OrderController::class, 'search'])->name('search');
});



Route::middleware(['auth'])->group(function () {
    Route::post('/reservation', [ReservationController::class, 'reservation'])->name('reservation');
    Route::post('/add_cart/{id}', [CartController::class, 'add_cart'])->name('add_cart');
    Route::get('/show_cart/{id}', [CartController::class, 'show_cart'])->name('show_cart');
    Route::post('/order_add', [OrderController::class, 'order_add'])->name('order_add');
});

