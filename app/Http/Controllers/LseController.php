<?php

namespace App\Http\Controllers;

use App\Services\Lse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
     * @return RedirectResponse|View
     */
    public function lse(): RedirectResponse|View
    {
        $username = Auth::user()->username;
        $scores = $this->lseServ->getUserStyle($username);
        if (!empty($scores)) {
            return Redirect::to('/style');
        }

        return view('lse', ['questions' => $this->lseServ->questions()]);
    }

    /**
     * 填寫問卷
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function reply(Request $request): RedirectResponse
    {
        $username = Auth::user()->username;

        // 檢查學習風格評估是否存在
        $scores = $this->lseServ->getUserStyle($username);
        if (empty($scores)) {
            $answers = $request->post();
            unset($answers['_token'], $answers['username']);

            $this->lseServ->reply($username, $answers);
        }

        return Redirect::to('/style');
    }

    /**
     * 取得使用者學習風格數據
     *
     * @return View|Redirector
     */
    public function style(): View|RedirectResponse
    {
        $username = Auth::user()->username;
        $styles = $this->lseServ->getUserStyle($username);
        if (count($styles) == 0) {
            return Redirect::to('/lse');
        }

        return view('kolbStyleResult', [
            'styles' => $this->lseServ->getUserStyle($username)
        ]);
    }

    /**
     * 所有使用者的學習風格
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function users(Request $request): View|RedirectResponse
    {
        if (!isAdminer()) {
            return Redirect::to("/");
        }

        $style = $request->input('style', "");
        $username = $request->input('username', "");

        $data = $this->lseServ->allUsers($style, $username);

        return view('users', [
            'users' => $data['users'],
            'paginate' => $data['paginate'],
            'selected' =>$style,
            'username' => $username,
        ]);
    }
}
