<?php

namespace App\Repositories;

use App\Models\LoginLog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
     * @return Collection
     */
    public function usersLoginRecord(): Collection
    {
        return $this->repo->newQuery()
            ->select('username', 'create_at')
            ->whereNotIn('username', ['administrator'])
            ->orderBy("create_at", "DESC")
            ->get();
    }
}
