<?php

namespace App\Http\Controllers;

use App\Services\Lse;
use App\Services\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ViewController extends BaseController
{
    /**
     * @var Lse
     */
    private Lse $lseServ;

    private User $userServ;

    public function __construct(Lse $lseServ, User $userServ)
    {
        $this->lseServ = $lseServ;
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

    /**
     * 取得LSE問卷
     *
     * @return View
     */
    public function lse(): View
    {
        return view('lse', ['questions' => $this->lseServ->questions()]);
    }

    /**
     * 填寫問卷
     *
     * @param Request $request
     * @return View
     */
    public function reply(Request $request): View
    {
        $username = Auth::user()->username;

        // 檢查學習風格評估是否存在
        $scores = $this->lseServ->getUserStyle($username);
        if (empty($scores)) {
            $answers = $request->post();
            unset($answers['_token'], $answers['username']);

            $scores = $this->lseServ->reply($username, $answers);
        }

        return view('kolbStyleResult', ['kolbStyleScores' => $scores]);
    }

    /**
     * 取得使用者學習風格數據
     *
     * @param Request $request
     * @return View
     */
    public function style(Request $request): View
    {
        $username = Auth::user()->username;

        return view('kolbStyleResult', [
            'kolbStyleScores' => $this->lseServ->getUserStyle($username)
        ]);
    }
}
