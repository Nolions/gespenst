<?php

namespace App\Services;

use App\Models\LoginLog;
use App\Repositories\LoginLogRepository;

class Log
{
    private LoginLogRepository $loginLogRepo;

    public function __construct(LoginLogRepository $loginLogRepo)
    {
        $this->loginLogRepo = $loginLogRepo;
    }

    public function loginRecord(string $username): bool
    {
        $model = new LoginLog();
        $model->username = $username;

        return $model->save();
    }

    /**
     * 取得登入紀錄
     *
     * @param string $username
     * @return array
     */
    public function userLoginRecord(string $username): array
    {
        return $this->loginLogRepo->userRecords($username)->toArray();
    }

    /**
     * 取得管理者之外的登入紀錄
     *
     * @return array
     */
    public function usersLoginRecord(): array
    {
        return $this->loginLogRepo->usersLoginRecord()->toArray();
    }
}
