<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    private string $table = 'users';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table)->insert($this->data());
    }

    private function data(): array
    {
        $users = [
            'administrator'
        ];

        $data = [];
        foreach ($users as $user) {
            if (!is_null(DB::table($this->table)->select()->where('username', $user)->first())) {
                continue;
            }

            $data[] = [
                "username" => $user
            ];
        }

        return $data;
    }
}
