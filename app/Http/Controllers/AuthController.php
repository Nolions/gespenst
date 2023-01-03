<?php

namespace App\Http\Controllers;

use App\Services\Lse;
use App\Services\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    /**
     * @var User
     */
    private User $userServ;

    public function __construct(User $userServ)
    {
        $this->userServ = $userServ;
    }

    /**
     * 登入
     * -----------------
     * 使用帳號進行登入，如果登入失敗則表示帳號不存在，則建立一個帳號，再重新進行登入
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $user = $this->userServ->findByUsername($request->input('username'));
        if (is_null($user)) {
            // 註冊
            $user = $this->userServ->register($request->post('username'));
        }

        // 登入
        Auth::login($user);
        return Redirect::to('/');
    }

    /**
     * 登出
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        return Redirect::to('login');
    }
}
