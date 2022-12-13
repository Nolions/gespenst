<?php

namespace App\Services;

class lse
{
    /**
     * 取得lse問券
     *
     * @return array
     */
    public function questions(): array
    {
        return lse()->questionList();
    }

}
