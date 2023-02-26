<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    public $timestamps = false;

    public function tags(): HasMany
    {
        return $this->hasMany(MaterialTag::class, 'material_id', 'id')
            ->select('tags.name')
            ->join('tags', 'tags.id', '=', 'material_tags.tag_id');
    }

    public function styles(): HasMany
    {
        return $this->hasMany(MaterialStyle::class, 'material_id', 'id')
            ->select('kolb_style');
    }
}
