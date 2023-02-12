<?php

namespace App\Http\Controllers;

use App\Services\Material;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * @var Material
     */
    private Material $materialServ;

    public function __construct(Material $materialServ)
    {
        $this->materialServ = $materialServ;
    }

    /**
     * 建立教材
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $data = $this->materialServ->create(
            $request->input('title'),
            $request->input('styles'),
            $request->input('tag'),
            $request->input('describe'),
            $request->input('resourceUrl'),
        );

        return response()->json($data);
    }

    /**
     * 教材列表
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request)
    {
        $data = $this->materialServ->list();

        return response()->json($data);
    }

    /**
     * 取得教材詳細資訊
     *
     * @param int $id
     * @return JsonResponse
     */
    public function get(int $id)
    {
        $data = $this->materialServ->get($id);

        return response()->json($data);
    }
}
