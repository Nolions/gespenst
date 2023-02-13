<?php

namespace App\Http\Controllers;

use App\Services\Material;
use Illuminate\Contracts\View\View;
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
     * @return View
     */
    public function list(Request $request): View
    {
//        $data = $this->materialServ->list();

//        return view('materials', 'materials' => $data)
        return view('materials', [
            'materials' => $this->materialServ->list()
        ]);
    }

    /**
     * 取得教材詳細資訊
     *
     * @param int $id
     * @return View
     */
    public function get(int $id): View
    {
        return view('material', [
            'material' => $this->materialServ->get($id)
        ]);
    }
}
