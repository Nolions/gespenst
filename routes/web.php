<?php

use App\Http\Controllers\ViewController;
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
    ViewController::class, 'login'
]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('index');

    Route::get('/logout', [
        ViewController::class, 'logout'
    ])->middleware('auth')->name('logout');

    Route::get('/lse', [
        ViewController::class, 'lse'
    ])->middleware('auth');

    Route::post('/reply', [
        ViewController::class, 'reply'
    ])->middleware('auth');

    Route::get('/style', [
        ViewController::class, 'style'
    ])->middleware('auth');
});
