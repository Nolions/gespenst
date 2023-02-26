<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LseController;
use App\Http\Controllers\MaterialController;
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

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [
    AuthController::class, 'login'
]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::get('/logout', [
        AuthController::class, 'logout'
    ])->middleware('auth')->name('logout');

    Route::get('/lse', [
        LseController::class, 'lse'
    ])->middleware('auth');

    Route::post('/reply', [
        LseController::class, 'reply'
    ])->middleware('auth');

    Route::get('/style', [
        LseController::class, 'style'
    ])->middleware('auth');

    Route::group(['prefix' => '/material',], function () {
        Route::get('/list', [
            MaterialController::class, 'list'
        ]);

        Route::get('/', [
            MaterialController::class, 'new'
        ]);

        Route::post('/', [
            MaterialController::class, 'create'
        ]);

        Route::get('/{id}', [
            MaterialController::class, 'get'
        ]);
    });
});


