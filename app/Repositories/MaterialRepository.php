<?php

namespace App\Repositories;

use App\Models\Material;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
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
     * @return LengthAwarePaginator
     */
    public function list(): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->select(
                'materials.id',
                'materials.title',
                'materials.resource_url',
                'materials.describe',
            )
            ->paginate(10);
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

    public function randomCount(?int $tagId = 0, ?string $style = null): int
    {
        return $this->randomBuilder($tagId, $style)->count();
    }

    public function randomList(int $offset, int $limit, ?int $tagId = 0, ?string $style = null): LengthAwarePaginator
    {
        return $this->randomBuilder($tagId, $style)
            ->select('materials.id', 'materials.title', 'materials.resource_url', 'materials.describe')
            ->limit($limit)
            ->offset($offset)
            ->paginate(10);
    }

    /**
     *
     *
     * @param int|null $tagId
     * @param string|null $style
     * @return Builder
     */
    public function randomBuilder(?int $tagId, ?string $style): Builder
    {
        $builder = $this->model->newQuery();
        if ($tagId > 0) {
            $builder->join('material_tags', 'material_tags.material_id', '=', 'materials.id')
                ->where('material_tags.tag_id', $tagId);
        }

        if ($style != null) {
            $builder->join('material_styles', 'material_styles.material_id', '=', 'materials.id')
                ->where('material_styles.kolb_style', $style);
        }
        return $builder;
    }
}
