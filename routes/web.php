<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogController;
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

// 登入頁面
Route::get('/login', function () {
    return view('login');
})->name('login');

// 登入
Route::post('/login', [
    AuthController::class, 'login'
]);

Route::group(['middleware' => ['auth']], function () {
    // 首頁頁面
    Route::get('/', function () {
        return view('index');
    })->name('index');

    // 登出
    Route::get('/logout', [
        AuthController::class, 'logout'
    ])->name('logout');

    // Kolb學習風格問券 頁面
    Route::get('/lse', [
        LseController::class, 'lse'
    ]);

    // 填寫學習風格問券
    Route::post('/reply', [
        LseController::class, 'reply'
    ]);

    // 使用者學習風格頁面
    Route::get('/style', [
        LseController::class, 'style'
    ]);

    Route::get('/record/user', [
        LogController::class, 'userLoginRecord'
    ]);

    // 所有使用的學習風格
    Route::get('users', [
       LseController::class, 'users'
    ]);

    Route::group(['prefix' => '/material',], function () {
        // 教材列表頁面
        Route::get('/list', [
            MaterialController::class, 'list'
        ]);

        // 推薦教材頁面
        Route::get('/recommend', [
            MaterialController::class, 'recommend'
        ]);

        // 建立教材頁面
        Route::get('/', [
            MaterialController::class, 'new'
        ]);

        // 建立教材
        Route::post('/', [
            MaterialController::class, 'create'
        ]);

        // 取得教材頁面
        Route::get('/{id}', [
            MaterialController::class, 'get'
        ]);

        // 編輯教材
        Route::post('/{id}', [
            MaterialController::class, 'edit'
        ]);


    });
});


