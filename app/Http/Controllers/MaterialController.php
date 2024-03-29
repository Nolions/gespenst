<?php

namespace App\Http\Controllers;

use App\Services\Lse;
use App\Services\Material;
use App\Services\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

    /**
     * @var Lse
     */
    private Lse $lseServ;

    public function __construct(Material $materialServ, Tag $tagServ, Lse $lseServ)
    {
        $this->materialServ = $materialServ;
        $this->tagServ = $tagServ;
        $this->lseServ = $lseServ;
    }

    /**
     * 教材列表
     *
     * @return View|RedirectResponse
     */
    public function list(): View|RedirectResponse
    {
        if (!isAdminer()) {
            return Redirect::to("/");
        }

        $data = $this->materialServ->list();
        return view('materials', [
            'materials' => $data['data'],
            'paginator' => $data['paginator'],
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
        $material = $this->materialServ->get($id);

        $tags = [];
        foreach ($material['tags'] as $tag) {
            $tags[] = $tag['id'];
        }

        $material['tags'] = $tags;

        $styles = [];
        foreach ($material['styles'] as $style) {
            $styles[] = $style['kolb_style'];
        }

        $material['styles'] = $styles;

        return view('material', [
            'material' => $material,
            'tags' => $this->tagServ->all()
        ]);
    }

    /**
     * 編輯教材
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function edit(Request $request, int $id): RedirectResponse
    {
        $this->materialServ->edit($id, $request->all());

        return Redirect::to("/material/list");
    }

    /**
     * 建立教材(靜態頁面)
     *
     * @return View|RedirectResponse
     */
    public function new(): View|RedirectResponse
    {
        if (!isAdminer()) {
            return Redirect::to("/");
        }

        return view('materialCreate', [
            'tags' => $this->tagServ->all()
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
        $this->materialServ->create(
            $request->input('title'),
            $request->input('styles'),
            $request->input('tags'),
            $request->input('describe'),
            $request->input('resourceUrl'),
        );

        return Redirect::to("/material/list");
    }

    /**
     * 刪除教材
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->materialServ->delete($id);

        return Redirect::to("/material/list");
    }

    public function recommend(Request $request): View|RedirectResponse
    {
        $username = Auth::user()->username;
        $styles = $this->lseServ->getUserStyle($username);
        if (count($styles) == 0) {
            return Redirect::to('/lse');
        }

        $styles = $this->lseServ->getUserStyle(Auth::user()->username);
        $style = str_replace('_score', '', array_search(max($styles), $styles));

        $tag = $request->input('tag', 0);

        $data = $this->materialServ->randomList($tag, $style);

        return view('recommend', [
            'selected' => $tag,
            'tags' => $this->tagServ->all(),
            'materials' => $data['materials'],
            'paginator' => $data['paginator'],
        ]);
    }
}
