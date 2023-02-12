<?php

namespace App\Services;

use App\Models\Material as MaterialModel;
use App\Models\MaterialStyle;
use App\Models\MaterialTag;
use App\Repositories\MaterialRepository;
use App\Repositories\MaterialStyleRepository;
use App\Repositories\MaterialTagRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class Material
{
    /**
     * @var Tag
     */
    private Tag $tagServ;

    /**
     * @var MaterialRepository
     */
    private MaterialRepository $materialRepo;

    /**
     * @var MaterialTagRepository
     */
    private MaterialTagRepository $materialTagRepo;

    private MaterialStyleRepository $materialStyleRepo;

    public function __construct(
        Tag $tagServ,
        MaterialRepository $materialRepo,
        MaterialTagRepository $materialTagRepo,
        MaterialStyleRepository $materialStyleRepo
    )
    {
        $this->tagServ = $tagServ;
        $this->materialRepo = $materialRepo;
        $this->materialTagRepo = $materialTagRepo;
        $this->materialStyleRepo = $materialStyleRepo;
    }

    /**
     * 建立教材
     *
     * @param string $title
     * @param array $styles
     * @param array $tags
     * @param string|null $describe
     * @param string|null $resourceUrl
     * @return array
     */
    public function create(
        string  $title,
        array   $styles = [],
        array   $tags = [],
        ?string $describe = null,
        ?string $resourceUrl = null,
    ): array
    {
        $styleArr = [];
        $tagArr = [];

        DB::beginTransaction();
        try {
            $material = new MaterialModel();
            $material->title = $title;
            $material->describe = $describe;
            $material->resource_url = $resourceUrl;
            $material->save();

            foreach ($tags as $tag) {
                $tagModel = $this->tagServ->Create($tag);
                $materialTag = new MaterialTag();
                $materialTag->material_id = $material->id;
                $materialTag->tag_id = $tagModel->id;
                $materialTag->save();

                $tagArr[] = [
                    'id' => $tagModel->id,
                    'name' => $tagModel->name,
                ];
            }

            foreach ($styles as $style) {
                $materialStyle = new MaterialStyle();
                $materialStyle->material_id = $material->id;
                $materialStyle->kolb_style = $style;
                $materialStyle->save();

                $styleArr[] = [
                    'name' => $style,
                ];
            }

            DB::commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            DB::rollback();
        }

        $data = $material->toArray();
        $data['styles'] = $styleArr;
        $data['tags'] = $tagArr;

        return $data;
    }

    /**
     * 教材列表
     *
     * @return array
     */
    public function list(): array
    {
        $data = $this->materialRepo->list();
        return $data->toArray();
    }

    /**
     * 取得教材詳細資料
     *
     * @param int $id
     * @return array
     */
    public function get(int $id): array
    {
        $material = $this->materialRepo->get($id);
        if ($material == null) {
            return [];
        }

        $data = $material->toArray();
        $data['tags'] = $this->materialTagRepo->getMaterialTags($id)->toArray();
        $data['styles'] = $this->materialStyleRepo->getMaterialStyles($id)->toArray();

        return $data;
    }

    public function allMaterialTags(): array
    {
        return $this->tagServ->all();
    }
}
