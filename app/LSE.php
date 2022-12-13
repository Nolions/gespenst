<?php

namespace App;

use Illuminate\Support\Facades\File;

class LSE
{
    /**
     * @var array
     */
    private array $questions = [];

    /**
     * @var array
     */
    private array $options = [];

    public function __construct()
    {
        $this->questions = json_decode(File::get(storage_path('data/lse_questions.json')), true);
        $this->options = json_decode(File::get(storage_path('data/lse_options.json')), true);
    }

    /**
     * LSE問卷
     *
     * @return array
     */
    public function questionList(): array
    {
        $questions = $this->questions;
        $options = $this->options;

        for ($i = 0; $i < count($this->options); $i++) {
            unset($options[$i]['score']);
        }

        for ($i = 0; $i < count($this->questions); $i++) {
            unset($questions[$i]['type']);
            $questions[$i]['option'] = $this->options;
        }

        return $questions;
    }
}
