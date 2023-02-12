<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;

class TagRepository
{
    /**
     * @var Tag
     */
    private Tag $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    /**
     * 取得教材標籤by名稱
     *
     * @param string $name
     * @return Model|null
     */
    public function findByName(string $name):?Model
    {
        return $this->model->newQuery()
            ->select("id", "name")
            ->where('name', $name)
            ->first();
    }
}
