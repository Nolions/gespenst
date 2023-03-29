<?php

namespace App\Repositories;

use App\Models\KolbStyle;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
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

    public function getAll(?string $style = ""): LengthAwarePaginator
    {
        $builder = $this->model->newQuery();

        switch ($style) {
            case "ce":
                $builder->whereColumn("ce_score", ">", "ro_score")
                    ->whereColumn("ce_score", ">", "ac_score")
                    ->whereColumn("ce_score", ">", "ae_score");
                break;
            case "ro":
                $builder->whereColumn("ro_score", ">", "ce_score")
                    ->whereColumn("ro_score", ">", "ac_score")
                    ->whereColumn("ro_score", ">", "ae_score");
                break;
            case "ac":
                $builder->whereColumn("ac_score", ">", "ro_score")
                    ->whereColumn("ac_score", ">", "ce_score")
                    ->whereColumn("ac_score", ">", "ae_score");
                break;
            case "ae":
                $builder->whereColumn("ae_score", ">", "ro_score")
                    ->whereColumn("ae_score", ">", "ac_score")
                    ->whereColumn("ae_score", ">", "ce_score");
                break;
        }

        return $builder->select('user_id', 'ce_score', 'ro_score', 'ac_score', 'ae_score')
            ->paginate(10);
    }
}
