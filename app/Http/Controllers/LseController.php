<?php

namespace App\Http\Controllers;

use App\Services\lse;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class LseController extends BaseController
{
    /**
     * lse問券
     *
     * @param lse $lseServ
     * @return JsonResponse
     */
    public function lse(Lse $lseServ): JsonResponse
    {
        return response()->json(
            $lseServ->questions()
        );
    }

    public function reply(): JsonResponse
    {
        return response()->json();
    }
}
