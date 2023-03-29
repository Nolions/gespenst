<?php

namespace App\Repositories;

use App\Models\LoginLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class LoginLogRepository
{
    private LoginLog $model;

    public function __construct(LoginLog $model)
    {
        $this->model = $model;
    }

    /**
     * 取得登入紀錄
     *
     * @param string $username
     * @return Collection
     */
    public function userRecords(string $username): Collection
    {
        return $this->model->newQuery()
            ->select('username', 'create_at')
            ->where('username', $username)
            ->orderBy("create_at", "DESC")
            ->get();
    }

    /**
     * 取得管理者之外的登入紀錄
     *
     * @param string|null $style
     * @param string|null $username
     * @return LengthAwarePaginator
     */
    public function usersLoginRecord(?string $style = "", ?string $username = ""): LengthAwarePaginator
    {
        $builder = $this->model->newQuery();
        if ($username != null && $username != '') {
            $builder->where('username', $username);
        }

        if ($style != null && $style != '') {
            $builder->whereIn('username', function($query) use($username, $style){
                switch ($style) {
                    case "ce":
                        $query->whereColumn("ce_score", ">", "ro_score")
                            ->whereColumn("ce_score", ">", "ac_score")
                            ->whereColumn("ce_score", ">", "ae_score");
                        break;
                    case "ro":
                        $query->whereColumn("ro_score", ">", "ce_score")
                            ->whereColumn("ro_score", ">", "ac_score")
                            ->whereColumn("ro_score", ">", "ae_score");
                        break;
                    case "ac":
                        $query->whereColumn("ac_score", ">", "ro_score")
                            ->whereColumn("ac_score", ">", "ce_score")
                            ->whereColumn("ac_score", ">", "ae_score");
                        break;
                    case "ae":
                        $query->whereColumn("ae_score", ">", "ro_score")
                            ->whereColumn("ae_score", ">", "ac_score")
                            ->whereColumn("ae_score", ">", "ce_score");
                        break;
                }

                $query->select('username')->from('kolb_styles');

                if ($username != null && $username != '') {
                    $query->where('username', $username);
                }
            });
        }

        return $builder
            ->select('username', DB::raw('MAX(`create_at`) as create_at'))
            ->groupBy('username')
            ->whereNotIn('username', ['administrator'])
            ->paginate(10);
    }
}
