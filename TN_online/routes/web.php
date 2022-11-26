<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [UserController::class, 'authLogin'])->name('login');
Route::post('/post-login', [UserController::class, 'login'])->name('login.post')->middleware(['auth']); 
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/post-registration', [UserController::class, 'customRegistation'])->name('register.post')->middleware(['auth']); 
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
// Route::get('dashboard', [UserController::class, 'dashboard']); 
