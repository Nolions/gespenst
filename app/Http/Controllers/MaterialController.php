<?php

namespace App\Http\Controllers;

use App\Services\Material;
use App\Services\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use function GuzzleHttp\Promise\all;

class MaterialController extends Controller
{
    /**
     * @var Material
     */
    private Material $materialServ;

    /**
     * @var Tag
     */
    private Tag $tagServ;

    public function __construct(Material $materialServ, Tag $tagServ)
    {
        $this->materialServ = $materialServ;
        $this->tagServ = $tagServ;
    }

    /**
     * 教材列表
     *
     * @param Request $request
     * @return View
     */
    public function list(Request $request): View
    {
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

    /**
     * 建立教材(靜態頁面)
     *
     * @return View
     */
    public function new(): View
    {
        return view('materialCreate', [
            'tags' =>  $this->tagServ->all()
        ]);
    }

    /**
     * 建立教材
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        $data = $this->materialServ->create(
            $request->input('title'),
            $request->input('styles'),
            $request->input('tags'),
            $request->input('describe'),
            $request->input('resourceUrl'),
        );

        return Redirect::to("/material/{$data['id']}");
    }
}
