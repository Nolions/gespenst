<?php

namespace App\Repositories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MaterialRepository
{
    /**
     * @var Material
     */
    private Material $model;

    public function __construct(Material $model)
    {
        $this->model = $model;
    }

    /**
     * 教材列表
     * =========================
     * SQL: SELECT materials.id, materials.title, materials.resource_url, materials.describe, material_styles.kolb_style, MTS.tag_id, MTS.name
     * FROM materials
     * INNER JOIN material_styles
     * ON (material_styles.material_id = materials.id)
     * INNER JOIN ((SELECT material_id, tag_id, name FROM material_tags INNER JOIN tags ON (material_tags.tag_id = tags.id)) as MTS)
     * ON (MTS.material_id = materials.id)
     *
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->model->newQuery()
            ->select(
                'materials.id',
                'materials.title',
                'materials.resource_url',
                'materials.describe',
            )
            ->get();
    }

    /**
     * 取得教材
     *
     * @param int $id
     * @return Model|null
     */
    public function get(int $id): ?Model
    {
        return $this->model->newQuery()
            ->select(
                'materials.id',
                'materials.title',
                'materials.resource_url',
                'materials.describe',
            )
            ->where("materials.id", $id)
            ->first();
    }
}
