<?php

namespace App\Http\Controllers;

use App\Services\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
     * @return View
     */
    public function userLoginRecord():View
    {
        $username = Auth::user()->username;

        return view('loginRecord', [
            'records' => $this->logServ->userLoginRecord($username)
        ]);
    }

    /**
     * 所有使用者的登入紀錄
     *
     * @return RedirectResponse|void
     */
    public function usersLoginRecord()
    {
        if (!isAdminer()) {
            return Redirect::to("/");
        }
    }
}
