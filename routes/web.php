<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::group(['middleware' => 'guest'], function(){
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [HomeController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [HomeController::class, 'destroy'])->name('destroy');
    Route::get('/addproducts', [HomeController::class, 'addproducts'])->name('addproducts');
    Route::post('/addproducts', [HomeController::class, 'addproductsPost'])->name('addproducts');
    Route::delete('/logout', [HomeController::class, 'logout'])->name('logout'); 
});