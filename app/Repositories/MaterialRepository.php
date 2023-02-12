<?php

namespace App\Repositories;

use App\Models\Material;
use App\Models\User;

class MaterialRepository
{
    private Material $model;

    public function __construct(Material $model)
    {
        $this->model = $model;
    }
}
