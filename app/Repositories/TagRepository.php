<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;

class TagRepository
{
    private Tag $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function findByName(string $name):?Model
    {
        return $this->model->newQuery()
            ->select("id", "name")
            ->where('name', $name)
            ->first();
    }
}
