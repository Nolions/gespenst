<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class lse
{
    /**
     * 取得lse問券
     *
     * @return array
     */
    public function questions(): array
    {
        $questions = json_decode(File::get(storage_path('data/lse_questions.json')), true);
        $options = json_decode(File::get(storage_path('data/lse_options.json')), true);

        for ($i = 0; $i < count($options); $i++) {
            unset($options[$i]['score']);
        }


        for ($i = 0; $i < count($questions); $i++) {
            unset($questions[$i]['type']);
            $questions[$i]['option'] = $options;
        }

        return $questions;
    }
}
