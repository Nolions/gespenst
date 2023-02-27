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
        Tag                     $tagServ,
        MaterialRepository      $materialRepo,
        MaterialTagRepository   $materialTagRepo,
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
     * @param array|null $styles
     * @param array|null $tags
     * @param string|null $describe
     * @param string|null $resourceUrl
     * @return array
     */
    public function create(
        string  $title,
        ?array  $styles = [],
        ?array  $tags = [],
        ?string $describe = "",
        ?string $resourceUrl = "",
    ): array
    {
        $styleArr = [];
        $tagArr = [];

        $material = new MaterialModel();
        DB::beginTransaction();
        try {
            $material->title = $title;
            $material->describe = $describe;
            $material->resource_url = $resourceUrl;
            $material->save();

            if ($tags != null) {
                foreach ($tags as $tag) {
                    $materialTag = new MaterialTag();
                    $materialTag->material_id = $material->id;
                    $materialTag->tag_id = $tag;
                    $materialTag->save();

                    $tagArr[] = [
                        'id' => $tag,
                    ];
                }
            }

            if ($styles != null) {
                foreach ($styles as $style) {
                    $materialStyle = new MaterialStyle();
                    $materialStyle->material_id = $material->id;
                    $materialStyle->kolb_style = $style;
                    $materialStyle->save();

                    $styleArr[] = [
                        'name' => $style,
                    ];
                }
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
        $data = collect($this->materialRepo->list())->map(function ($material) {
            $data = $material->toArray();
            $data['tags'] = $material->tags->toArray();
            $data['styles'] = $material->styles->toArray();
            return $data;
        });
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

    /**
     * 編輯教材
     *
     * @param int $id
     * @param array $param
     * @return bool
     */
    public function edit(int $id, array $param): bool
    {
        DB::beginTransaction();
        try {
            $material = $this->materialRepo->get($id);
            $material->title = $param['title'];
            $material->resource_url = $param['resource_url'];
            $material->describe = $param['describe'];
            $material->save();

            $this->materialStyleRepo->removeByMaterialId($id);


            if (array_key_exists('styles', $param)) {
                foreach ($param['styles'] as $style) {
                    var_dump($style);
                    $materialStyle = new MaterialStyle();
                    $materialStyle->material_id = $material->id;
                    $materialStyle->kolb_style = $style;
                    var_dump($materialStyle->save());
                }
            }


            $this->materialTagRepo->removeByMaterialId($id);
            if (array_key_exists('tags', $param)) {
                foreach ($param['tags'] as $tag) {
                    $materialTag = new MaterialTag();
                    $materialTag->material_id = $material->id;
                    $materialTag->tag_id = $tag;
                    $materialTag->save();
                }
            }

            DB::commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            DB::rollback();
            return false;
        }

        return true;
    }

    /**
     * 隨機取得教材
     *
     * @param int|null $tagId
     * @param string|null $style
     * @return array
     */
    public function randomList(?int $tagId = 0, ?string $style = null): array
    {
        $limit = 10;
        $count = $this->materialRepo->randomCount($tagId, $style);
        $offset = rand(0, $count - $limit);

        $data = collect($this->materialRepo->randomList($offset, $limit, $tagId, $style))->map(function ($material) {
            $data = $material->toArray();
            $data['tags'] = $material->tags->toArray();
            $data['styles'] = $material->styles->toArray();
            return $data;
        });

        return $data->toArray();
    }
}
