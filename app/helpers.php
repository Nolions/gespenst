<?php

use App\lse;
use Illuminate\Support\Facades\Auth;

if (!function_exists('lse')) {
    function lse()
    {
        return app(lse::class);
    }
}

/**
 * @param string $style
 * @return string
 */
if (!function_exists('getStyleName')) {
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
}

/**
 * 檢查時否為管理者(administrator)
 *
 * @return bool
 */
if (!function_exists('isAdminer')) {
    function isAdminer(): bool
    {
        if (Auth::user()->username == 'administrator') {
            return true;
        }

        return false;
    }
}
