<?php

namespace App\Http\Controllers;

use App\Services\Lse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class LseController extends BaseController
{
    /**
     * @var Lse
     */
    private Lse $lseServ;


    public function __construct(Lse $lseServ)
    {
        $this->lseServ = $lseServ;
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
            'styles' => $this->lseServ->getUserStyle($username)
        ]);
    }
}
