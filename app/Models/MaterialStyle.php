<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialStyle extends Model
{
    public $timestamps = false;

    public function getKolbStyleAttribute($value): string
    {
        return getStyleName($value);
    }
}
