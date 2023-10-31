<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Text;
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

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

});

Route::middleware('auth')->group(function () {

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/', [Text::class, 'index'])
        ->name('index');

    Route::get('new-text', [Text::class, 'create'])
        ->name('new-text');

    Route::get('my-text', [Text::class, 'index'])
        ->name('my-text');

    Route::post('create', [Text::class, 'store'])
        ->name('create-text');

    Route::get('view', [Text::class, 'view'])
        ->name('view-text');

});

