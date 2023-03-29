<?php

namespace App\Http\Controllers;

use App\Services\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LogController extends BaseController
{
    private Log $logServ;

    public function __construct(Log $logServ)
    {
        $this->logServ = $logServ;
    }

    /**
     * 取得使用者登入紀錄
     *
     * @param string|null $username
     * @return View
     */
    public function userLoginRecord(?string $username = null): View
    {
        $allowBack = true;
        if ($username==null) {
            $username = Auth::user()->username;
            $allowBack = false;
        }

        return view('loginRecord', [
            'records' => $this->logServ->userLoginRecord($username),
            'username' => $username,
            'allowBack' =>$allowBack,
        ]);
    }

    /**
     * 所有使用者的登入紀錄
     *
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function usersLoginRecord(Request $request): View|RedirectResponse
    {
        if (!isAdminer()) {
            return Redirect::to("/");
        }

        $style = $request->input('style', "");
        $username = $request->input('username', "");

        return view('usersLoginRecord', [
            'records' => $this->logServ->usersLoginRecord($style, $username),
            'selected' => $style,
            'username' => $username,
        ]);
    }
}
