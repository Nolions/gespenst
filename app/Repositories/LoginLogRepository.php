<?php

namespace App\Repositories;

use App\Models\LoginLog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class LoginLogRepository
{
    private LoginLog $repo;

    public function __construct(LoginLog $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 取得登入紀錄
     *
     * @param string $username
     * @return Collection
     */
    public function userRecords(string $username): Collection
    {
        return $this->repo->newQuery()
            ->select('username', 'create_at')
            ->where('username', $username)
            ->orderBy("create_at", "DESC")
            ->get();
    }

    /**
     * 取得管理者之外的登入紀錄
     *
     * @return \Illuminate\Support\Collection
     */
    public function usersLoginRecord(): \Illuminate\Support\Collection
    {
        return $this->repo->newQuery()
            ->select('username', DB::raw('MAX(`create_at`) as create_at'))
            ->groupBy('username')
            ->whereNotIn('username', ['administrator'])
            ->get();
    }
}
