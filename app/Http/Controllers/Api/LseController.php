<?php

namespace App\Http\Controllers\Api;

use App\Services\Lse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

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
     * lse問券
     *
     * @param Lse $lseServ
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
