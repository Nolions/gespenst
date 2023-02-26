<?php

namespace App\Repositories;

use App\Models\MaterialTag;
use Illuminate\Database\Eloquent\Collection;

class MaterialTagRepository
{
    /**
     * @var MaterialTag
     */
    private MaterialTag $model;

    public function __construct(MaterialTag $model)
    {
        $this->model = $model;
    }

    /**
     * 取得教材關聯標籤
     *
     * @param int $id
     * @return Collection
     */
    public function getMaterialTags(int $id): Collection
    {
        return $this->model->newQuery()
            ->select('tags.id', 'tags.name')
            ->where('material_id', $id)
            ->join('tags', 'tags.id', '=', 'material_tags.tag_id')
            ->get();
    }

    /**
     * 移除教材相關標籤
     *
     * @param int $id
     * @return bool
     */
    public function removeByMaterialId(int $id): bool
    {
        return $this->model->newQuery()
            ->where('material_id', $id)
            ->delete();
    }
}
