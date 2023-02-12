<?php

namespace App\Services;

use App\Models\Material as MaterialModel;
use App\Models\MaterialStyle;
use App\Models\MaterialTag;
use App\Repositories\MaterialRepository;
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

    public function __construct(Tag $tagServ, MaterialRepository $materialRepo)
    {
        $this->tagServ = $tagServ;
        $this->materialRepo = $materialRepo;
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
}
