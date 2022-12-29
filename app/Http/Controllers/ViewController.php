<?php

namespace App\Http\Controllers;

use App\Services\Lse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ViewController extends BaseController
{
    /**
     * @var Lse
     */
    private Lse $lseServ;

    public function __construct(Lse $lseServ)
    {
        $this->lseServ = $lseServ;
    }

    public function lse(): View
    {
        return view('lse', ['questions' => $this->lseServ->questions()]);
    }

    public function reply(Request $request): View
    {
        // TODO
        $userId = "m9890104";

        // 檢查學習風格評估是否存在
        $scores = $this->lseServ->getUserStyle($userId);
        if (empty($scores)) {
            $answers = $request->post();
            unset($answers['_token']);

            $scores = $this->lseServ->reply($userId, $answers);
        }

        return view('kolbStyleResult', ['kolbStyleScores' => $scores]);
    }

    public function style(Request $request): View
    {
        $userId = "m9890104";

        return view('kolbStyleResult', [
            'kolbStyleScores' => $this->lseServ->getUserStyle($userId)
        ]);
    }
}
