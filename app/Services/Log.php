<?php

namespace App\Services;

use App\Models\LoginLog;
use App\Repositories\LoginLogRepository;

class Log
{
    /**
     * @var LoginLogRepository
     */
    private LoginLogRepository $loginLogRepo;

    public function __construct(LoginLogRepository $loginLogRepo)
    {
        $this->loginLogRepo = $loginLogRepo;
    }

    /**
     *  建立登入紀錄
     *
     * @param string $username
     * @return bool
     */
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
     * @param string|null $style
     * @return array
     */
    public function usersLoginRecord(?string $style = ""): array
    {
        return $this->loginLogRepo->usersLoginRecord($style)->toArray();
    }
}
