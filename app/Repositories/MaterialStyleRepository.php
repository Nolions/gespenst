<?php

namespace App\Repositories;

use App\Models\MaterialStyle;
use Illuminate\Database\Eloquent\Collection;

class MaterialStyleRepository
{
    /**
     * @var MaterialStyle
     */
    private MaterialStyle $model;

    public function __construct(MaterialStyle $model)
    {
        $this->model = $model;
    }

    /**
     * 取得教材關聯學習風格
     *
     * @param int $id
     * @return Collection
     */
    public function getMaterialStyles(int $id): Collection
    {
        return $this->model->newQuery()
            ->select('kolb_style')
            ->where('material_id', $id)
            ->get();
    }

    /**
     * 移除教材相關風格
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
