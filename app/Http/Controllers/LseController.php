<?php

namespace App\Http\Controllers;

use App\Services\lse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class LseController extends BaseController
{
    /**
     * @var lse
     */
    private Lse $lseServ;

    public function __construct(Lse $lseServ)
    {
        $this->lseServ = $lseServ;
    }

    /**
     * lse問券
     *
     * @param lse $lseServ
     * @return JsonResponse
     */
    public function lse(Lse $lseServ): JsonResponse
    {
        return response()->json(
            $this->lseServ->questions()
        );
    }

    /**
     * 填寫問券
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reply(Request $request): JsonResponse
    {
        return response()->json(
            $this->lseServ->reply(
                $request->input('id'),
                $request->input('answers'),
            )
        );
    }
}
