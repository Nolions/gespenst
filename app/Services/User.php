<?php

namespace App\Services;

use App\Models\User as UserModel;
use App\Repositories\UserRepository;

class User
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * 註冊
     *
     * @param string $username
     * @return UserModel|null
     */
    public function register(string $username): ?UserModel
    {
        $user = new UserModel();
        $user->username = $username;
        if ($user->save()) {
            return $user;
        }
        return null;
    }

    /**
     * find user data by username
     *
     * @param string $username
     * @return UserModel|null
     */
    public function findByUsername(string $username): ?UserModel
    {
        return $this->userRepo->findByUsername($username);
    }
}
