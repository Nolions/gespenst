<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    private string $table = 'tags';

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
        $tags = [
            "基礎語法",
            "函數",
            "變數",
            "運算式",
            "迴圈",
            "資料型態",
            "條件判斷",
            "I/O",
            "例外處理",
            "資料結構",
            "陣列",
            "鏈結列表",
            "樹",
            "貯列",
            "堆疊",
            "圖形與網路",
            "演算法",
            "搜尋",
            "排序",
            "分群",
        ];

        $data = [];
        foreach ($tags as $tag) {
            if (!is_null(DB::table($this->table)->select()->where('name', $tag)->first())) {
                continue;
            }

            $data[] = [
                "name" => $tag
            ];
        }

        return $data;
    }
}
