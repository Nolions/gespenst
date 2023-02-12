<?php

namespace App\Repositories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class MaterialRepository
{
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
                'material_styles.kolb_style',
                'MTS.tag_id',
                'MTS.name'
            )
            ->join('material_styles', 'material_styles.material_id', '=', 'materials.id')
            ->join(DB::raw('(SELECT material_id, tag_id, name FROM material_tags INNER JOIN tags ON (material_tags.tag_id = tags.id))  MTS'),
                function ($join) {
                    $join->on('MTS.material_id', '=', 'materials.id');
                }
            )
            ->get();
    }
}
