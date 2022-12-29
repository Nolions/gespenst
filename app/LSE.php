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

    /**
     * @var array
     */
    private array $optionScores = [];

    /**
     * @var array
     */
    private array $kolbStyle = [];

    public function __construct()
    {
        $this->options = json_decode(File::get(storage_path('data/lse_options.json')), true);
        $this->questions = json_decode(File::get(storage_path('data/lse_questions.json')), true);
        $kolbStyles = json_decode(File::get(storage_path('data/kolb_style.json')), true);

        foreach ($kolbStyles as $kolbStyle) {
            $this->kolbStyle[$kolbStyle['id']] = $kolbStyle;
        }

        foreach ($this->options as $option) {
            $this->optionScores[$option['id']] = $option['score'];
        }
    }

    /**
     * 由id取得kolb Style
     *
     * @param int $id
     * @return array
     */
    public function kolbStyle(int $id): array
    {
        return $this->kolbStyle[$id];
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
            $questions[$i]['option'] = $options;
        }

        return $questions;
    }

    /**
     * 問券題目所屬面向
     *
     * @param int $questionId
     * @return array
     */
    public function questionStyle(int $questionId): array
    {
        $styleId = $this->questions[$questionId - 1]['type'];

        return $this->kolbStyle[$styleId];
    }

    /**
     * 取得選項分數
     *
     * @param int $opId
     * @return int
     */
    public function score(int $opId): int
    {
        return $this->optionScores[$opId];
    }
}
