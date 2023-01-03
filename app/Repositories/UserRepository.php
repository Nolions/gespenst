<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * find user data by username
     *
     * @param string $username
     * @return User|null
     */
    public function findByUsername(string $username): ?User
    {
        return $this->model->newQuery()->select('id', 'username')
            ->where('username', $username)
            ->first();
    }
}
