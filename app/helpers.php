<?php

use App\lse;

if (!function_exists('lse')) {
    function lse()
    {
        return app(LSE::class);
    }
}

function getStyleName(string $style): string
{
    $name = "";
    switch ($style) {
        case 'ce':
            $name = "具體的經驗";
            break;
        case 'ro':
            $name = "省思的觀察";
            break;
        case 'ac':
            $name = "抽象的概念";
            break;
        case 'ae':
            $name = "主動的實驗";
            break;
    }

    return $name;
}
