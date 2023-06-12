<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\Services\TokenService;

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

Route::middleware(['auth', 'is.admin'])->group(function () {
   Route::get('/auth/google',  [TokenService::class, 'redirectToGoogle']);
   Route::get('/auth/google/callback', [TokenService::class, 'handleGoogleCallback']);

   Route::get('/', [FormsController::class, 'index']);
   Route::get('/forms', [FormsController::class, 'getForms']);
   Route::get('/form/{id?}', [FormsController::class, 'getForm']);
});

Route::middleware('auth')->group(function () {
   Route::get('/', [FormsController::class, 'index']);
});

require __DIR__.'/auth.php';
