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
                $name = "分散者";
                break;
            case 'ro':
                $name = "同化者";
                break;
            case 'ac':
                $name = "收斂者";
                break;
            case 'ae':
                $name = "調適者";
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
