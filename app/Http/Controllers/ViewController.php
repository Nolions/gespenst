<?php

namespace App\Http\Controllers;

use App\Services\Lse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
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
        return view("lse", ['questions' => $this->lseServ->questions()]);
    }

    public function reply(Request $request)
    {

    }
}
