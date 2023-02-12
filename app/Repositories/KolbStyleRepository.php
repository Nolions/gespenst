<?php

namespace App\Repositories;

use App\Models\KolbStyle;
use Illuminate\Database\Eloquent\Model;

class KolbStyleRepository
{
    /**
     * @var KolbStyle
     */
    private KolbStyle $model;

    public function __construct(KolbStyle $model)
    {
        $this->model = $model;
    }

    /**
     * 取得會員學習風格
     *
     * @param string $userId
     * @return Model|null
     */
    public function getStyleByUser(string $userId): ?model
    {
        return $this->model->newQuery()
            ->select('ce_score', 'ro_score', 'ac_score', 'ae_score')
            ->where('user_id', $userId)
            ->first();
    }
}
